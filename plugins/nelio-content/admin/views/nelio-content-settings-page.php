<?php
/**
 * Displays the UI for configuring the plugin.
 *
 * @package    Nelio_Content
 * @subpackage Nelio_Content/admin/views
 * @author     David Aguilera <david.aguilera@neliosoftware.com>
 * @since      1.0.0
 */

/**
 * List of vars used in this partial:
 *
 * None.
 */

?>

<div class="wrap">

	<h2><?php esc_html_e( 'Nelio Content - Settings', 'nelio-content' ); ?></h2>

	<?php settings_errors(); ?>

	<form method="post" action="options.php">
		<?php
			$settings = Nelio_Content_Settings::instance();
			settings_fields( $settings->get_option_group() );
			do_settings_sections( $settings->get_settings_page_name() );
			submit_button();
		?>
	</form>

</div><!-- .wrap -->

