<?php

/* * ******************************************
 * File - registration.cls.php
 * Created On - 04 March 2013
 * Update On - 
 * Author Name - Abdul Shamadhu
 * Description - Description - This is the class file for performing user register based queries
 * * ***************************************** */

function validateEmpty($name) {
    //if it's NOT valid
    if (strlen($name) < 1)
        return false;
    //if it's valid
    else
        return true;
}

function validateEmail($email) {
    return preg_match('/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/', $email);
}

function validatePasswords($pass1, $pass2) {
    //if DOESN'T MATCH
    if (strpos($pass1, ' ') !== false)
        return false;
    //if are valid
    return $pass1 == $pass2 && strlen($pass1) >= 5;
}

function store_registration_application($firstname, $lastname, $email, $password, $subscription) {
    $db = new dbclass();
    global $dbObj, $pass_key;
    $result = $db->select("select email from tbl_users where email='" . $email . "'");
    $user_email = $result[0]['email'];
    $encrypted = base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5($pass_key), $password, MCRYPT_MODE_CBC, md5(md5($pass_key))));
    if ($user_email != $email) {
        $db->insert("insert into tbl_users (firstname,lastname,email,password,subscription,created_on,status) values ('" . $firstname . "','" . $lastname . "','" . $email . "','" . $encrypted . "','" . $subscription . "',now(),0)");
        $user_id = mysql_insert_id();
        sent_mail($user_id, $firstname, $lastname, $email, $password);
        header('Location: index.php?file=thankyou');
    } else {
        return "Email address already exist.";
    }
    $db->close();
}

function sent_mail($user_id, $firstname, $lastname, $email, $password) {
    require_once("class.phpmailer.php");
    $mail = new PHPMailer();
    $title = "Registration Details and Activation Link";
    global $db, $mybb, $lang;
    if (empty($charset)) {
        $charset = $lang->settings['charset'];
    }
    $mail->IsSMTP(); // set mailer to use SMTP.
    $mail->SetLanguage("en", ""); // Change to your language and upload the appropriate lang file.
    $mail->From = "support@acpcomputer.edu.sg"; // this adds who it is from.
    $mail->FromName = "ACP Computer Training & Consultancy Pte. Ltd.";  // this adds your "from" name to the email.
    $mail->Host = "abdulshamadhu@gmail.com"; // your SMTP Server.
    $mail->Mailer = "smtp"; // SMTP Method.
    $mail->IsHTML(true);      // set email format to HTML
    $mail->SMTPAuth = false; // Authorisation required true / false.
    $mail->Subject = "ACP : Registration Details and Activation Link";
    $user_id = base64_encode($user_id);
    $activation_url = curPageURL();
    $exp = explode("?", $activation_url);
    $active_url = $exp[0];
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
							  <td bgcolor="#FFFFFF" colspan="2" class="normaltext"><div align="justify" style="font-size:14px;">Dear ' . $firstname . ',</div></td>
							</tr>
							
							<tr> 
							  <td bgcolor="#FFFFFF" class="normaltext"><div align="justify" class="normaltextbold"><b>First Name</b><br></div></td>
							  <td bgcolor="#FFFFFF" class="normaltext"><div align="left">' . $firstname . '</div></td>
							</tr>
							
							<tr> 
							  <td bgcolor="#FFFFFF" class="normaltext"><div align="justify" class="normaltextbold"><b>Last Name</b><br></div></td>
							  <td bgcolor="#FFFFFF" class="normaltext"><div align="left">' . $lastname . '</div></td>
							</tr>
							
							<tr> 
							  <td bgcolor="#FFFFFF" class="normaltext"><div align="justify" class="normaltextbold"><b>Email</b><br></div></td>
							  <td bgcolor="#FFFFFF" class="normaltext"><div align="left">' . $email . '</div></td>
							</tr>
							
							<tr> 
							  <td bgcolor="#FFFFFF" class="normaltext"><div align="justify" class="normaltextbold"><b>Password</b><br></div></td>
							  <td bgcolor="#FFFFFF" class="normaltext"><div align="left">' . $password . '</div></td>
							</tr>
							
							<tr> 
							  <td bgcolor="#FFFFFF" class="normaltext"><div align="justify" class="normaltextbold"><b>Activation Link</b><br></div></td>
							  <td bgcolor="#FFFFFF" class="normaltext"><div align="left"><a href="' . $active_url . '?file=active&user_id=' . $user_id . '">' . $active_url . '?file=active&user_id=' . $user_id . '</a></div></td>
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

    //header( 'Location: thankyou.php' );
}

function curPageURL() {
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
    return $pageURL;
}

?>
