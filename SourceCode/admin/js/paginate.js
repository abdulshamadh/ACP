/*
 paginate table object v2.1 by frequency-decoder.com
 
 Released under a creative commons Attribution-ShareAlike 2.5 license (http://creativecommons.org/licenses/by-sa/2.5/)
 
 Please credit frequency decoder in any derivative work - thanks
 
 You are free:
 
 * to copy, distribute, display, and perform the work
 * to make derivative works
 * to make commercial use of the work
 
 Under the following conditions:
 
 by Attribution.
 --------------
 You must attribute the work in the manner specified by the author or licensor.
 
 sa
 --
 Share Alike. If you alter, transform, or build upon this work, you may distribute the resulting work only under a license identical to this one.
 
 * For any reuse or distribution, you must make clear to others the license terms of this work.
 * Any of these conditions can be waived if you get permission from the copyright holder.
 */


var tablePaginater = (function() {
    /*
     
     Localise the button titles here...
     
     %p is replaced with the appropriate page number
     %t is replaced with the total number of pages
     
     */
    var tableInfo = {},
            uniqueID = 0,
            text = ["First Page", "Previous Page (Page %p)", "Next Page (Page %p)", "Last Page (Page %t)", "Page %p of %t"];

    var addClass = function(e, c) {
        if (new RegExp("(^|\\s)" + c + "(\\s|$)").test(e.className))
            return;
        e.className += (e.className ? " " : "") + c;
    };

    /*@cc_on
     /*@if (@_win32)
     var removeClass = function(e,c) {
     e.className = !c ? "" : e.className.replace(new RegExp("(^|\\s)" + c + "(\\s|$)"), " ").replace(/^\s*((?:[\S\s]*\S)?)\s*$/, '$1');
     };
     @else @*/
    var removeClass = function(e, c) {
        e.className = !c ? "" : (e.className || "").replace(new RegExp("(^|\\s)" + c + "(\\s|$)"), " ").replace(/^\s\s*/, '').replace(/\s\s*$/, '');
    };
    /*@end
     @*/

    var addEvent = function(obj, type, fn) {
        if (obj.attachEvent) {
            obj["e" + type + fn] = fn;
            obj[type + fn] = function() {
                obj["e" + type + fn](window.event);
            };
            obj.attachEvent("on" + type, obj[type + fn]);
        } else {
            obj.addEventListener(type, fn, true);
        }
        ;
    };
    var removeEvent = function(obj, type, fn) {
        try {
            if (obj.detachEvent) {
                obj.detachEvent("on" + type, obj[type + fn]);
                obj[type + fn] = null;
            } else {
                obj.removeEventListener(type, fn, true);
            }
            ;
        } catch (err) {
        }
        ;
    };
    var stopEvent = function(e) {
        e = e || window.event;
        if (e.stopPropagation) {
            e.stopPropagation();
            e.preventDefault();
        }
        ;

        /*@cc_on@*/
        /*@if(@_win32)
         e.cancelBubble = true;
         e.returnValue  = false;
         /*@end@*/
        return false;
    };

    var init = function(tableId) {
        var tables = tableId && typeof(tableId) == "string" ? [document.getElementById(tableId)] : document.getElementsByTagName('table'),
                hook, maxPages, visibleRows, numPages, cp, cb, rowList;

        for (var t = 0, tbl; tbl = tables[t]; t++) {
            if (tbl.className.search(/paginate-([0-9]+)/) == -1) {
                continue;
            }
            ;

            if (!tbl.id) {
                tbl.id = "fdUniqueTableId_" + uniqueID++;
            }
            ;

            maxPages = tbl.className.search(/max-pages-([0-9]+)/) == -1 ? null : Number(tbl.className.match(/max-pages-([0-9]+)/)[1]);
            if (maxPages % 2 == 0 && maxPages > 1) {
                maxPages--;
            }
            ;

            hook = tbl.getElementsByTagName('tbody');
            hook = (hook.length) ? hook[0] : tbl;

            visibleRows = calculateVisibleRows(hook);

            if (maxPages > (visibleRows / Number(tbl.className.match(/paginate-([0-9]+)/)[1]))) {
                maxPages = null;
            }
            ;

            numPages = Math.ceil(visibleRows / Number(tbl.className.match(/paginate-([0-9]+)/)[1]));

            if (numPages < 2 && !(tbl.id in tableInfo)) {
                continue;
            }
            ;

            cp = (tbl.id in tableInfo) ? Math.min(tableInfo[tbl.id].currentPage, numPages) : 1;

            tableInfo[tbl.id] = {
                rowsPerPage: Number(tbl.className.match(/paginate-([0-9]+)/)[1]),
                currentPage: cp,
                totalRows: hook.getElementsByTagName('tr').length,
                hook: hook,
                maxPages: maxPages,
                numPages: numPages,
                rowStyle: tbl.className.search(/rowstyle-([\S]+)/) != -1 ? tbl.className.match(/rowstyle-([\S]+)/)[1] : false,
                callbacks: parseCallback(/^paginationcallback-/i, /paginationcallback-([\S-]+)/ig, tbl.className)
            };

            showPage(tbl.id);
            hook = null;
        }
        ;
    };

    var parseCallback = function(head, regExp, cname) {
        var cbs = [],
                matchs = cname.match(regExp),
                parts, obj, func;

        if (!matchs) {
            return [];
        }
        ;

        for (var i = 0, mtch; mtch = matchs[i]; i++) {
            mtch = mtch.replace(head, "").replace(/-/g, ".");

            try {
                if (mtch.indexOf(".") != -1) {
                    parts = mtch.split('.');
                    obj = window;
                    for (var x = 0, part; part = obj[parts[x]]; x++) {
                        if (part instanceof Function) {
                            (function() {
                                var method = part;
                                func = function(data) {
                                    method.apply(obj, [data])
                                };
                            })();
                        } else {
                            obj = part;
                        }
                        ;
                    }
                    ;
                } else {
                    func = window[mtch];
                }
                ;

                if (!(func instanceof Function))
                    continue;
                cbs[cbs.length] = func;
            } catch (err) {
            }
            ;
        }
        ;

        return cbs;
    };

    var callback = function(tblId, opts) {
        if (!(tblId in tableInfo) || !(tableInfo[tblId]["callbacks"].length))
            return;
        for (var i = 0, func; func = tableInfo[tblId]["callbacks"][i]; i++) {
            func(opts || {});
        }
        ;
    };

    var calculateVisibleRows = function(hook) {
        var trs = hook.rows,
                cnt = 0,
                reg = /(^|\s)invisibleRow(\s|$)/;

        for (var i = 0, tr; tr = trs[i]; i++) {
            if (tr.parentNode != hook || tr.getElementsByTagName("th").length || (tr.parentNode && tr.parentNode.tagName.toLowerCase().search(/thead|tfoot/) != -1))
                continue;
            if (tr.className.search(reg) == -1) {
                cnt++;
            }
            ;
        }
        ;

        return cnt;
    };

    var createButton = function(details, ul, pseudo) {
        var li = document.createElement("li"),
                but = document.createElement(pseudo ? "div" : "a"),
                span = document.createElement("span");

        if (!pseudo) {
            but.href = "#";
            but.title = details.title;
        }
        ;

        but.className = details.className;

        ul.appendChild(li);
        li.appendChild(but);
        but.appendChild(span);
        span.appendChild(document.createTextNode(details.text));

        if (!pseudo) {
            li.onclick = but.onclick = buttonClick;
            if (details.id) {
                but.id = details.id;
            }
            ;
        }
        ;

        li = but = span = null;
    };
    var removePagination = function(tableId) {
        var wrapT = document.getElementById(tableId + "-fdtablePaginaterWrapTop"),
                wrapB = document.getElementById(tableId + "-fdtablePaginaterWrapBottom");
        if (wrapT) {
            wrapT.parentNode.removeChild(wrapT);
        }
        ;
        if (wrapB) {
            wrapB.parentNode.removeChild(wrapB);
        }
        ;
    };
    var buildPagination = function(tblId) {
        if (!(tblId in tableInfo)) {
            return;
        }
        ;

        removePagination(tblId);

        var details = tableInfo[tblId];

        if (details.numPages < 2)
            return;

        function resolveText(txt, curr) {
            curr = curr || details.currentPage;
            return txt.replace("%p", curr).replace("%t", details.numPages);
        }
        ;

        if (details.maxPages) {
            findex = Math.max(0, Math.floor(Number(details.currentPage - 1) - (Number(details.maxPages - 1) / 2)));
            lindex = findex + Number(details.maxPages);
            if (lindex > details.numPages) {
                lindex = details.numPages;
                findex = Math.max(0, details.numPages - Number(details.maxPages));
            }
            ;
        } else {
            findex = 0;
            lindex = details.numPages;
        }
        ;


        var wrapT = document.createElement("div");
        wrapT.className = "fdtablePaginaterWrap fdtablePaginatorWrapTop";
        wrapT.id = tblId + "-fdtablePaginaterWrapTop";

        var wrapB = document.createElement("div");
        wrapB.className = "fdtablePaginaterWrap fdtablePaginatorWrapBottom";
        wrapB.id = tblId + "-fdtablePaginaterWrapBottom";

        // Create list scaffold
        var ulT = document.createElement("ul");
        ulT.id = tblId + "-tablePaginater";

        var ulB = document.createElement("ul");
        ulB.id = tblId + "-tablePaginaterClone";
        ulT.className = ulB.className = "fdtablePaginater";

        // Add to the wrapper DIVs
        wrapT.appendChild(ulT);
        wrapB.appendChild(ulB);

        // FIRST (only created if maxPages set)
        if (details.maxPages) {
            createButton({title: text[0], className: "first-page", text: "\u00ab"}, ulT, !findex);
            createButton({title: text[0], className: "first-page", text: "\u00ab"}, ulB, !findex);
        }
        ;

        // PREVIOUS (only created if there are more than two pages)
        if (details.numPages > 2) {
            createButton({title: resolveText(text[1], details.currentPage - 1), className: "previous-page", text: "\u2039", id: tblId + "-previousPage"}, ulT, details.currentPage == 1);
            createButton({title: resolveText(text[1], details.currentPage - 1), className: "previous-page", text: "\u2039", id: tblId + "-previousPageC"}, ulB, details.currentPage == 1);
        }
        ;

        // NUMBERED
        for (var i = findex; i < lindex; i++) {
            createButton({title: resolveText(text[4], i + 1), className: i != (details.currentPage - 1) ? "page-" + (i + 1) : "currentPage page-" + (i + 1), text: (i + 1), id: i == (details.currentPage - 1) ? tblId + "-currentPage" : ""}, ulT);
            createButton({title: resolveText(text[4], i + 1), className: i != (details.currentPage - 1) ? "page-" + (i + 1) : "currentPage page-" + (i + 1), text: (i + 1), id: i == (details.currentPage - 1) ? tblId + "-currentPageC" : ""}, ulB);
        }
        ;

        // NEXT (only created if there are more than two pages)
        if (details.numPages > 2) {
            createButton({title: resolveText(text[2], details.currentPage + 1), className: "next-page", text: "\u203a", id: tblId + "-nextPage"}, ulT, details.currentPage == details.numPages);
            createButton({title: resolveText(text[2], details.currentPage + 1), className: "next-page", text: "\u203a", id: tblId + "-nextPageC"}, ulB, details.currentPage == details.numPages);
        }
        ;

        // LAST (only created if maxPages set)
        if (details.maxPages) {
            createButton({title: resolveText(text[3], details.numPages), className: "last-page", text: "\u00bb"}, ulT, lindex == details.numPages);
            createButton({title: resolveText(text[3], details.numPages), className: "last-page", text: "\u00bb"}, ulB, lindex == details.numPages);
        }
        ;

        // DOM inject wrapper DIVs (FireFox 2.x Bug: this has to be done here if you use display:table)
        if (document.getElementById(tblId + "-paginationListWrapTop")) {
            document.getElementById(tblId + "-paginationListWrapTop").appendChild(wrapT);
        } else {
            document.getElementById(tblId).parentNode.insertBefore(wrapT, document.getElementById(tblId));
        }
        ;

        if (document.getElementById(tblId + "-paginationListWrapBottom")) {
            document.getElementById(tblId + "-paginationListWrapBottom").appendChild(wrapB);
        } else {
            document.getElementById(tblId).parentNode.insertBefore(wrapB, document.getElementById(tblId).nextSibling);
        }
        ;
    };

    // The tableSort script uses this function to redraw.
    var tableSortRedraw = function(tableid, identical) {
        if (!tableid || !(tableid in fdTableSort.tableCache) || !(tableid in tableInfo)) {
            return;
        }
        ;

        var dataObj = fdTableSort.tableCache[tableid],
                data = dataObj.data,
                len1 = data.length,
                len2 = len1 ? data[0].length - 1 : 0,
                hook = dataObj.hook,
                colStyle = dataObj.colStyle,
                rowStyle = dataObj.rowStyle,
                colOrder = dataObj.colOrder,
                page = tableInfo[tableid].currentPage - 1,
                d1 = tableInfo[tableid].rowsPerPage * page,
                d2 = Math.min(tableInfo[tableid].totalRows, d1 + tableInfo[tableid].rowsPerPage),
                cnt = 0,
                rs = 0,
                reg = /(^|\s)invisibleRow(\s|$)/,
                tr, tds, cell, pos;

        for (var i = 0; i < len1; i++) {
            tr = data[i][len2];

            if (colStyle) {
                tds = tr.cells;
                for (thPos in colOrder) {
                    if (!colOrder[thPos])
                        removeClass(tds[thPos], colStyle);
                    else
                        addClass(tds[thPos], colStyle);
                }
                ;
            }
            ;

            if (tr.className.search(reg) != -1) {
                continue;
            }
            ;

            if (!identical) {
                cnt++;

                if (cnt > d1 && cnt <= d2) {
                    if (rowStyle) {
                        if (rs++ & 1)
                            addClass(tr, rowStyle);
                        else
                            removeClass(tr, rowStyle);
                    }
                    ;
                    tr.style.display = "";
                } else {
                    tr.style.display = "none";
                }
                ;

                // Netscape 8.1.2 requires the removeChild call or it freaks out, so add the line if you want to support this browser
                // hook.removeChild(tr);
                hook.appendChild(tr);
            }
            ;
        }
        ;

        tr = tds = hook = null;
    };

    var showPage = function(tblId, pageNum) {
        if (!(tblId in tableInfo)) {
            return;
        }
        ;

        var page = Math.max(0, !pageNum ? tableInfo[tblId].currentPage - 1 : pageNum - 1),
                d1 = tableInfo[tblId].rowsPerPage * page,
                d2 = Math.min(tableInfo[tblId].totalRows, d1 + tableInfo[tblId].rowsPerPage),
                trs = tableInfo[tblId].hook.rows,
                cnt = 0,
                rc = 0,
                len = trs.length,
                rs = tableInfo[tblId].rowStyle,
                reg = /(^|\s)invisibleRow(\s|$)/,
                row = [];

        for (var i = 0; i < len; i++) {
            if (trs[i].className.search(reg) != -1 || trs[i].getElementsByTagName("th").length || (trs[i].parentNode && trs[i].parentNode.tagName.toLowerCase().search(/thead|tfoot/) != -1)) {
                continue;
            }
            ;

            cnt++;

            if (cnt > d1 && cnt <= d2) {
                if (rs) {
                    if (rc++ & 1) {
                        addClass(trs[i], rs);
                    } else {
                        removeClass(trs[i], rs);
                    }
                }
                ;
                trs[i].style.display = "";
                row[row.length] = trs[i];
            } else {
                trs[i].style.display = "none";
            }
            ;
        }
        ;

        buildPagination(tblId);
        callback(tblId, {"table": tblId, "totalRows": len, "currentPage": (page + 1), "rowsPerPage": tableInfo[tblId].rowsPerPage, "visibleRows": row});
    };

    var buttonClick = function(e) {
        e = e || window.event;

        var a = this.tagName.toLowerCase() == "a" ? this : this.getElementsByTagName("a")[0];

        if (a.className.search("currentPage") != -1)
            return false;

        var ul = this;
        while (ul.tagName.toLowerCase() != "ul")
            ul = ul.parentNode;

        var tblId = ul.id.replace("-tablePaginaterClone", "").replace("-tablePaginater", "");

        tableInfo[tblId].lastPage = tableInfo[tblId].currentPage;

        var showPrevNext = 0;

        if (a.className.search("previous-page") != -1) {
            tableInfo[tblId].currentPage = tableInfo[tblId].currentPage > 1 ? tableInfo[tblId].currentPage - 1 : tableInfo[tblId].numPages;
            showPrevNext = 1;
        } else if (a.className.search("next-page") != -1) {
            tableInfo[tblId].currentPage = tableInfo[tblId].currentPage < tableInfo[tblId].numPages ? tableInfo[tblId].currentPage + 1 : 1;
            showPrevNext = 2;
        } else if (a.className.search("first-page") != -1) {
            tableInfo[tblId].currentPage = 1;
        } else if (a.className.search("last-page") != -1) {
            tableInfo[tblId].currentPage = tableInfo[tblId].numPages;
        } else {
            tableInfo[tblId].currentPage = parseInt(a.className.match(/page-([0-9]+)/)[1]) || 1;
        }
        ;

        showPage(tblId);

        // Focus on the appropriate button (previous, next or the current page)
        // I'm hoping screen readers are savvy enough to indicate the focus event to the user
        if (showPrevNext == 1) {
            var elem = document.getElementById(ul.id.search("-tablePaginaterClone") != -1 ? tblId + "-previousPageC" : tblId + "-previousPage");
        } else if (showPrevNext == 2) {
            var elem = document.getElementById(ul.id.search("-tablePaginaterClone") != -1 ? tblId + "-nextPageC" : tblId + "-nextPage");
        } else {
            var elem = document.getElementById(ul.id.search("-tablePaginaterClone") != -1 ? tblId + "-currentPageC" : tblId + "-currentPage");
        }
        ;

        if (elem && elem.tagName.toLowerCase() == "a") {
            elem.focus();
        }
        ;

        return stopEvent(e);
    };

    var onUnLoad = function(e) {
        var tbl, lis, pagination, uls;
        for (tblId in tableInfo) {
            uls = [tblId + "-tablePaginater", tblId + "-tablePaginaterClone"];
            for (var z = 0; z < 2; z++) {
                pagination = document.getElementById(uls[z]);
                if (!pagination) {
                    continue;
                }
                ;
                lis = pagination.getElementsByTagName("li");
                for (var i = 0, li; li = lis[i]; i++) {
                    li.onclick = null;
                    if (li.getElementsByTagName("a").length) {
                        li.getElementsByTagName("a")[0].onclick = null;
                    }
                    ;
                }
                ;
            }
            ;
        }
        ;
    };

    addEvent(window, "load", init);
    addEvent(window, "unload", onUnLoad);

    return {
        init: function(tableId) {
            init(tableId);
        },
        redraw: function(tableid, identical) {
            tableSortRedraw(tableid, identical);
        },
        tableIsPaginated: function(tableId) {
            return (tableId in tableInfo);
        },
        changeTranslations: function(translations) {
            text = translations;
        }
    };
})();



var callbackTest = {
    calculateTotalRating: function(opts) {
        var trs = document.getElementById("theTable").getElementsByTagName("tbody")[0].rows,
                tot = 0,
                cnt = 0,
                cell = document.getElementById("visibleTotal");

        for (var i = 0, tr; tr = trs[i]; i++) {
            // If the row is visible i.e. has not display:none or the className "invisibleRow" (used by the fake filter)
            if (tr.style.display != "none" && tr.className.search(/(^|\s)invisibleRow($|\s)/) == -1) {
                tot += Number(fdTableSort.getInnerText(tr.cells[6]));
                cnt++;
            }
            ;
        }
        ;

        while (cell.firstChild) {
            cell.removeChild(cell.firstChild);
        }
        ;

        cell.appendChild(document.createTextNode(Number(tot / cnt).toFixed(2)));
    },
    displayTextInfo: function(opts) {
        if (!("currentPage" in opts)) {
            return;
        }

        var p = document.createElement('p'),
                t = document.getElementById('theTable-fdtablePaginaterWrapTop'),
                b = document.getElementById('theTable-fdtablePaginaterWrapBottom');

        p.className = "paginationText";
        p.appendChild(document.createTextNode("Showing page " + opts.currentPage + " of " + Math.ceil(opts.totalRows / opts.rowsPerPage)));

        t.insertBefore(p.cloneNode(true), t.firstChild);
        b.appendChild(p);
    }
};
//]]>
