<?php

/* * ******************************************
 * File - emailtemplates.cls.php
 * Created On - 04 March 2013
 * Update On - 
 * Author Name - Abdul Shamadhu
 * Description - This is the class file for performing email based queries
 * ****************************************** */
include("class.phpmailer.php");

/**
 * Class Emailtemplate used as template to send the email
 * @package 
 * @subpackage Emailtemplate
 * @author Abdul Shamadhu
 */
class Emailtemplate {

    /**
     * Sets the credentials for email template
     *
     * @param	string	From address
     * @param	string	To address
     * @param	string	content
     * @return	void
     */
    public function __construct() {
        
    }

    public function send_mail($from = 'support@acpcomputer.edu.sg', $user_id = '', $to = 'abdulshamadhu@gmail.com', $name = 'Name Here', $mailtitle = 'Subscription Title', $content = 'Message Here...') {
        $mail = new PHPMailer();
        $title = "ACP Computer Subscription Email Message";
        global $db, $mybb, $lang;
        if (empty($charset)) {
            $charset = $lang->settings['charset'];
        }
        $mail->IsSMTP(); // set mailer to use SMTP.
        $mail->SetLanguage("en", ""); // Change to your language and upload the appropriate lang file.
        $mail->From = $from; // this adds who it is from.
        $mail->FromName = "Admin";  // this adds your "from" name to the email.
        $mail->Host = "abdulshamadhu@gmail.com"; // your SMTP Server.
        $mail->Mailer = "mail"; // SMTP Method.
        $mail->IsHTML(true);      // set email format to HTML
        $mail->SMTPAuth = false; // Authorisation required true / false.
        $mail->AddAddress($to);
        $mail->Subject = "ACP Computer - " . $mailtitle;
        $user_id = base64_encode($user_id);

        $pageURL = 'http';
        if ($_SERVER["HTTPS"] == "on") {
            $pageURL .= "s";
        }
        $pageURL .= "://";
        if ($_SERVER["SERVER_PORT"] != "80") {
            $pageURL .= $_SERVER["SERVER_NAME"] . ":" . $_SERVER["SERVER_PORT"] . $_SERVER["REQUEST_URI"];
        } else {
            $pageURL .= $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];
        }

        $activation_url = $pageURL;
        $exp = explode("?", $activation_url);
        $active_url = $exp[0];
        $active_url = str_replace("admin/", "", $active_url);
        $message = '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
			<html>
			<head>
			<title>Untitled Document</title>
			<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
			<style type="text/css">
			.boldheading {
			font-family: Verdana;
			font-size: 12px;
			font-style: normal;
			font-weight: bold;
			color: #0000000;
			}
			.normaltext {
			font-family: Verdana;
			font-size: 14px;
			font-style: normal;
			font-weight: normal;
			color: #0000000;
			}
			.normaltextbold {
			font-family: Verdana;
			font-size: 14px;
			font-style: normal;
			font-weight: bold;
			color: #0000000;
			}

			.unnamed1 {
			font-family: Verdana;
			font-size: 10px;
			font-style: normal;
			font-weight: bold;
			color: #FFFFFF;
			}

			.unnamed2 {
			font-family: Verdana;
			font-size: 10px;
			font-style: normal;
			font-weight: bold;
			color: #000000;
			}
			.unnamed3 {
			font-family: Verdana;
			font-size: 10px;
			font-style: normal;
			font-weight: bold;
			color: #FF0000;
			}
			.unnamed4 {
			font-family: Verdana, Arial, Helvetica, sans-serif;
			font-size: 11px;
			font-style: normal;
			font-weight: normal;
			color: #000000;
			font-variant: normal;
			}

			.general {
			font-family: Verdana;
			font-size: 15px;
			font-style: normal;
			font-weight: bold;
			color: #FFFFFF;
			}
			.tableheading {
			font-family: Verdana;
			font-size: 12px;
			font-style: normal;
			font-weight: bold;
			color: #FFFFFF;
			}
			.tablebothcolumn {
			font-family: Verdana;
			font-size: 12px;
			font-style: normal;
			font-weight: normal;
			color: #FFFFFF;
			}

			body {
			font-family: Verdana;
			font-size: 10px;
			font-style: normal;
			font-weight: normal;
			color: #000000;
			}
			.th{
			font-family: Verdana;
			font-size: 10px;
			font-style: normal;
			font-weight: bold;
			color: #FFFFFF;
			}
			.style2 {color: #FFFFFF}
			.style3 {font-size: 12px}
			.style5 {
			font-size: 10px;
			font-weight: bold;
			color: #FF0000;
			}
			</style>
			</head>
			<body>
			<table style="border:1px solid grey;" width="560" border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="EEEEEE">
			<tr>
			<td><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
				<tr> 
				  <td><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
					  <tr class="unnamed1"> 
						<th>
						<table width="100%"  border="0" cellspacing="0" cellpadding="0">
						  <tr>
							<td style="background-color:#F2F0F1" align="left">
							<img src="http://acpcomputer.edu.sg/templates/acpcomputertrainingconsultancy/images/acplogo.jpg" border="0">
							</td>
						</tr>	
						</table>
						</th>
					  </tr>             
					  <tr> 
						<td><table width="100%" border="0" cellspacing="1" cellpadding="12">
							<tr class="unnamed2"> 
							  <td width="32%" bgcolor="#FFFFFF"><div align="right" class="unnamed2"></div></td>
							  <td width="68%" bgcolor="#FFFFFF"><div align="right" class="unnamed2"></div></td>
							</tr>
							
							<tr> 
							  <td bgcolor="#FFFFFF" colspan="2" class="normaltext"><div align="justify" style="font-size:14px;">Dear ' . $name . ',</div></td>
							</tr>
							
							<tr> 
							  <td bgcolor="#FFFFFF" class="normaltext"><div align="justify" class="normaltextbold"><b>Title</b><br></div></td>
							  <td bgcolor="#FFFFFF" class="normaltext"><div align="left">' . $mailtitle . '</div></td>
							</tr>
							
							<tr> 
							  <td bgcolor="#FFFFFF" class="normaltext"><div align="justify" class="normaltextbold"><b>Message</b><br></div></td>
							  <td bgcolor="#FFFFFF" class="normaltext"><div align="left">' . $content . '</div></td>
							</tr>
							
							<tr> 
							  <td bgcolor="#FFFFFF" colspan="2" class="normaltext"><div align="justify" style="font-size:9px;">							  
							  This message was sent to ' . $from . ' If you dont want to receive these emails from ACP in the future, please <a href="' . $active_url . '?file=unsubscribe&user_id=' . $user_id . '">unsubscribe</a>. 
							  </div></td>
							</tr>

							<tr> 
							  <td bgcolor="#FFFFFF">&nbsp;</td>
							  <td bgcolor="#FFFFFF">&nbsp;</td>
							</tr>
						  </table></td>
					  </tr>
					  <tr bgcolor="#130B32"> 
						<td colspan="11" align="center"><p class="copy-right" style="color:white;">Copyright © ACP Computer Training &amp; Consultancy Pte. Ltd.</p></td>
					  </tr>
					</table></td>
				</tr>
			  </table></td>
			</tr>
			</table>
			</body>
			</html>';

        $mail->Body = $message;
        $mail->Send();
    }

}

// END emailtemplate Class

/* End of file emailtemplate.cls.php */
/* Location: ./class/emailtemplate.cls.php */
