<?php
// Content Expire Scheduler Setting Page

function ces_registration_settings() {
  add_option( 'ces_expiry_message', 'Page has Expired: This page is no longer available. Please contact Webmaster for content.');
  add_option( 'ces_expiry_msg_color', '#ffffff');
  add_option( 'ces_expiry_msg_bg', '#dd3333');
  add_option( 'ces_ex_msg_sho', '0');
  register_setting( 'default', 'ces_expiry_message' );
  register_setting( 'default', 'ces_expiry_msg_color' );
  register_setting( 'default', 'ces_expiry_msg_bg' );
  register_setting( 'default', 'ces_ex_msg_sho' );
}
add_action( 'admin_init', 'ces_registration_settings' );

function ces_settings_page() {
  add_options_page('Conten Expire Scheuler', 'Content Expire Scheduler', 'manage_options', 'ces-options', 'ces_option_page');
}
add_action('admin_menu', 'ces_settings_page');

function ces_option_page() {
?>
  <div class="wrap">
    <h2> Content Expire Scheduler</h2>

    <form method="post" action="options.php" class="form-table">
      <?php settings_fields( 'default' ); ?>
        <table class="form-table">
          <tr valign="top">
            <th scope="row">
              <label for="ces_expiry_message">Content Expiry Message</label>
            </th>
            <td>
              <textarea id="ces_expiry_message" name="ces_expiry_message" rows="5" cols="55"><?php echo get_option('ces_expiry_message'); ?></textarea>
            </td>
          </tr>
          <tr valign="top">
            <th scope="row">
              <label for="ces_expiry_show">Expiry Message Show</label>
            </th>
            <td>
              <?php $options =  get_option('ces_ex_msg_sho'); ?>
              <select name='ces_ex_msg_sho'>
                <option value='0' <?php selected( $options, 0 ); ?>>Before Content</option>
                <option value='1' <?php selected( $options, 1 ); ?>>After Content</option>
              </select>
            </td>
          </tr>
          <tr valign="top">
            <th scope="row">
              <label for="ces_expiry_msg_color">Message Font Color</label>
            </th>
            <td>
              <input type="text" id="ces_expiry_msg_color" value="<?php echo get_option('ces_expiry_msg_color'); ?>" name="ces_expiry_msg_color" class="ces-font-color" />
            </td>
          </tr>
          <tr valign="top">
            <th scope="row">
              <label for="ces_expiry_msg_bg">Message Background Color</label>
            </th>
            <td>
              <input type="text" id="ces_expiry_msg_bg" value="<?php echo get_option('ces_expiry_msg_bg'); ?>" name="ces_expiry_msg_bg" class="ces-bg-color" />
            </td>
          </tr>
        </table>
      <?php submit_button(); ?>
    </form>
    <p style="margin-top: 40px;"><small><?php _e('If you experience some problems with this plugin please let me know about it on <a href="https://wordpress.org/support/plugin/content-expire-scheduler#postform">Plugin\'s support</a>. If you think this plugin is awesome please vote on <a href="https://wordpress.org/support/view/plugin-reviews/content-expire-scheduler/">Wordpress plugin page</a>. Thanks!', RADLABS_TEXTDOMAIN ); ?></small></p>
  </div>
<?php
}
?>