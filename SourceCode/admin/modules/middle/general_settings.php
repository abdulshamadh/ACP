<?php
/* * ******************************************
 * File - general_setting.php
 * Created On - 04 March 2013
 * Update On - 
 * Author Name - Abdul Shamadhu
 * Description - This is the php file for performing general setting based files
 * ****************************************** */
/* NO ENTRY file for authorized users only */
require_once('no_entry.php');

/* Admin class file to handle admin related functions */
include_once(SERVER_ROOT_PATH . 'admin/class/admin.cls.php');
$objAdmin = new Admin($dbObj);

/* Validation class file to handle server side validations */
require_once(SERVER_ROOT_PATH . 'admin/class/validation.cls.php');
$validate = new validation();

$formdatacnt = Request::countPost();

// IF condition
if ($formdatacnt) {
    $errors = $validate->validateGeneralSettings();
    if (is_array($errors) and count($errors) > 0) {
        $errors = $errors;
        $post_value = $_POST;
    } else {
        $check = $objAdmin->changeGeneralSettings();
        if ($check) {
            $update_msg = $lang['T_ADMIN_GS_CHANGE_MSG'];
        }
    }
} // End IF

$generalSettings = $objAdmin->getGeneralSettings();  // code to get the general settings from the database

$settings = array();
foreach ($generalSettings as $key => $value) {
    $settings[$value['key']] = $value['value'];
}

$loginDetails = $_SESSION;
?>
<script type="text/javascript" language="javascript">
    {literal}
    function validateGeneralSettings(frmObj)
    {
    if (isBlank(Trim(frmObj.ADMIN_MAIL.value)))
    {
    alert('Please enter email address');
            frmObj.ADMIN_MAIL.focus();
            return false;
    }
    else
    {
    if (!isValidEmail(frmObj.ADMIN_MAIL.value))
    {
    alert('Please enter a valid email address');
            frmObj.ADMIN_MAIL.focus();
            return false;
    }
    }

    if (isBlank(Trim(frmObj.SMTP_HOST.value)))
    {
    alert('SMTP host can not be blank');
            frmObj.SMTP_HOST.focus();
            return false;
    }

    if (isBlank(Trim(frmObj.SMTP_USERNAME.value)))
    {
    alert('SMTP username can not be blank');
            frmObj.SMTP_USERNAME.focus();
            return false;
    }
    /* changed by f start*/
    if (validatePassword(Trim(frmObj.SMTP_PASSWORD.value)) != true)
    {
    alert(validatePassword(Trim(frmObj.SMTP_PASSWORD.value)));
            frmObj.SMTP_PASSWORD.focus();
            return false;
    }
    /* changed by f end*/
    if (isBlank(Trim(frmObj.SMTP_PORT.value)))
    {
    alert('SMTP port can not be blank');
            frmObj.SMTP_PORT.focus();
            return false;
    }
    if (isBlank(Trim(frmObj.PAYPAL_EMAIL_ID.value)))
    {
    alert('Paypal email id can not be blank');
            frmObj.PAYPAL_EMAIL_ID.focus();
            return false;
    }
    if (isBlank(Trim(frmObj.AUTHORIZED_LOGIN_ID.value)))
    {
    alert('Authorize login id can not be blank');
            frmObj.AUTHORIZED_LOGIN_ID.focus();
            return false;
    }
    if (isBlank(Trim(frmObj.AUTHORIZED_TRANSACTION_KEY.value)))
    {
    alert('Authorize transaction key can not be blank');
            frmObj.AUTHORIZED_TRANSACTION_KEY.focus();
            return false;
    }
    }
    {/literal}
</script>
<div class="middle" style="padding-top:30px;padding-left:200px;"> 
    <div class="help_class" style="width: 600px;">This section will add/edit the general configuration of your site. The fields and options presented below enable you to control the site operations like email details and payment gateway information.</div>
    <br />
    <div class="contentfont" align="left">
        <fieldset style="width: 600px;" class="fieldsetBorder">
            <legend>
                <span class="CSNpageTitle">{$lang.T_ADMIN_GENERAL_SETTINGS}</span>
            </legend>
            <div class="contentfont" align="center" style="padding:5px;border:0px solid red;"><span class="mandatory"><strong>{$update_msg}</strong></span></div> 
            <form name="frmGeneralSettings" id="frmGeneralSettings" method="post" action="<?php echo $SERVER_PATH; ?>index.php?file=general_settings" onsubmit="return validateGeneralSettings(frmGeneralSettings);">
                <div class="registration" style="width:550px;">

                    <div class="contentfont" style="border:0px solid red;width:120px;float: left;"><span class="mandatory">*</span> {$lang.T_ADMIN_GENERAL_FIELD_EMAIL}</div>        
                    <div class="contentfont" style="width:410px;float: right;">
                        <div style="width:150px;float: left;">
                            <input type="text" name="ADMIN_MAIL" id="ADMIN_MAIL" class="input" value="{$settings.ADMIN_MAIL}"/>
                        </div>
                        <div class="mandatory" style="width:250px;float: right;">
                            {if $errors.ADMIN_MAIL neq ''}
                            <img src="{$IMAGE_PATH}error.gif" align="top" width="20" height="20" alt="ERROR"/>&nbsp;
                            {/if}
                            {$errors.ADMIN_MAIL}
                        </div>                          
                    </div>
                    <div style="padding:20px;"></div>


                    <div class="contentfont" style="border:0px solid red;width:120px;float: left;"><span class="mandatory">*</span> {$lang.T_ADMIN_GENERAL_FIELD_SMTP_HOST}</div>        
                    <div class="contentfont" style="width:410px;float: right;">
                        <div style="width:150px;float: left;">
                            <input type="text" name="SMTP_HOST" id="SMTP_HOST" class="input" value="{$settings.SMTP_HOST}"/>
                        </div>
                        <div class="mandatory" style="width:250px;float: right;">
                            {if $errors.SMTP_HOST neq ''}
                            <img src="{$IMAGE_PATH}error.gif" align="top" width="20" height="20" alt="ERROR"/>&nbsp;
                            {/if}
                            {$errors.SMTP_HOST}
                        </div>                          
                    </div>
                    <div class="clr"></div>
                    <div style="padding:10px;"></div>

                    <div class="contentfont" style="border:0px solid red;width:130px;float: left;"><span class="mandatory">*</span> {$lang.T_ADMIN_GENERAL_FIELD_SMTP_USER_NAME}</div>        
                    <div class="contentfont" style="width:410px;float: right;">
                        <div style="width:150px;float: left;">
                            <input type="text" name="SMTP_USERNAME" id="SMTP_USERNAME" class="input" value="{$settings.SMTP_USERNAME}"/>
                        </div>
                        <div class="mandatory" style="width:250px;float: right;">
                            {if $errors.SMTP_USERNAME neq ''}
                            <img src="{$IMAGE_PATH}error.gif" align="top" width="20" height="20" alt="ERROR"/>&nbsp;
                            {/if}
                            {$errors.SMTP_USERNAME}
                        </div>                          
                    </div>
                    <div class="clr"></div>
                    <div style="padding:10px;"></div>


                    <div class="contentfont" style="border:0px solid red;width:130px;float: left;"><span class="mandatory">*</span> {$lang.T_ADMIN_GENERAL_FIELD_SMTP_PASS_WORD}</div>        
                    <div class="contentfont" style="width:410px;float: right;">
                        <div style="width:150px;float: left;">
                            <input type="text" name="SMTP_PASSWORD" id="SMTP_PASSWORD" class="input" value="{$settings.SMTP_PASSWORD}"/>
                        </div>
                        <div class="mandatory" style="width:250px;float: right;">
                            {if $errors.SMTP_PASSWORD neq ''}
                            <img src="{$IMAGE_PATH}error.gif" align="top" width="20" height="20" alt="ERROR"/>&nbsp;
                            {/if}
                            {$errors.SMTP_PASSWORD}
                        </div>                          
                    </div>
                    <div class="clr"></div>
                    <div style="padding:10px;"></div>

                    <div class="contentfont" style="border:0px solid red;width:130px;float: left;"><span class="mandatory">*</span> {$lang.T_ADMIN_GENERAL_FIELD_SMTP_PORT}</div>        
                    <div class="contentfont" style="width:410px;float: right;">
                        <div style="width:150px;float: left;">
                            <input type="text" name="SMTP_PORT" id="SMTP_PORT" class="input" value="{$settings.SMTP_PORT}"/>
                        </div>
                        <div class="mandatory" style="width:250px;float: right;">
                            {if $errors.SMTP_PORT neq ''}
                            <img src="{$IMAGE_PATH}error.gif" align="top" width="20" height="20" alt="ERROR"/>&nbsp;
                            {/if}
                            {$errors.SMTP_PORT}
                        </div>                          
                    </div>
                    <div class="clr"></div>
                    <div style="padding:10px;"></div> 

                    <div class="contentfont" style="border:0px solid red;width:210px;float: left;"><span class="mandatory">*</span> {$lang.T_ADMIN_PAYPAL_SETTING_URL}</div>        
                    <div class="contentfont" style="width:330px;float: right;border:0px solid red;">
                        <div style="width:150px;float: left;">
                            <input type="text" name="PAYPAL_EMAIL_ID" id="PAYPAL_EMAIL_ID" class="input" value="{$settings.PAYPAL_EMAIL_ID}" size="25"/>
                        </div>
                    </div>
                    <div class="mandatory" style="width:330px;float: right;border:0px solid red;">
                        {if $errors.PAYPAL_EMAIL_ID neq ''}
                        <img src="{$IMAGE_PATH}error.gif" align="top" width="20" height="20" alt="ERROR"/>&nbsp;
                        {/if}
                        {$errors.PAYPAL_EMAIL_ID}
                    </div>
                    <div class="clr"></div>
                    <div style="padding:10px;"></div>

                    <div class="contentfont" style="border:0px solid red;width:210px;float: left;"><span class="mandatory">*</span> Authorized Login Id:</div>        
                    <div class="contentfont" style="width:330px;float: right;border:0px solid red;">
                        <div style="width:150px;float: left;">
                            <input type="text" name="AUTHORIZED_LOGIN_ID" id="AUTHORIZED_LOGIN_ID" class="input" value="{$settings.AUTHORIZED_LOGIN_ID}" size="25"/>
                        </div>
                    </div>
                    <div class="mandatory" style="width:330px;float: right;border:0px solid red;">
                        {if $errors.AUTHORIZED_LOGIN_ID neq ''}
                        <img src="{$IMAGE_PATH}error.gif" align="top" width="20" height="20" alt="ERROR"/>&nbsp;
                        {/if}
                        {$errors.AUTHORIZED_LOGIN_ID}
                    </div>
                    <div class="clr"></div>
                    <div style="padding:10px;"></div>

                    <div class="contentfont" style="border:0px solid red;width:210px;float: left;"><span class="mandatory">*</span> Authorized Transaction Key:</div>        
                    <div class="contentfont" style="width:330px;float: right;border:0px solid red;">
                        <div style="width:150px;float: left;">
                            <input type="text" name="AUTHORIZED_TRANSACTION_KEY" id="AUTHORIZED_TRANSACTION_KEY" class="input" value="{$settings.AUTHORIZED_TRANSACTION_KEY}" size="25"/>
                        </div>
                    </div>
                    <div class="mandatory" style="width:330px;float: right;border:0px solid red;">
                        {if $errors.AUTHORIZED_TRANSACTION_KEY neq ''}
                        <img src="{$IMAGE_PATH}error.gif" align="top" width="20" height="20" alt="ERROR"/>&nbsp;
                        {/if}
                        {$errors.AUTHORIZED_TRANSACTION_KEY}
                    </div>
                    <div class="clr"></div>
                    <div style="padding:10px;"></div> 

                    <div align="left" style="padding-left:35px;">
                        <input type="submit" name="submit" value="{$lang.T_ADMIN_GENERAL_SETTINGS_BUTTON}" class="button" />&nbsp;
                        <input type="button" name="cancel" onclick="window.location.href = 'index.php'" value="{$lang.T_ADMIN_GENERAL_SETTINGS_CANCEL_BUTTON}" class="button" />
                    </div>

                </div>
                <div class="contentfont" align="right" style="padding:5px;border:0px solid red;"><span class="mandatory">*</span><strong> {$lang.T_ADMIN_REG_MANDATORY}</strong></div> 
            </form>
        </fieldset>
    </div>
</div>
<script type="text/javascript" language="javascript">
            window.onload = function() {ldelim}  document.frmGeneralSettings.ADMIN_MAIL.focus(); {rdelim}
</script>                         