<?php

/* * ******************************************
 * File - forgot.cls.php
 * Created On - 04 March 2013
 * Update On - 
 * Author Name - Abdul Shamadhu
 * Description - Description - This is the class file for performing forgot password based queries
 * * ***************************************** */

function validateEmail($email) {
    return @ereg("^[a-zA-Z0-9]+[a-zA-Z0-9_.-]+[a-zA-Z0-9_-]+@[a-zA-Z0-9]+[a-zA-Z0-9.-]+[a-zA-Z0-9]+.[a-z]{2,4}$", $email);
}

function forgot_verification($email) {
    global $dbObj, $pass_key;
    $result = $dbObj->select("select email,password from tbl_users where email='" . $email . "' and status=1");
    $email1 = $result[0]['email'];
    $password = $result[0]['password'];
    $decrypted = rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5($pass_key), base64_decode($password), MCRYPT_MODE_CBC, md5(md5($pass_key))), "\0");
    if ($email == $email1) {
        sent_mail($email, $decrypted);
        header('Location: index.php?file=forgotsuccess');
    } else {
        header('Location: index.php?file=forgotfailure');
    }
}

function sent_mail($email = '', $password = '') {

    include("class.phpmailer.php");

    $mail = new PHPMailer();
    $title = "ACP Computer:Forgot Password";
    global $db, $mybb, $lang;
    if (empty($charset)) {
        $charset = $lang->settings['charset'];
    }
    $mail->IsSMTP(); // set mailer to use SMTP.
    $mail->SetLanguage("en", ""); // Change to your language and upload the appropriate lang file.
    $mail->From = "support@acpcomputer.edu.sg"; // this adds who it is from.
    $mail->FromName = "Admin";  // this adds your "from" name to the email.
    $mail->Host = "abdulshamadhu@gmail.com"; // your SMTP Server.
    $mail->Mailer = "mail"; // SMTP Method.
    $mail->IsHTML(true);      // set email format to HTML
    $mail->SMTPAuth = false; // Authorisation required true / false.
    $mail->AddAddress($email);
    $mail->Subject = "ACP Computer:Forgot Password";

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
							<td style="background-color:#F2F0F1" align="left"><img src="http://acpcomputer.edu.sg/templates/acpcomputertrainingconsultancy/images/acplogo.jpg" border="0"></td>
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
							  <td bgcolor="#FFFFFF" class="normaltext"><div align="justify" class="normaltextbold"><b>Email</b><br></div></td>
							  <td bgcolor="#FFFFFF" class="normaltext"><div align="left">' . $email . '</div></td>
							</tr>
							
							<tr> 
							  <td bgcolor="#FFFFFF" class="normaltext"><div align="justify" class="normaltextbold"><b>Password </b><br></div></td>
							  <td bgcolor="#FFFFFF" class="normaltext"><div align="left">' . $password . '</div></td>
							</tr>
							
							<tr> 
							  <td bgcolor="#FFFFFF">&nbsp;</td>
						  	  <td bgcolor="#FFFFFF" class="normaltext"><div align="left" style="color:red;"> Warning: This email contains your password. It is very Important to protect your account, Please 
						  change your password by going to My Profile and click change password. Delete this email once you receive it. Thank you for choosing ACP Computer.</div></td>
							</tr>
							
						  </table></td>
					  </tr>
					  <tr bgcolor="#130B32"> 
						<td colspan="11" align="center"><p class="copy-right" style="color:white;">Copyright &copy; All Rights Reserved.</p></td>
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

    //header( 'Location: thankyou.php' );
}

?>
