<?php

/**
 * @file
 * Default theme implementation to format an HTML mail.
 *
 * Copy this file in your default theme folder to create a custom themed mail.
 * Rename it to mimemail-message--[module]--[key].tpl.php to override it for a
 * specific mail.
 *
 * Available variables:
 * - $recipient: The recipient of the message
 * - $subject: The message subject
 * - $body: The message body
 * - $css: Internal style sheets
 * - $module: The sending module
 * - $key: The message identifier
 *
 * @see template_preprocess_mimemail_message()
 */
?>
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <?php if ($css): ?>
    <style type="text/css">
      <!--
      <?php print $css ?>
      -->
    </style>
    <?php endif; ?>
  </head>
  <body id="mimemail-body" <?php if ($module && $key): print 'class="'. $module .'-'. $key .'"'; endif; ?>>
    <div id="center" style="width:700px;">
      <div id="logo" style="float: left; margin: 10px; display: inline">
        <a href="https://www.boondockerswelcome.com">
          <img src="http://dev.boondockerswelcome.com/sites/boondockerswelcome.com/files/logoImages/BDWNewLogoTag.jpg" alt="Home" style="border:0;" />
      </a>
      </div>
      <div id="subject" style="display:inline">
        <h1>
          <?php print $subject ?>
        </h1>
      </div>
      <div id="social-icons" style="float:right; display: inline">
	 <div id="facebook" style="display:inline">
	  <a href="https://www.facebook.com/BoondockersWelcome"><img src="http://dev.boondockerswelcome.com/sites/boondockerswelcome.com/files/media/iconsets/social/facebook32x32.png" alt="Facebook"></a>
	 </div>
	 <div id="contact-us" style="display:inline">
	  <a href="https://www.boondockerswelcome.com/contact"><img src="http://dev.boondockerswelcome.com/sites/boondockerswelcome.com/files/media/iconsets/social/email32x32.png" atl="Contact Us"></a>
	 </div>
      </div>
      <div id="main" style="clear: both; padding: 10px"> 
        <div id="body"> 
          <?php print $body ?>
        </div>
      </div>
      <div id="footer">
      </div>
    </div>
  </body>
</html>
