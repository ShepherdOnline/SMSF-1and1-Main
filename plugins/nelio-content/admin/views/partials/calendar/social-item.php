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
 * List of vars used in this partial:
 *
 * None.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

?>
<script type="text/template" id="_nc-social-item">

	<div class="nc-calendar-item nc-<%= status %> nc-social<% if ( 'publish' === status || '_enqueued' === status || '_awaitingEnqueueConfirmation' === status ) { %> nc-blurred nc-locked<% } %>">

		<div class="nc-content">

			<div class="nc-profile"
				title="<%= displayNameEscaped %>">

				<div class="nc-profile-picture nc-first-letter-<%= firstLetter %>">
					<div class="nc-actual-profile-picture" style="background-image: url( <%= _.escape( photo ) %> );"></div>
				</div><!-- .nc-picture -->

				<div class="nc-network nc-<%= network %> nc-<%= networkKind %>"></div>

			</div><!-- .nc-profile -->

			<div class="nc-message">
				<strong><%= schedule.format( NelioContent.i18n.time.calendar ).replace( /((:00)|(:..))(.)m/g, '$3$4' ) %></strong>
				<span class="nc-actual-message"><%= textComputed %></span>
			</div><!-- .nc-message -->

		</div><!-- .nc-content -->

	</div><!-- .nc-social -->

</script><!-- #_nc-social-item -->

