<?php
#############################################################################
# Function Name: fnIsBlank()
# Created By: PHP Team   
# Created on: 21  Sep 2008
# Purpose: Function to check wether given value is blank or not.    
# Parameters: string $strValue : value
# ON SUCCESS: Returns TRUE if value is blank.     
# ON FAILURE: Returns FLASE  if value is not blank.     
#############################################################################

function fnIsBlank($strValue) {
    if (str_replace(" ", "", $strValue) == NULL) {
        return 1;
    } else {
        return 0;
    }
}

#############################################################################
# Function Name: fnIsNum()
# Created By: PHP Team   
# Created on: 21  Sep 2005
# Purpose: Function to check wether given value is numeric or not.    
# Parameters: int $intValue : value
# ON SUCCESS: Returns TRUE if given value is numeric.
# ON FAILURE: Returns FLASE  if given value is not numeric.
#############################################################################

function fnIsNum($intValue) {
    if ($intValue != NULL) {
        if (!ereg("^-?[0-9]+\$", $intValue)) {
            return 0;
        } else {
            return 1;
        }
    } else {
        return 1;
    }
}

function fnIsPNum($intValue) {
    if ($intValue != NULL) {
        if (!ereg("^-?[0-9]*[/-]?[0-9]+\$", $intValue)) {
            return 0;
        } else {
            return 1;
        }
    } else {
        return 1;
    }
}

#############################################################################
# Function Name: fnIsEmail()
# Created By: PHP Team   
# Created on: 21  Sep 2005
# Purpose: Function to check wether given email address is in valid format or not.    
# Parameters: string $strEmail : Email Address
# ON SUCCESS: Returns TRUE if email address is in valid format.     
# ON FAILURE: Returns FLASE  if email address is not in valid format.
#############################################################################

function fnIsEmail($strEmail) {
    if (@function_exists("preg_match")) {
        if (preg_match("/^.+\@(\[?)[a-zA-Z0-9\-\.]+\.([a-zA-Z]{2,4}| [0-9]{1,3})(\]?)\$/", $strEmail)) {
            return 1;
        } else {
            return 0;
        }
    } else {
        @list($strUser, $strDomain) = @explode('@', $strEmail);
        @list($strHost, $strExt) = @explode('.', $strDomain);
        if (!$strExt) {
            return 0;
        } else {
            return 1;
        }
    }
}

#############################################################################
# Function Name: fnValidateMail()
# Created By: PHP Team   
# Created on: 21  Sep 2005
# Purpose: Function to check wether given email address is valid or not.    
# Parameters: string $strEmail : Email Address
# ON SUCCESS: it will return an array in which 0th index will contain TRUE and 1st index will contain the message.
# ON FAILURE: it will return an array in which 0th index will contain FALSE and 1st index will contain the error message.   
# NOTE : This function will not work on windows server.
#############################################################################

function fnValidateMail($strEmail) {
    global $HTTP_HOST;
    $arrResult = array();
    if (!eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$", $strEmail)) {
        $arrResult[0] = false;
        $arrResult[1] = "$Email is not properly formatted";
        return $arrResult;
    }
    list ( $strUsername, $strDomain ) = split("@", $strEmail);
    if (getmxrr($strDomain, $strMXHost)) {
        $strConnectAddress = $strMXHost[0];
    } else {
        $strConnectAddress = $strDomain;
    }
    $hdlConnect = fsockopen($strConnectAddress, 25);
    if ($hdlConnect) {
        if (ereg("^220", $Out = fgets($hdlConnect, 1024))) {
            fputs($hdlConnect, "HELO $HTTP_HOST\r\n");
            $Out = fgets($hdlConnect, 1024);
            fputs($hdlConnect, "MAIL FROM: <{$Email}>\r\n");
            $From = fgets($hdlConnect, 1024);
            fputs($hdlConnect, "RCPT TO: <{$Email}>\r\n");
            $To = fgets($hdlConnect, 1024);
            fputs($hdlConnect, "QUIT\r\n");
            fclose($hdlConnect);
            if (!ereg("^250", $From) || !ereg("^250", $To)) {
                $arrResult[0] = false;
                $arrResult[1] = "Server rejected address";
                return $result;
            }
        } else {
            $arrResult[0] = false;
            $arrResult[1] = "No response from server";
            return $result;
        }
    } else {
        $arrResult[0] = false;
        $arrResult[1] = "Can not connect E-Mail server.";
        return $arrResult;
    }
    $arrResult[0] = true;
    $arrResult[1] = "$Email appears to be valid.";
    return $arrResult;
}

#############################################################################
# Function Name: fnIsFloat()
# Created By: PHP Team   
# Created on: 21  Sep 2005
# Purpose: Function to check wether given value is float or not.    
# Parameters: string $strValue : value
# ON SUCCESS: Returns TRUE if value is float.
# ON FAILURE: Returns FLASE  if value is not float.
#############################################################################

function fnIsFloat($strValue) {
    if ($strValue != NULL) {
        if (!ereg("^-?[0-9.]+\$", $strValue)) {
            return 0;
        } else {
            return 1;
        }
    } else {
        return 1;
    }
}

#############################################################################
# Function Name: fnRandPassword()
# Created By: PHP Team
# Created on: 21  Sep 2005
# Purpose: Function will return the random password.
# Parameters: string $intNumLetters : Number of charecters to be there in password.
# ON SUCCESS: Return the randomly generated password.
#############################################################################

function fnRandPassword($intNumLetters) {
    $arrCharSet = array("a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k", "l", "m", "n", "o", "p", "q", "r", "s", "t", "u", "v", "w", "x", "y", "z", "1", "2", "3", "4", "5", "6", "7", "8", "9");
    $intUppercased = 3;
    mt_srand((double) microtime() * 1000000);
    for ($i = 0; $i < $intNumLetters; $i++) {
        $strPass .= $arrCharSet[mt_rand(0, (count($arrCharSet) - 1))];
    }
    for ($i = 1; $i < strlen($pass); $i++) {
        if (substr($strPass, $i, 1) == substr($strPass, $i - 1, 1)) {
            $strPass = substr($strPass, 0, $i) . substr($strPass, $i + 1);
        }
    }
    for ($i = 0; $i < strlen($strPass); $i++) {
        if (mt_rand(0, $intUppercased) == 0) {
            $strPass = substr($strPass, 0, $i) . strtoupper(substr($strPass, $i, 1));
        }
        substr($strPass, $i + 1);
    }
    $strPass = substr($strPass, 0, $intNumLetters);
    return($strPass);
}

#############################################################################
# Function Name: fnReadFileContent()
# Created By: PHP Team
# Created on: 21  Sep 2005
# Purpose: Function to get the file contents.
# Parameters: string $strFilePath : path to file.
# ON SUCCESS: Returns file contents.
# ON FAILURE: returns the error message.
#############################################################################

function fnReadFileContent($strFilePath) {
    if (!file_exists($strFilePath)) {
        return "File [$filename] does not exists !!";
    }
    $hdlFile = fopen($strFilePath, "r");
    $strContents = fread($hdlFile, filesize($strFilePath));
    fclose($hdlFile);
    return $strContents;
}

#############################################################################
# Function Name: fnWriteFileContent()
# Created By: PHP Team   
# Created on: 21  Sep 2005
# Purpose: Function to check wether given value is blank or not.    
# Parameters: string $strFilePath : File path 
#                    string $strContents : Contents to be written to the file
# ON SUCCESS: Returns TRUE if contents were written to the file.     
# ON FAILURE: Returns FLASE  if file is not writable.     
#############################################################################

function fnWriteFileContent($strFilePath, $strContents) {
    if (!is_writable($strFilePath)) {
        return 0;
    } else {
        $hdlFile = fopen($strFilePath, "w+");
        fwrite($fd, $strContents, strlen($strContents));
        fclose($hdlFile);
        return 1;
    }
}

#############################################################################
# Function Name: fnMakeDate()
# Created By: PHP Team   
# Created on: 21  Sep 2005
# Purpose: Function format the date in user defined format.    
# Parameters: int $intDay  : Day value
# 						 int $intMonth : Month value 
#             int $intYear : Year value 
#             String $strFormate : Date format ( Default value is : 'd-M-Y' )
# ON SUCCESS: Returns the formatted date. 
#############################################################################

function fnMakeDate($intDay, $intMonth, $intYear, $strFormate = 'd-M-Y') {
    return date($strFormate, mktime(0, 0, 0, $intMonth, $intDay, $intYear));
}

#############################################################################
# Function Name: fnFormatDate()
# Created By: PHP Team   
# Created on: 21  Sep 2005
# Purpose: Function to check wether given value is blank or not.    
# Parameters: String $strDate : Date. 
# 						 String $strFormate : Date format ( Default value is : 'd-M-Y' )
#             String $strSeperator : Seperator ( Default value is : '-' )
# ON SUCCESS: Returns the formatted date. 
#############################################################################

function fnFormatDate($strDate, $strFormate = 'd-M-Y', $strSeperator = '-') {
    ereg("([0-9]{4})" . $strSeperator . "([0-9]{1,2})" . $strSeperator . "([0-9]{1,2})", $strDate, $arrDatePart);
    return fnMakeDate($arrDatePart[3], $arrDatePart[2], $arrDatePart[1], $strFormate);
}

#############################################################################
# Function Name: fnGetYearList()
# Created By: PHP Team   
# Created on: 21  Sep 2005
# Purpose: This function will return the year drop down option list.      
# Parameters: Int $intStartYear : Year From which drop down should start
# 						 Int $intCount     : Number of years from $intStartYear should be there in dropdown
# 						 Int $intSelected  : Year which whould be selected
# ON SUCCESS: Will return the year drop down's option list. 
#############################################################################

function fnGetYearList($intStartYear, $intCount, $intSelected = '') {
    $strHTML = "";
    for ($i = 0; $i < $intCount; $i++) {
        $strHTML .= "<option value=\"" . ($strStartYear + $i) . "\"";
        if ($intSelected == ($intStartYear + $i)) {
            $strHTML .= " selected ";
        }
        $strHTML .= ">" . ($intStartYear + $i) . "</option>";
    }
    return $strHTML;
}

#############################################################################
# Function Name: fnGetMonthList()
# Created By: PHP Team   
# Created on: 21  Sep 2005
# Purpose: This function will return the month drop down option list.    
# Parameters: Int $intSelected  : Month which should be selected
# ON SUCCESS: Will return the month drop down option list.     
#############################################################################

function fnGetMonthList($intSelected = '') {
    $arrMonth = array("Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec");
    $strHTML = "";
    for ($i = 0; $i < 12; $i++) {
        $strHTML .= "<option value=\"" . ($i + 1) . "\"";
        if ($intSelected == ($i + 1)) {
            $strHTML .= " selected ";
        }
        $strHTML .= ">" . $arrMonth[$i] . "</option>";
    }
    return $strHTML;
}

#############################################################################
# Function Name: fnGetDayList()
# Created By: PHP Team   
# Created on: 21  Sep 2005
# Purpose: This function will return the day drop down option list.    
# Parameters: Int $intSelected  : Day which whould be selected
# ON SUCCESS: Will return the day drop down option list.     
#############################################################################

function fnGetDayList($intSelected = '') {
    $strHTML = "";
    for ($i = 1; $i <= 31; $i++) {
        $strHTML .= "<option value=\"" . $i . "\"";
        if ($intSelected == $i) {
            $strHTML .= " selected ";
        }
        $strHTML .= ">" . $i . "</option>";
    }
    return $strHTML;
}

#############################################################################
# Function Name: fnGetUniqueFilePrefix()
# Created By: PHP Team   
# Created on: 21  Sep 2005
# Purpose: Function will return the unique file prefix.    
# Parameters: 
# ON SUCCESS: Return the unique file prefix. 
#############################################################################

function fnGetUniqueFilePrefix() {
    list($strUsec, $strSec) = explode(" ", microtime());
    list($strTrash, $strUsec) = explode(".", $strUsec);
    return (date("YmdHis") . substr(($strSec + $strUsec), -10) . '_');
}

#############################################################################
# Function Name: fnGetUniqueKey()
# Created By: PHP Team   
# Created on: 21  Sep 2005
# Purpose: Function to generate the unique key.    
# Parameters: 
# ON SUCCESS: returns the unique key.     
#############################################################################

function fnGetUniqueKey() {
    return (mktime(date('G'), date('i'), date('s'), date('m'), date('d'), date('Y')));
}

#############################################################################
# Function Name: fnNextDate()
# Created By: PHP Team   
# Created on: 21  Sep 2005
# Purpose: Function will return the formatted next date as per the parameter we sent.    
# Parameters: array $arrInterval : This [arameter may contain Array ( ex. array("days"=>"1") ) or integer value of number of days 
#             string $strDateformat  : Format of output date.
# ON SUCCESS: Returns formatted date.
#############################################################################

function fnNextDate($arrInterval, $strDateformat = "Y-m-d") {
    if (is_array($arrInterval)) {
        foreach ($arrInterval as $k => $v) {
            $strInterval.="$v $k ";
        }
        $strDate = strtotime($strInterval);
    } else {
        $strDate = strtotime("$arrInterval days");
    }
    return date($strDateformat, $strDate);
}

#############################################################################
# Function Name: fnPreviousDate()
# Created By: PHP Team   
# Created on: 21  Sep 2005
# Purpose: Function will return the formatted previous date as per the parameter we sent.    
# Parameters: array $arrInterval : This [arameter may contain Array ( ex. array("days"=>"1") ) or integer value of number of days 
#             string $strDateformat  : format of the dat you want.
# ON SUCCESS: Returns formatted date.
#############################################################################

function fnPreviousDate($arrInterval, $strDateformat = "Y-m-d") {
    if (is_array($arrInterval)) {
        foreach ($arrInterval as $k => $v) {
            $strInterval.="- $v $k ";
        }
        $strDate = strtotime($strInterval);
    } else {
        $strDate = strtotime("- $arrInterval days");
    }
    return date($strDateformat, $strDate);
}

#############################################################################
# Function Name: fnEncodeIp()
# Created By: PHP Team   
# Created on: 21  Sep 2005
# Purpose: Function to encode IP.    
# Parameters: string $strIp : IP
# ON SUCCESS: Returns encoded IP.     
#############################################################################

function fnEncodeIp($strIp) {
    $arrIp = explode('.', $strIp);
    return sprintf('%02x%02x%02x%02x', $arrIp[0], $arrIp[1], $arrIp[2], $arrIp[3]);
}

#############################################################################
# Function Name: fnDecodeIp()
# Created By: PHP Team   
# Created on: 21  Sep 2005
# Purpose: Function to decode IP.    
# Parameters: string $strIp : IP
# ON SUCCESS: Returns decoded IP.     
#############################################################################

function fnDecodeIp($strIp) {
    $arrIp = explode('.', chunk_split($strIp, 2, '.'));
    return hexdec($arrIp[0]) . '.' . hexdec($arrIp[1]) . '.' . hexdec($arrIp[2]) . '.' . hexdec($arrIp[3]);
}

#############################################################################
# Function Name: fnGetPlainUrl()
# Created By: PHP Team   
# Created on: 21  Sep 2005
# Purpose: This function trim the URL that user have inputed as per user input some time user type http:// some times not .. so idea behind this we can store the URL in the databse by triming http:// from it and we want to show it out then we can append http:// to this.    
# Parameters: string $strUrl : Url
# ON SUCCESS: Returns plain Url
#############################################################################

function fnGetPlainUrl($strUrl) {
    return preg_replace('/(^http:\/\/www\.|^www\.|^http:\/\/)/', '', $strUrl);
}

#############################################################################
# Function Name: fnImageResize()
# Created By: PHP Team   
# Created on: 21  Sep 2005
# Purpose: This function takes source and destination image paths.Third optional parameter is the size to which you want to restrict new image.
# Parameters: string $strSource : Source image path
#             string $strDest : Destination image path
#             int $intSize : Destination image size
# ON SUCCESS: Creates the destination image.
# ON FAILURE: returns the error message.
#############################################################################

function fnImageResize($strSource, $strDest, $intSize = 100) {
    $arrImageInfo = getImageSize($strSource); // see EXIF for faster way 
    switch ($arrImageInfo['mime']) {
        case 'image/gif':
            if (imagetypes() & IMG_GIF) {   // not the same as IMAGETYPE 
                $hldSource = imageCreateFromGIF($strSource);
            } else {
                $strErrorMsg = 'GIF images are not supported<br />';
            }
            break;
        case 'image/jpeg':
            if (imagetypes() & IMG_JPG) {
                $hldSource = imageCreateFromJPEG($strSource);
            } else {
                $strErrorMsg = 'JPEG images are not supported<br />';
            }
            break;
        case 'image/png':
            if (imagetypes() & IMG_PNG) {
                $hldSource = imageCreateFromPNG($strSource);
            } else {
                $strErrorMsg = 'PNG images are not supported<br />';
            }
            break;
        case 'image/wbmp':
            if (imagetypes() & IMG_WBMP) {
                $hldSource = imageCreateFromWBMP($strSource);
            } else {
                $strErrorMsg = 'WBMP images are not supported<br />';
            }
            break;
        default:
            $strErrorMsg = $image_info['mime'] . ' images are not supported<br />';
            break;
    }

    if (!isset($strErrorMsg)) {
        $intOrigWidth = imagesx($hldSource);
        $intOrigHeight = imagesy($hldSource);
        $intWidth = $intOrigWidth;
        $intHeight = $intOrigHeight;
        if ($intOrigWidth > $intSize) {
            $intWidth = $intSize;
            $intHeight = round($intOrigHeight * $intSize / $intOrigWidth);
        }
        if ($intHeight > $intSize) {
            $intHeight = $intSize;
            $intWidth = round($intOrigWidth * $intSize / $intOrigHeight);
        }
        $hldDest = imageCreateTrueColor($intWidth, $intHeight);
        imageCopyResampled($hldDest, $hldSource, 0, 0, 0, 0, $intWidth, $intHeight, $intOrigWidth, $intOrigHeight);
        imageJPEG($hldDest, $strDest);
        imageDestroy($hldSource);
        imageDestroy($hldDest);
    }
    return isset($strErrorMsg) ? $strErrorMsg : NULL;
}

#############################################################################
# Function Name: fnGetImageTag()
# Created By: PHP Team   
# Created on: 21  Sep 2005
# Purpose: This function just calculate the best width and height to show big image to user in small format.Ex. if a image is  500x600px. and we want to fit in 60 pixels box then we can call this function as $objImg=fnGetImageTag("image2.jpg",100)
# Parameters: string $strImgPath : Source image path.
#             int $intSize : Size to which we want to restict the image display.
#             string $strLink : If you want to provide anchor tag to image then provide the url here. 
# ON SUCCESS: htmlcode for displaying the image in proper format.     
#############################################################################

function fnGetImageTag($strImgPath, $intSize = "100", $strLink = "") {
    $arrImageInfo = GetImageSize($strImgPath);
    $intWidth = $arrImageInfo[0];
    $intHeight = $arrImageInfo[1];
    $boolChanged = 0;
    if ($intWidth > $intSize) {
        $intFactor = round(($intSize / $intWidth), 2);
        $intWidth = $intSize;
        $intHeight = $intHeight * $intFactor;
        $boolChanged = 1;
    }
    if ($intHeight > $intSize) {
        $intfactor = round(($intSize / $intHeight), 2);
        $intHeight = $intSize;
        $intWidth = $intWidth * $intfactor;
        $boolChanged = 1;
    }
    if ($boolChanged == 0) {
        if ($strLink) {
            $strData = " <a href='$strLink'> <img border=1 bordercolor='FFFFFF' src=\"$strImgPath\"> </a>";
        } else {
            $strData = " <img border=1 bordercolor='FFFFFF' src=\"$strImgPath\">";
        }
    } else {
        if ($strLink) {
            $strData = " <a href='$strLink'> <img width=$intWidth height=$intHeight border=1 bordercolor='FFFFFF' src=\"$strImgPath\"> </a>";
        } else {
            $strData = " <img width=$intWidth height=$intHeight border=1 bordercolor='FFFFFF' src=\"$strImgPath\">";
        }
    }
    return $strData;
}

function DBVar($value) {
    return addslashes($value);
}

function HTMLVar($value) {
    return htmlspecialchars(stripslashes($value), ENT_QUOTES);
}

function fnRedirectUrl($url) {
    if (!headers_sent()) {
        header("Location: $url");
    } else {
        ?>
        <script language="javascript">
            location.href = "<?php echo $url; ?>";
        </script>
        <?php
    }
}

function print_arr($arr) {
    print '<pre>';
    print_r($arr);
    print '</pre>';
}

function getEmailTemplate_org($body) {

    $strTemplate .= '<html>
					   <head></head>
					 <body>
						 <style type="text/css">
						    .header_r{float:right;vertical-align:top;padding-top:0px;padding-right:20px;}
                            .header{width:700px;margin:0;padding:0;background:#4d7195;padding-left:11px;color:#FFF; border-bottom:1px solid #FFF;}                       
                            .logo{margin:0;padding:0;float:left;padding-top:30px;padding-bottom:30px;}
                            .headerfont1{font-size:12px; font-weight:bold; text-align:right;}
                            .headerfont2{font-size:16px; font-weight:bold; text-align:right;padding-top:50px;}
                            .emailBody { border-bottom:1px solid #000;border-left:1px solid #000;border-right:1px solid #000;width:700px;padding:30px;}
                            .clr{margin:0;padding:0;clear:both;}
						 
                         </style>';
    $strTemplate .= '<div class="header">
                        <div class="logo"><a href="#"><img src="' . IMAGE_PATH . 'logo.gif" alt="" border="0"/></a></div>
                        <div class="header_r">
                            <p class="headerfont1"><!--En Espanol-->&nbsp;</p>
                            <p class="headerfont2">1 800 586-1634</p>            
                        </div>
                        <div class="clr"></div>
                        </div>';
    $strTemplate .= '<div class="emailBody">
                         ' . $body . ' 
                     </div>';
    $strTemplate .= ' </body>
					 </html>
					';

    return $strTemplate;
}

function getEmailTemplate() {

    $strTemplate .= '<html>
					   <head></head>
						<body bgcolor="#393d42"  style="margin:0px; font:11px Verdana; line-height:18px;">
						 <style type="text/css">
							td.mailContent { color:#000000; font-family:verdana,arial; font-size:11px }
							table.tblBorder { border:1px solid #000000 }
						 </style>';
    $strTemplate .= ' <table width="800px" border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF" align="center">
					  	<tr><td colspan="2" bgcolor="#393d42" height="20px;">&nbsp;</td></tr>
						<tr>
							<td><img src="' . SERVER_PATH . 'images/email-template_03.jpg" width="327" height="111" alt="" /></td>
							<td width="473"><img src="' . SERVER_PATH . 'images/email-template_04.jpg" width="473" height="111" /></td>
						</tr>
					    <tr>
						 <td><img src="' . SERVER_PATH . 'images/email-template_06.jpg" width="327" height="54" /></td>
						 <td style="background:url(' . SERVER_PATH . 'images/email-template_07.jpg) no-repeat;">&nbsp;</td>
					    </tr>
					    <tr><td colspan="2">&nbsp;</td></tr>
					    <tr>
						<td colspan="2" >
						<table width="96%" border="0" cellspacing="0" cellpadding="0" align="center" style="border:1px solid #e5e4e4;">
						 <tr>
							<td style="font-family:Arial; font-size:24px; border-bottom:1px solid #ad001b; color:#ad001b; font-weight:bold; padding:5px 0 0 5px; line-height:32px">
								EMAIL_HEADER
							</td>
 					     </tr>
				   ';
    $strTemplate .= '<tr><td height="10"></td></tr>';
    $strTemplate .= '<tr>
						<td class="mailContent" style="padding:10px;"> 
							EMAIL_CONTENT	
						</td>
					   </tr>	
				   ';
    $strTemplate .= '<tr><td height="10"></td></tr>';
    $strTemplate .= '<tr>
						<td style="padding:10px;font-family:Verdana;font-size:11px;">Please remember to keep your email address current. We use this address to notify you of your purchase at Toolline.com and other important updates to your account.</td>
					  </tr>
					   <tr>
						<td style="padding:10px;font-size:11px;">For any assistance, feel free to:<br /> 
							- Email us at: info@toolline.com<br />
							- Call us at: 1-800-303-1223 </td>
					  </tr>
					  <tr>
						<td style="padding:10px;font-size:11px;">Sincerely,<br />ToolLine.com</td>
					  </tr>
					  <tr>
						<td>&nbsp;</td>
					  </tr>
					 </table>
					 </td>  
					 </tr>
					
					<tr bgcolor="#FFFFFF">
					  <td align="left"><img src="' . SERVER_PATH . 'images/bottom_left.gif" width="18" height="18" alt="" /></td>
					  <td align="right" width="474px"><img src="' . SERVER_PATH . 'images/bottom_right.gif" width="18" height="18" /></td></tr>
					
					  <tr><td colspan="2" bgcolor="#393d42" height="10px"></td></tr> 
					  <tr>
						<td colspan="2" bgcolor="#393d42" align="center" style="color:#FC0; line-height:24px;font-size:11px;"><a href="http://www.toolline.com/index.php?file=storefront" style="color:#FC0">Go Shopping</a> | <a href="http://www.toolline.com/index.php?file=privacy_policy" style="color:#FC0">Privacy Policy</a> | <a href="http://www.toolline.com/index.php?file=contact_us" style="color:#FC0">Contact us</a> | <a href="http://www.toolline.com/index.php?file=about_us" style="color:#FC0">About Us</a></td>
					  </tr> 
					   <tr bgcolor="#393d42">
						<td  colspan="2" style="font-size:10px; font-family:verdana; color:#FFF; background-color:#393d42; text-align:center; height:30px;">All Images & Content Copyright 2008 ToolLine.com </td>
					  </tr>
				   ';

    $strTemplate .= '  </table>';
    $strTemplate .= ' </body>
					 </html>
					';

    return $strTemplate;
    //die($strTemplate);
}

function getFixedLengthWords($str, $length) {
    $arrWords = explode(" ", $str);
    $trimStr = "";

    foreach ($arrWords as $key => $word) {
        if (strlen($trimStr . " " . $word) <= $length) {
            $trimStr = $trimStr . " " . $word;
        } else {
            break;
        }
    }

    return $trimStr;
}

/**
 * Function Name: getsettingsvalue($key)
 * Created on: 6th November 2008
 * Purpose: To get configuration setting value from the settings table.
 */
function getsettingsvalue($key) {
    global $dbObj;
    $sql = "SELECT value FROM ox_settings WHERE `key` LIKE '$key' AND isactive = 1";
    $details = $dbObj->select($sql);
    return $details[0]['value'];
}
?>