<?php
/**
 * Underscore template for displaying a social message item in the calendar.
 *
 * @package    Nelio_Content
 * @subpackage Nelio_Content/admin/views/calendar
 * @author     David Aguilera <david.aguilera@neliosoftware.com>
 * @since      1.0.0
 */

/**
 * List of vars used in this page:
 *
 * None.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}//end if

?>
<script type="text/template" id="_nc-calendar">

	<div class="nc-h1-and-notifications-wrapper" style="display:none;">
		<h1 class="nc-current-month">
			printf( // @codingStandardsIgnoreLine
				_x( '%1$s %2$s', 'text (calendar title: {month} {year})', 'nelio-content' ),
				'<span class="nc-month"></span>', '<span class="nc-year"></span>'
			);
		?></h1>
	</div><!-- .nc-h1-and-notifications-wrapper -->

	<div class="nc-calendar-and-header-container">

		<div class="nc-calendar-header">

			<div class="nc-calendar-actions">

				<div class="nc-left">

					<button class="button nc-action nc-prev nc-month"><span class="nc-dashicons nc-dashicons-arrow-left-alt2"></span></button><button class="button nc-action nc-next nc-month"><span class="nc-dashicons nc-dashicons-arrow-right-alt2"></span></button>
					<span class="nc-current-month"><?php
						printf( // @codingStandardsIgnoreLine
							_x( '%1$s %2$s', 'text (calendar title: {month} {year})', 'nelio-content' ),
							'<span class="nc-month"></span>', '<span class="nc-year"></span>'
						);
					?></span>
					<button class="button nc-action nc-today"><?php esc_html_e( 'Today', 'nelio-content' ); ?></button>
					<span class="spinner nc-cal-sync" title="<?php
						echo esc_html_x( 'Synching calendar&hellip;', 'text', 'nelio-content' );
					?>"></span>

				</div><!-- .nc-left -->

				<div class="nc-right">

					<?php

					$settings = Nelio_Content_Settings::instance();
					$post_types = array();

					$aux = $settings->get( 'calendar_post_types' );
					foreach ( $aux as $post_type_name ) {
						$post_type = get_post_type_object( $post_type_name );
						if ( ! $post_type || is_wp_error( $post_type ) ) {
							continue;
						}//end if
						array_push( $post_types, $post_type );
					}//end foreach

					if ( 1 === count( $post_types ) && 'post' === $post_types[0]->name ) {
						include NELIO_CONTENT_ADMIN_DIR . '/views/partials/calendar/post-filter.php';
					} else if ( 1 === count( $post_types ) ) {
						include NELIO_CONTENT_ADMIN_DIR . '/views/partials/calendar/custom-post-type-filter.php';
					} else {
						include NELIO_CONTENT_ADMIN_DIR . '/views/partials/calendar/multiple-post-types-filter.php';
					}//end if
					?>

					<select class="nc-social-filter"></select>

					<?php
					if ( nc_is_subscribed_to( 'team-plan' ) ) { ?>
						<select class="nc-task-filter"></select>
					<?php
					} ?>

				</div><!-- .nc-right -->

			</div><!-- .nc-calendar-actions -->

			<div class="nc-days-of-week"></div>

		</div><!-- .nc-calendar-header -->

		<div class="nc-calendar-holder nc-box">

			<div class="nc-calendar">

				<div class="nc-scroll-up-area"></div>

				<div class="nc-grid"></div>

				<?php
				$side = 'left';
				include NELIO_CONTENT_ADMIN_DIR . '/views/partials/calendar/context-actions.php';
				?>

				<?php
				$side = 'right';
				include NELIO_CONTENT_ADMIN_DIR . '/views/partials/calendar/context-actions.php';
				?>

				<div class="nc-scroll-down-area"></div>

			</div><!-- .nc-calendar -->

		</div><!-- .nc-calendar-holder -->

	</div><!-- .nc-calendar-and-header-container -->

	<div class="nc-helper-div"></div>

</script><!-- #_nc-calendar -->
