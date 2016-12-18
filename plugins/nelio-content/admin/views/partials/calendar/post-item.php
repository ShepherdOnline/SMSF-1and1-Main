<?php
/**
 * Underscore template for displaying a post item in the calendar.
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

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}//end if

?>
<script type="text/template" id="_nc-post-item">

	<div class="nc-calendar-item nc-post<% if ( 'publish' === status ) { %> nc-blurred<% } %>">

		<div class="nc-content">

			<div class="nc-message">
				<strong><%= date.format( NelioContent.i18n.time.calendar ).replace( /((:00)|(:..))(.)m/g, '$3$4' ) %></strong>
				<span class="nc-actual-message"><%= title %></span>
			</div><!-- .nc-message -->

			<div class="nc-extra">

				<div class="nc-profile"
					title="<%= displayNameEscaped %>">

					<div class="nc-profile-picture nc-first-letter-<%= firstLetter %>">
						<div class="nc-actual-profile-picture" style="background-image: url( <%= _.escape( photo ) %> );"></div>
					</div><!-- .nc-picture -->

				</div><!-- .nc-profile -->

				<div class="nc-summary">
					<span class="nc-status">
					<% if ( status === 'publish' ) { %>
						<span class="nc-dashicons nc-dashicons-lock" title="<?php
							echo esc_attr_x( 'Published', 'text (post)', 'nelio-content' );
						?>"></span>
						<span class="nc-label"><?php
							echo esc_html_x( 'Published', 'text (post)', 'nelio-content' );
						?></span>
					<% } else if ( status === 'draft' ) { %>
						<span class="nc-dashicons nc-dashicons-edit" title="<?php
							echo esc_attr_x( 'Draft', 'text (post)', 'nelio-content' );
						?>"></span>
						<span class="nc-label"><?php
							echo esc_html_x( 'Draft', 'text (post)', 'nelio-content' );
						?></span>
					<% } else if ( status === 'future' ) { %>
						<span class="nc-dashicons nc-dashicons-clock" title="<?php
							echo esc_attr_x( 'Scheduled', 'text (post)', 'nelio-content' );
						?>"></span>
						<span class="nc-label"><?php
							echo esc_html_x( 'Scheduled', 'text (post)', 'nelio-content' );
						?></span>
					<% } %>
					</span>

					<?php
					$settings = Nelio_Content_Settings::instance();
					$post_types = $settings->get( 'calendar_post_types' );
					?>

					<?php
					if ( 1 === count( $post_types ) && 'post' === $post_types[0] ) { ?>

						<% if ( typeof categories === 'string' && categories.length > 0 ) { %>
							<br>
							<span class="nc-category-list">
								<span class="nc-dashicons nc-dashicons-category"></span>
								<%= categories %>
							</span>
						<% } %>

					<?php
					} else { ?>

						<br>
						<span class="nc-category-list">
							<span class="nc-dashicons nc-dashicons-sticky"></span>
							<%= typeLabel %>
						</span>

					<?php
					} ?>

				</div><!-- .nc-summary -->

			</div><!-- .nc-extra -->

		</div><!-- .nc-content -->

	</div><!-- .nc-post -->

</script><!-- #_nc-post-item -->
