<?php

/**
 * request input
 * 
 * class used for get, post, cookie, session request handling
 * 
 * @package framework
 */
class request {

    /**
     * gets variable
     *
     * @param string $var variable name to get
     * @param mixed $default default value if variable not found
     * @param string $from G - get, P - post, C - cookie
     * @param string $ereg regular expresion that variable must pass
     * @param bool $addslashes
     * @return mixed variable value
     */
    public static function get($var, $default = '', $from = 'RGPCS', $dontclean = false) {
        // loop through superglobals array
        for ($i = 0, $k = strlen($from); $i < $k; $i++) {
            //check for array variable like data[username]
            if (preg_match("/.*?(\[.*?\]).*/", $var, $match)) {
                $param = substr(substr($match['1'], 1), 0, -1);
                $var = str_replace($match['1'], '', $var);
            }//if
            $t = substr($from, $i, 1);
            switch ($t) {
                case 'R':
                    if (isset($_REQUEST[$var]) and $_REQUEST[$var] != '') {
                        //if param exist get variable from array
                        if (isset($param) and $param != '') {
                            $return = $_REQUEST[$var][$param];
                        } else {
                            $return = $_REQUEST[$var];
                        }//if
                    }// if
                    break;
                case 'G':
                    if (isset($_GET[$var]) and $_GET[$var] != '') {
                        //if param exist get variable from array
                        if (isset($param) and $param != '') {
                            $return = $_GET[$var][$param];
                        } else {
                            $return = $_GET[$var];
                        }//if
                    }// if
                    break;
                case 'P':
                    if (isset($_POST[$var]) and $_POST[$var] != '') {
                        //if param exist get variable from array
                        if (isset($param) and $param != '') {
                            if (isset($_POST[$var][$param])) {
                                $return = $_POST[$var][$param];
                            }// if
                        } else {
                            $return = $_POST[$var];
                        }//if
                    }// if
                    break;
                case 'C':
                    if (isset($_COOKIE[$var]) and $_COOKIE[$var] != '') {
                        //if param exist get variable from array
                        if (isset($param) and $param != '') {
                            $return = $_COOKIE[$var][$param];
                        } else {
                            $return = $_COOKIE[$var];
                        }//if
                    }// if
                    break;
                case 'S':
                    if (isset($_SERVER[$var]) and $_SERVER[$var] != '') {
                        //if param exist get variable from array
                        if (isset($param) and $param != '') {
                            $return = $_SERVER[$var][$param];
                        } else {
                            $return = $_SERVER[$var];
                        }//if
                    }// if
                    break;
            }//switch
            if (isset($return)) {
                break;
            }// if
        }//for

        if (!isset($return)) {
            $return = $default;
        }// if
        //return $dontclean ? $return : self::clean($return);
        return $return;
    }

//function get

    /**
     * get $_POST count
     *
     * @return int post count
     */
    public function countPost() {
        return count($_POST);
    }

//countPost

    /**
     * cleans up user input
     *
     * @param mixed $input input data to be cleaned
     * @return mixed cleaned input
     * @see sanitizeReq
     */
    public static function clean($input) {
        static $sanitizeReq;

        if (is_null($sanitizeReq)) {
            $sanitizeReq = new sanitizeReq();
        }// if

        if (is_array($input)) {
            $cleanRet = array();
            foreach ($input as $k => $v) {
                $cleanRet[$k] = self::clean($v);
            }// foreach
        } else {
            $sanitizeReq->clear();
            $cleanRet = $sanitizeReq->parse($input);
        }//else

        return $cleanRet;
    }

// _clean

    /**
     * send redirection header and finish script execution
     *
     * @param string $url url to redirect
     */
    public static function redirect($url) {
        if (preg_match('!^http!', $url)) {
            // absolute URL - simple redirect
            header("location: $rurl");
        } else {
            // removing leading slashes from redirect url
            $url = preg_replace('!^/*!', '', $url);

            // get base URL
            $baseurl = build_http_path();

            header("location: $baseurl$url");
        }//else

        exit();
    }

// redirect

    /**
     * gets variable
     *
     * @param string $var variable name to get
     * @param mixed $default default value if variable not found
     * @param string $from G - get, P - post, C - cookie
     * @param string $ereg regular expresion that variable must pass
     * @param bool $addslashes
     * @return mixed variable value
     */

    /**
     * get variable from log
     *
     * @param Log $log Log object
     * @param string $var name of variable to get
     * @param mixed $default default value if variable not found
     * @param string $from name of G - get, P - post, C - cookie, s - session
     * @param bool $dontclean flag: if true then variable is not cleaned and is returned as is
     * @return mixed
     */
    public static function getFromLogs($log, $var, $default = '', $from = 'GPCS', $dontclean = false) {
        $logs_get = ($log->GetField('get'));
        $logs_post = ($log->GetField('post'));
        for ($i = 0, $k = strlen($from); $i < $k; $i++) {
            $t = substr($from, $i, 1);
            switch ($t) {
                case 'G':
                    if (isset($logs_get[$var]) and $logs_get[$var] != '') {
                        $return = $logs_get[$var];
                    }// if
                    break;
                case 'P':
                    if (isset($logs_post[$var]) and $logs_post[$var] != '') {
                        $return = $logs_post[$var];
                    }// if
                    break;
                case 'C':
                    if (isset($logs_cookie[$var]) and $logs_cookie[$var] != '') {
                        $return = $logs_cookie[$var];
                    }// if
                    break;
                case 'S':
                    if (isset($logs_session[$var]) and $logs_session[$var] != '') {
                        $return = $logs_session[$var];
                    }// if
                    break;
            }//switch
            if (isset($return)) {
                break;
            }// if
        }//for

        if (!isset($return)) {
            $return = $default;
        }// if

        return $dontclean ? $return : self::clean($return);
    }

//function get
}

// class Request
?>
