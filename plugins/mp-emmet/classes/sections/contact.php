<?php
/*
 * Contact us section 
 */

class MP_Emmet_Plugin_Contact {

    public function __construct() {
        add_action('wp_enqueue_scripts', array($this, 'recaptcha_scripts'));
        add_action('mp_emmet_contact_form', array($this, 'get_html'));
    }

    /*
     * Enqueue Google reCAPTCHA scripts
     */

    public function recaptcha_scripts() {
        if (is_page_template('template-front-page.php')) :
            $theme_contactus_sitekey = get_theme_mod('theme_contactus_sitekey');
            $theme_contactus_secretkey = get_theme_mod('theme_contactus_secretkey');
            $theme_contactus_recaptcha_show = get_theme_mod('theme_contactus_recaptcha_show');
            if (isset($theme_contactus_recaptcha_show) && $theme_contactus_recaptcha_show != 1 && !empty($theme_contactus_sitekey) && !empty($theme_contactus_secretkey)) :
                wp_enqueue_script('recaptcha', 'https://www.google.com/recaptcha/api.js');
            endif;
        endif;
    }

    public function get_html() {

        if (isset($_POST['submitted'])) :
            /*
             * recaptcha
             */
            $mp_emmet_contactus_sitekey = get_theme_mod('theme_contactus_sitekey');
            $mp_emmet_contactus_secretkey = get_theme_mod('theme_contactus_secretkey');
            $mp_emmet_contactus_recaptcha_show = get_theme_mod('theme_contactus_recaptcha_show');
            if (isset($mp_emmet_contactus_recaptcha_show) && $mp_emmet_contactus_recaptcha_show != 1 && !empty($mp_emmet_contactus_sitekey) && !empty($mp_emmet_contactus_secretkey)) :
                $captcha;
                if (isset($_POST['g-recaptcha-response'])) {
                    $captcha = $_POST['g-recaptcha-response'];
                }
                if (!$captcha) {
                    $hasError = true;
                }
                $response = wp_remote_get("https://www.google.com/recaptcha/api/siteverify?secret=" . $mp_emmet_contactus_secretkey . "&response=" . $captcha . "&remoteip=" . $_SERVER['REMOTE_ADDR']);
                $responseObj = json_decode($response['body']);
                if (!is_null($responseObj)) {
                    if ($responseObj->success === false) {
                        $hasError = true;
                    }
                }
            endif;
            /*
             * name 
             */
            if (trim($_POST['myname']) === ''):
                $nameError = __('* Please enter your name.', 'mp-emmet');
                $hasError = true;
            else:
                $name = trim($_POST['myname']);
            endif;
            /*
             *  email 
             */
            if (trim($_POST['myemail']) === ''):
                $emailError = __('* Please enter your email address.', 'mp-emmet');
                $hasError = true;
            elseif (!preg_match("/^[[:alnum:]][a-z0-9_.-]*@[a-z0-9.-]+\.[a-z]{2,4}$/i", trim($_POST['myemail']))) :
                $emailError = __('* You entered an invalid email address.', 'mp-emmet');
                $hasError = true;
            else:
                $email = trim($_POST['myemail']);
            endif;
            /*
             *  subject
             */
            if (trim($_POST['mysubject']) === ''):
                $subjectError = __('* Please enter a subject.', 'mp-emmet');
                $hasError = true;
            else:
                $subject = trim($_POST['mysubject']);
            endif;
            /*
             * message 
             */
            if (trim($_POST['mymessage']) === ''):
                $messageError = __('* Please enter a message.', 'mp-emmet');
                $hasError = true;
            else:
                $message = stripslashes(trim($_POST['mymessage']));
            endif;
            /*
             * send the email 
             */
            if (!isset($hasError)):
                $mp_emmet_contactus_email = get_theme_mod('theme_contactus_email');
                if (empty($mp_emmet_contactus_email)):
                    $emailTo = get_theme_mod('theme_email');
                else:
                    $emailTo = $mp_emmet_contactus_email;
                endif;

                if (isset($emailTo) && $emailTo != ""):
                    if (empty($subject)):
                        $subject = __('From ', 'mp-emmet') . $name;
                    endif;
                    $body = __('Name: ', 'mp-emmet') . $name . "\n\n" . __('Email: ', 'mp-emmet') . $email . "\n\n" . __('Subject: ', 'mp-emmet') . $subject . "\n\n" . __('Message: ', 'mp-emmet') . $message;
                    $headers = __('From: ', 'mp-emmet') . $name . ' <' . $emailTo . '>' . "\r\n" . __('Reply-To: ', 'mp-emmet') . $email;
                    wp_mail($emailTo, $subject, $body, $headers);
                    $emailSent = true;
                else:
                    $emailSent = false;
                endif;
            endif;
        endif;
        $mp_emmet_contactus_show = get_theme_mod('theme_contactus_show');

        if (isset($mp_emmet_contactus_show) && $mp_emmet_contactus_show != 1):
            $mp_emmet_contactus_animation = esc_attr(get_theme_mod('theme_contactus_animation', 'fadeIn'));
            ?>
            <section class="contact-section  transparent-section default-section" id="contact">
                <div class="container">
                    <?php if ($mp_emmet_contactus_animation === 'none'): ?>
                        <div class="section-content">
                        <?php else: ?>
                            <div class="section-content animated anHidden"  data-animation="<?php echo $mp_emmet_contactus_animation; ?>">
                            <?php endif; ?> 
                            <?php
                            $mp_emmet_contactus_title = esc_html(get_theme_mod('theme_contactus_title'));
                            $mp_emmet_contactus_description = esc_html(get_theme_mod('theme_contactus_description'));
                            if (get_theme_mod('theme_contactus_title', false) === false) :
                                ?> 
                                <h2 class="section-title"><?php _e('Message form', 'mp-emmet'); ?></h2>
                                <?php
                            else:
                                if (!empty($mp_emmet_contactus_title)):
                                    ?>
                                    <h2 class="section-title"><?php echo $mp_emmet_contactus_title; ?></h2>
                                    <?php
                                endif;
                            endif;
                            if (get_theme_mod('theme_contactus_description', false) === false) :
                                ?> 
                                <div class="section-description"><?php _e('Contact us using the form below', 'mp-emmet'); ?></div>
                                <?php
                            else:
                                if (!empty($mp_emmet_contactus_description)):
                                    ?>
                                    <div class="section-description"><?php echo $mp_emmet_contactus_description; ?></div>
                                    <?php
                                endif;
                            endif;
                            ?>

                            <?php
                            if (isset($emailSent) && $emailSent == true) :
                                echo '<div class="notification success"><p>' . __('Thanks, your email was sent successfully!', 'mp-emmet') . '</p></div>';
                            elseif (isset($_POST['submitted'])):
                                echo '<div class="notification error"><p>' . __('Sorry, an error occured.', 'mp-emmet') . '</p></div>';
                            endif;
                            if (isset($nameError) && $nameError != '') :
                                echo '<div class="notification error"><p>' . esc_html($nameError) . '</p></div>';
                            endif;
                            if (isset($emailError) && $emailError != '') :
                                echo '<div class="notification error"><p>' . esc_html($emailError) . '</p></div>';
                            endif;
                            if (isset($subjectError) && $subjectError != '') :
                                echo '<div class="notification error"><p>' . esc_html($subjectError) . '</p></div>';
                            endif;
                            if (isset($messageError) && $messageError != '') :
                                echo '<div class="notification error"><p>' . esc_html($messageError) . '</p></div>';
                            endif;
                            ?>

                            <form method="POST" action="" onSubmit="this.scrollPosition.value = (document.body.scrollTop || document.documentElement.scrollTop)" class="contact-form">
                                <input type="hidden" name="scrollPosition">
                                <input type="hidden" name="submitted" id="submitted" value="true" />
                                <div class="row">
                                    <div class="form-group col-xs-12 col-sm-4 col-md-4 col-lg-4">
                                        <input required="required" type="text" name="myname" placeholder="<?php _e('Your Name', 'mp-emmet'); ?>" class="form-control input-box" value="<?php if (isset($_POST['myname'])) echo esc_attr($_POST['myname']); ?>">
                                    </div>
                                    <div class="form-group col-xs-12 col-sm-4 col-md-4 col-lg-4">
                                        <input required="required" type="email" name="myemail" placeholder="<?php _e('Your Email', 'mp-emmet'); ?>" class="form-control input-box" value="<?php if (isset($_POST['myemail'])) echo is_email($_POST['myemail']) ? $_POST['myemail'] : ""; ?>">
                                    </div>
                                    <div class="form-group col-xs-12 col-sm-4 col-md-4 col-lg-4">
                                        <input required="required" type="text" name="mysubject" placeholder="<?php _e('Subject', 'mp-emmet'); ?>" class="form-control input-box" value="<?php if (isset($_POST['mysubject'])) echo esc_attr($_POST['mysubject']); ?>">
                                    </div>
                                    <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                        <textarea name="mymessage" class="form-control textarea-box" rows="9" placeholder="<?php _e('Your Message', 'mp-emmet'); ?>"><?php
                                            if (isset($_POST['mymessage'])) {
                                                echo esc_html($_POST['mymessage']);
                                            }
                                            ?></textarea>
                                    </div>

                                </div>
                                <?php
                                $mp_emmet_contactus_button_label = esc_html(get_theme_mod('theme_contactus_button_label', __('Send Message', 'mp-emmet')));
                                if (!empty($mp_emmet_contactus_button_label)):
                                    echo '<div class="form-group">';
                                    echo '<button class="btn btn-primary theme-contuct-submit" type="submit" >' . $mp_emmet_contactus_button_label . '</button>';
                                    echo '</div>';
                                endif;
                                ?>
                                <?php
                                $mp_emmet_contactus_sitekey = get_theme_mod('theme_contactus_sitekey');
                                $mp_emmet_contactus_secretkey = get_theme_mod('theme_contactus_secretkey');
                                $mp_emmet_contactus_recaptcha_show = get_theme_mod('theme_contactus_recaptcha_show');
                                if (isset($mp_emmet_contactus_recaptcha_show) && $mp_emmet_contactus_recaptcha_show != 1 && !empty($mp_emmet_contactus_sitekey) && !empty($mp_emmet_contactus_secretkey)) :
                                    echo '<div class="form-group">';
                                    echo '<div class="g-recaptcha theme-g-recaptcha" data-sitekey="' . $mp_emmet_contactus_sitekey . '"></div>';
                                    echo '</div>';
                                endif;
                                ?>
                            </form>

                        </div>
                    </div>
            </section> 
            <?php
        endif;
    }

}
