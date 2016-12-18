<?php
/**
 * The administration dashboard menus, screens, etc.
 */

defined( 'ABSPATH' ) || exit; /** Make sure the WordPress core is loaded */

/**
 * Things related to the WordPress Administrator Dashboard
 */
class WriteShare_Dashboard {

	/**
	 * @var WriteShare The bound WriteShare instance.
	 */
	public $writeshare;

	/**
	 * Early initialization.
	 * 
	 * @param WriteShare $writeshare The bound WriteShare instance.
	 *
	 * @return void
	 */
	public function __construct( $writeshare ) {
		$this->writeshare = $writeshare;
	}
	
	/**
	 * Main initialization.
	 *
	 * - Adds admin menu and submenu pages.
	 * - Adds user edit fields.
	 */
	public function init() {
		$_this = &$this;

		add_action( 'admin_menu', function() use ( $_this ) {
			add_menu_page(
				__( 'WriteShare', WriteShare::$TEXTDOMAIN ),
				__( 'WriteShare', WriteShare::$TEXTDOMAIN ),
				'manage_options',
				'writeshare',
				array( $_this, 'main_menu' ),
				'dashicons-book', '3.33114912'
			);

			add_submenu_page(
				'writeshare',
				__( 'WriteShare Settings', WriteShare::$TEXTDOMAIN ),
				__( 'Settings', WriteShare::$TEXTDOMAIN ),
				'manage_options',
				'writeshare-settings',
				array( $_this->writeshare->settings, 'settings_page' )
			);
		} );

		add_action( 'edit_user_profile', function( $user ) use ( $_this ) {
			?>
				<h3><?php _e( 'WriteShare', WriteShare::$TEXTDOMAIN ); ?></h3>

				<table class="form-table">
					<tbody>
						<tr>
							<th><label><?php _e( 'Writer Privileges' ); ?></label></th>
							<td>
								<input name="wpws_has_authorship" type="checkbox" <?php checked( $_this->writeshare->settings->get( 'authorship' ) || $user->wpws_has_authorship ); ?> <?php disabled( (bool)$_this->writeshare->settings->get( 'authorship' ) ); ?>/> <?php echo _e( 'User has writer privileges', WriteShare::$TEXTDOMAIN ); ?></label>
							</td>
						</tr>
					</tbody>
				</table>
			<?php
		} );

		add_action( 'profile_update', function( $user_id ) use ( $_this ) {
			if ( !$user_id || !current_user_can( 'edit_users' ) )
				return;

			if ( !$_this->writeshare->settings->get( 'authorship' ) ) {
				$grant_authorship = !empty( $_POST['wpws_has_authorship'] );

				if ( $grant_authorship && !get_user_meta( $user_id, 'wpws_has_authorship', true ) ) {
					$_this->writeshare->notifications->send( 'authorship_granted', get_userdata( $user_id )->user_email );
					update_user_meta( $user_id, 'wpws_authorship_requested', false ); 
				}

				update_user_meta( $user_id, 'wpws_has_authorship', $grant_authorship );
			}
		} );
	}

	/**
	 * The main WriteShare menu page
	 *
	 * Can contain quick links, stats, live status updates, etc.
	 *
	 * @return void
	 */
	public static function main_menu() {
		?>
			<div class="wrap">
				<h1><?php _e( 'WriteShare Administrator Dashboard', WriteShare::$TEXTDOMAIN ); ?></h1>

				<style>
					ul {
						list-style: initial;
					}
					ul li {
						margin-left: 2em;
					}
				</style>
				
				<h2>Setup Instructions</h2>

				<p>Before setting up your WriteShare plugin, have a look at this video to get an overview of our plugin:</p>
				<p><span class="embed-youtube" style="display: block;"><iframe class='youtube-player' type='text/html' width='640' height='390' src='http://www.youtube.com/embed/n__S16KyRac?version=3&#038;rel=1&#038;fs=1&#038;autohide=2&#038;showsearch=0&#038;showinfo=1&#038;iv_load_policy=1&#038;wmode=transparent' allowfullscreen='true' style='border:0;'></iframe></span></p>
				<p>Please follow these instructions to setup your WriteShare plugin:</p>
				<ul>
					<li>Quick Setup Instructions: <a href="http://wpwriteshare.com/setup-instructions/">http://wpwriteshare.com/setup-instructions/</a></li>
					<li>Books with chapters setup instructions: <a href="https://www.youtube.com/watch?v=ZHn9JqThcXc">https://www.youtube.com/watch?v=ZHn9JqThcXc</a></li>
					<li>Giving site members Writing Privileges: <a href="http://wpwriteshare.com/setup-instructions/request-writer-status/">http://wpwriteshare.com/setup-instructions/request-writer-status/</a></li>
					<li>More setup instructions: <a href="http://wpwriteshare.com/setup-instructions/">http://wpwriteshare.com/setup-instructions/</a> including an explanation of our advanced TAXONOMY features</li>
				</ul>
				<p>Create Your Menu Items by going to Dashboard &gt; Appearance &gt; Menus. There you will create custom links:</p>
				<ul>
					<li>Profile: http://yourdomain.com/profile/USERNAME_HERE/</li>
					<li>Writing: http://yourdomain.com/write/</li>
					<li>Search and Archives: http://yourdomain.com/content/<br/>
					CONTENT is what you selected at Dashboard &gt; WriteShare &gt; Settings (examples /writing/ for Creative Writing; /fanfic/ for fanfic; /poems/ for poems, etc.</li>
				</ul>

				<p>To edit writing submitted: On the writer&#8217;s  Profile page, there will be links to edit each submission.</p>

				<h2>Support</h2>

				<p>Support is at: <a href="https://wordpress.org/support/plugin/writeshare">https://wordpress.org/support/plugin/writeshare</a></p>

				<p>Please consider giving us a good rating in the WordPress Repository <a href="https://wordpress.org/plugins/writeshare/">https://wordpress.org/plugins/writeshare/</a>. Positive ratings and downloads will help us determine if we should continue to add new features to the plugin. Thank you!</p>
			</div>
		<?php
	}
}
