<?php /**
 * @author William Sergio Minozzi
 * @copyright 2017
 */
 
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
// $aurl = REALESTATERIGHTNOWURL . 'includes/contact-form/processForm.php';
$aurl = "#";
$realestaterightnow_recipientEmail = trim(get_option('realestaterightnow_recipientEmail', ''));
if ( ! is_email($realestaterightnow_recipientEmail)) {
        $realestaterightnow_recipientEmail = '';
        update_option('realestaterightnow_recipientEmail', '');
    }
if (empty($realestaterightnow_recipientEmail))
    $realestaterightnow_recipientEmail = get_option('admin_email'); ?>
<?php Global $realestaterightnow_the_title; ?>  
<form id="realestaterightnow_contactForm" style="display: none;">
<!-- action="<?php echo esc_url($aurl); ?>" method="post"> -->
  <input type="hidden" name="realestaterightnow_recipientEmail" id="realestaterightnow_recipientEmail" value="<?php echo
esc_url($realestaterightnow_recipientEmail); ?>" />
  <input type="hidden" name="realestaterightnow_the_title" id="realestaterightnow_the_title" value="<?php echo esc_attr($realestaterightnow_the_title); ?>" />
  <h2><?php 
  echo esc_attr__('Request Information', 'real-estate-right-now'); 
  ?>...</h2>
  <ul>
    <li>
      <label for="realestaterightnow_senderName" class="realestaterightnow_contact" ><?php echo esc_attr__('Your Name',
'real-estate-right-now'); ?>:&nbsp;</label>
      <input type="text" name="realestaterightnow_senderName" id="realestaterightnow_senderName" placeholder="<?php echo
esc_attr__('Please type your name', 'real-estate-right-now'); ?>" required="required" maxlength="40" />
    </li>
    <li>
      <label for="realestaterightnow_senderEmail" class="realestaterightnow_contact"><?php echo esc_attr__('Your Email',
'real-estate-right-now'); ?>:&nbsp;</label>
      <input type="email" name="realestaterightnow_senderEmail" id="realestaterightnow_senderEmail" placeholder="<?php echo
esc_attr__('Please type your email', 'real-estate-right-now'); ?>" required="required" maxlength="50" />
    </li>
    <li>
      <label for="realestaterightnow_sendermessage" class="realestaterightnow_contact" style="padding-top: .5em;"><?php echo
esc_attr__('Your Message', 'real-estate-right-now'); ?>:&nbsp;</label>
      <textarea name="realestaterightnow_sendermessage" id="realestaterightnow_sendermessage" placeholder="<?php echo
esc_attr__('Please type your message', 'real-estate-right-now'); ?>" required="required"  maxlength="10000"></textarea>
    </li>
  </ul>
<br />
  <div id="formButtons">
    <input type="submit" id="realestaterightnow_sendMessage" name="sendMessage" value="<?php echo
esc_attr__('Send', 'real-estate-right-now'); ?>" />
    <input type="button" id="realestaterightnow_cancel" name="cancel" value="<?php echo esc_attr__('Cancel',
'real-estate-right-now'); ?>" />
  </div>
<?php  wp_nonce_field('realestaterightnow_cform'); ?> 
</form>
<div id="realestaterightnow_sendingMessage" class="realestaterightnow_statusMessage" style="display: none; z-index:999;" ><p><?php esc_attr_e('Sending your message. Please wait...' , 'real-estate-right-now' ); ?></p></div>
<div id="realestaterightnow_successMessage" class="realestaterightnow_statusMessage" style="display: none;  z-index:999;"><p><?php esc_attr_e( 'Thanks for your message! We\'ll get back to you shortly.' , 'real-estate-right-now' ); ?></p></div>
<div id="realestaterightnow_failureMessage" class="realestaterightnow_statusMessage" style="display: none;  z-index:999;"><p><?php esc_attr_e( 'There was a problem sending your message. Please try again.' , 'real-estate-right-now' ); ?></p></div>
<div id="realestaterightnow_email_error" class="realestaterightnow_statusMessage" style="display: none; z-index:999;"><p><?php esc_attr_e( 'Please enter one valid email address.' , 'real-estate-right-now' ); ?></p></div>
<div id="realestaterightnow_incompleteMessage" class="realestaterightnow_statusMessage" style="display: none; z-index:999;"><p><?php esc_attr_e( 'Please complete all the fields in the form before sending.' , 'real-estate-right-now' ); ?></p></div>
<div id="realestaterightnow_name_error" class="realestaterightnow_statusMessage" style="display: none; z-index:999;"><p><?php esc_attr_e( 'Name Error. Use only alpha.' , 'real-estate-right-now' ); ?></p></div>
<div id="realestaterightnow_message_error" class="realestaterightnow_statusMessage" style="display: none; z-index:999;"><p><?php esc_attr_e( 'Message Error. Only Use only alpha and numbers.' , 'real-estate-right-now' ); ?> </p></div>
<div id="realestaterightnow_message_error" class="realestaterightnow_statusMessage" style="display: none; z-index:999;"><p>Message Error. Only Use only alpha and numbers.</p></div>