<?php

/* * ******************************************
 * File - emailtemplate.cls.php
 * Created On - 04 March 2013
 * Update On - 
 * Author Name - Abdul Shamadhu
 * Description - Description - This is the class file for performing email templates based queries
 * * ***************************************** */
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

    public function send_mail($from = 'support@acpcomputer.edu.sg', $to = 'abdulshamadhu@gmail.com', $name = 'Name Here', $mailtitle = 'Title Here', $content = 'Message Here...') {
        $mail = new PHPMailer();
        $title = "ACP Computer Email Message";
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
        $mail->Subject = "ACP Computer Email Message";
        echo $message = '
		
		<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
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
							<td style="background-color:#FFFFFF" align="left">
							<img src="http://acpcomputer.edu.sg/templates/acpcomputertrainingconsultancy/images/acplogo.jpg" border="0">
							</td>
						</tr>	
						</table>
						</th>
					  </tr>             
					  <tr> 
						<td><table width="100%" border="0" cellspacing="1" cellpadding="12">					
							
							<tr> 
							  <td bgcolor="#FFFFFF" class="normaltext"><div align="justify" class="normaltextbold"><b>Title</b><br></div></td>
							  <td bgcolor="#FFFFFF" class="normaltext"><div align="left">' . $mailtitle . '</div></td>
							</tr>
							
							<tr> 
							  <td bgcolor="#FFFFFF" class="normaltext"><div align="justify" class="normaltextbold"><b>Message</b><br></div></td>
							  <td bgcolor="#FFFFFF" class="normaltext"><div align="left">' . $content . '</div></td>
							</tr>
							<tr> 
							  <td colspan="2" bgcolor="#FFFFFF" class="normaltext"><div align="justify">If you are not interested in receiving any more messages like this one, go to the <a href="unsubscribe.php?email=' . $to . '">unsubscribe page</a> .</div></td>
							</tr>
							
							<tr > 
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
        exit;
        $mail->Body = $message;
        $mail->Send();
    }

    public function send_group_mail($from = 'support@acpcomputer.edu.sg', $to = 'abdulshamadhu@gmail.com', $name = 'Name Here', $content = 'Message Here...') {
        $mail = new PHPMailer();
        $title = "ACP Computer Email Message";
        global $db, $mybb, $lang;
        if (empty($charset)) {
            $charset = $lang->settings['charset'];
        }
        $mail->IsSMTP(); // set mailer to use SMTP.
        $mail->SetLanguage("en", ""); // Change to your language and upload the appropriate lang file.
        $mail->From = $from; // this adds who it is from.
        $mail->FromName = "Admin";  // this adds your "from" name to the email.
        $mail->Host = "abdulshamadhu@gmail.com"; // your SMTP Server.
        $mail->Mailer = "smtp"; // SMTP Method.
        $mail->IsHTML(true);      // set email format to HTML
        $mail->SMTPAuth = false; // Authorisation required true / false.
        if (count($to) > 0) {
            for ($j = 0; $j < count($to); $j++) {
                if ($j != count($to) - 1)
                    $to_addr = implode(", ", $to);
                else
                    $to_addr = $to;
            }
        }
        if (count($name) > 0) {
            if ($name) {
                $mail->AddAddress($to_addr);
                //$mail->AddAddress("abdulshamadhu.dci@gmail.com");
                $mail->Subject = "ACP Computer Email Message";
                $message = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
					<html xmlns="http://www.w3.org/1999/xhtml">
					<head>
					<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
					<title>ACP Computer Message</title>

					</head>
					<body>
					<table width="564px" cellpadding="0" cellspacing="0" align="center">
					  <tr>
						<td><img src="http://ACP Computer.dci.in/images/header-logo.jpg" width="564" height="132" style="float:left;" /></td>
					  </tr>
					  <tr>
						<td valign="top" colspan="5"><table width="100%" border="0" cellpadding="0" cellspacing="0">
						  <tr>
							<td bgcolor="#00cdf7" width="1"></td>
							<td bgcolor="#eeeeee" width="1"></td>
							<td bgcolor="#FFFFFF" width="560">
							 <table width="560" cellpadding="0" cellspacing="3" border="0">
					  <tr>
						<td width="5" class="h1">&nbsp;</td>
						<td width="541" class="h1" style="font-family:Arial, Helvetica, sans-serif; font-size:16px; color:#575757; font-weight:bold;">Dear ' . $name . ',</td>
						<td width="5" class="h1">&nbsp;</td>
					  </tr>
					  <tr>
						<td class="h1"></td>
						<td class="h1" height="10" style="font-family:Arial, Helvetica, sans-serif; font-size:16px; color:#575757; font-weight:bold;"></td>
						<td class="h1"></td>
					  </tr>
					  <tr>
						<td class="h1"></td>
						<td class="h1" style="font-family:Arial, Helvetica, sans-serif; font-size:16px; color:#575757; font-weight:bold;">' . $content . '</td>
						<td class="h1"></td>
					  </tr>
					  <tr>
						<td class="h1"></td>
						<td class="h1" height="10" style="font-family:Arial, Helvetica, sans-serif; font-size:16px; color:#575757; font-weight:bold;"></td>
						<td class="h1"></td>
					  </tr>
					  <tr>
						<td class="h1"></td>
						<td class="h1" style="font-family:Arial, Helvetica, sans-serif; font-size:16px; color:#575757; font-weight:bold;">Sincerely, <br />
					ACP Computer Team</td>
						<td class="h1">&nbsp;</td>
					  </tr>
					</table>

							</td>
							<td bgcolor="#eeeeee" width="1"></td>
							<td bgcolor="#00cdf7" width="1"></td>
						  </tr>
						</table></td>
					  </tr>
					  <tr>
						<td>
						<table width="100%" border="0" cellpadding="0" cellspacing="0">
						  <tr>
							<td bgcolor="#00cdf7" width="1"></td>
							<td bgcolor="#eeeeee" width="1"></td>
							<td bgcolor="#FFFFFF" width="560">
							 <table width="560" cellpadding="0" cellspacing="0" border="0" style="border-collapse:collapse;">
							 <tr><td height="1" colspan="3" bgcolor="#eeeeee"></td></tr>
					  <tr>
						<td height="5" colspan="3" class="attention">&nbsp;</td>
						</tr>
					  <tr>
						<td width="10" class="attention">&nbsp;</td>
						<td width="540" class="attention" style="font-family:Arial, Helvetica, sans-serif; font-size:13px; color: #f31111;">Attention: Protect Yourself from online fraud.<br />
					ACP Computer does NOT initiate emails seeking personal information such as a account numbers,
					Social Security numbers, ID numbers, Bank account numbers, or any other sensitive
					information. If you receive a suspicious email, please forward it to <a  style="cursor:pointer; color: #f31111;" href="mailto:support@acpcomputer.edu.sg">support@acpcomputer.edu.sg</a></td>
						<td width="10" class="attention">&nbsp;</td>
					  </tr>
					  <tr>
						<td height="5" colspan="3" class="attention">&nbsp;</td>
						</tr>
							  <tr><td height="1" colspan="3" bgcolor="#eeeeee"></td></tr>
					</table>

							</td>
							<td bgcolor="#eeeeee" width="1"></td>
							<td bgcolor="#00cdf7" width="1"></td>
						  </tr>
						</table>
						</td>
					  </tr>
					  <tr>
						<td><table width="100%" border="0" cellpadding="0" cellspacing="0">
						  <tr>
							<td bgcolor="#00cdf7" width="1"></td>
							<td bgcolor="#eeeeee" width="1"></td>
							<td bgcolor="#FFFFFF" width="560">
							  <img src="http://ACP Computer.dci.in/images/footer-logo.jpg" width="560" height="115" style="float:left;"/></td>
							<td bgcolor="#eeeeee" width="1"></td>
							<td bgcolor="#00cdf7" width="1"></td>
						  </tr>
						</table></td>
					  </tr>
					  <tr>
						<td><table width="100%" border="0" cellpadding="0" cellspacing="0">
						  <tr>
							<td width="1" rowspan="3" bgcolor="#00cdf7"></td>
							<td width="1" rowspan="3" bgcolor="#eeeeee"></td>
							<td colspan="3" bgcolor="#FFFFFF" class="copyrights">&nbsp;</td>
							<td width="1" rowspan="3" bgcolor="#eeeeee"></td>
							<td width="1" rowspan="3" bgcolor="#00cdf7"></td>
						  </tr>
						  <tr>
							<td width="10" bgcolor="#FFFFFF" class="copyrights">&nbsp;</td>
							<td width="540"  bgcolor="#FFFFFF" class="copyrights" style="font-family:Arial, Helvetica, sans-serif; font-size:13px;">Please do not respond to this email. If you have any questions regarding your
					ACP Computer<br/> user account please contact your Property Manager/Landlord.
					ACP Computer Logo,<br/> <a style="color:#343499;"href="http://www.acpcomputer.edu.sg">www.acpcomputer.edu.sg</a> are all registered trademarks of Ecom
					Corporation &copy; Copyright ACP Computer. ACP Computer Powered By ECOM CORPORATION
					520 White Plains Road, Suite 500, Tarrytown, 10591 All rights reserved </td>
							<td width="10" bgcolor="#FFFFFF" class="copyrights">&nbsp;</td>
						  </tr>
						  <tr>
							<td colspan="3" bgcolor="#FFFFFF" class="copyrights">&nbsp;</td>
							</tr>
						</table></td>
					  </tr>
					  <tr>
						<td>
						<table width="100%" border="0" cellpadding="0" cellspacing="0" style="border-bottom: 1.5px solid #00CDF7;">
						  <tr>
							<td bgcolor="#00cdf7" width="1"></td>
							<td bgcolor="#eeeeee" width="1"></td>
							<td bgcolor="#007ec7" height="35" width="560">
							 <table width="100%" border="0" cellpadding="0" cellspacing="0" >
					  <tr>
						<td width="34%" align="center" style="color:#FFF; font-size:13px; font-family:Arial, Helvetica, sans-serif;"><a style="color:#FFF;"href="http://www.acpcomputer.edu.sg">WWW.acpcomputer.edu.sg</a></td>
						<td width="31%" align="center" style="color:#FFF; font-size:13px; font-family:Arial, Helvetica, sans-serif;">Copyright &copy; ACP Computer. <br />All rights reserved</td>
						<td width="35%" align="center" style="color:#FFF; font-size:13px; font-family:Arial, Helvetica, sans-serif;">Powered by ecom</td>
					  </tr>
					</table>

							  </td>
							<td bgcolor="#eeeeee" width="1"></td>
							<td bgcolor="#00cdf7" width="1"></td>
						  </tr>
						</table>
						</td>
					  </tr>
					  
					</table>

					</body>
					</html>';
                $mail->Body = $message;
                $mail->Send();
            }
        }
    }

}

// END emailtemplate Class

/* End of file emailtemplate.cls.php */
/* Location: ./class/emailtemplate.cls.php */
