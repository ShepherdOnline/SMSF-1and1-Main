<?php
/**
 * This partial contains the list of available networks for which we can connect social profiles.
 *
 * @package    Nelio_Content
 * @subpackage Nelio_Content/admin/views/partials/social-profiles
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

// URL to which our cloud has to redirect the user once a social profile has been successfully completed.
$redirect_url = add_query_arg( 'nc-page', 'connected-profile-callback', admin_url( 'admin.php' ) );

?>

<script type="text/template" id="_nc-social-profile-settings">

	<h2><?php echo esc_html_x( 'Add New', 'title (social profile)', 'nelio-content' ); ?></h2>

	<p><?php
		echo esc_html_x( 'Connect your social media profiles to Nelio Content.', 'user', 'nelio-content' );
	?></p>

	<div class="nc-networks">

		<% if ( isLoadingSocialProfiles ) { %>
			<div class="nc-network nc-twitter disabled">
				<div class="nc-logo"></div>
		<% } else if ( isTwitterEnabled ) { %>
			<div class="nc-network nc-twitter" data-href="<?php
				$url = nc_get_api_url( '/connect/twitter', 'browser' );
				$url = add_query_arg( 'siteId', nc_get_site_id(), $url );
				$url = add_query_arg( 'creatorId', get_current_user_id(), $url );
				$url = add_query_arg( 'redirect', $redirect_url, $url );
				$url = add_query_arg( 'lang', nc_get_language(), $url );
				echo esc_url( $url );
			?>">
				<div class="nc-logo"></div>
		<% } else { %>
			<div class="nc-network nc-twitter disabled">
				<div class="nc-logo" title="<?php
					echo esc_attr_x( 'The maximum number of Twitter profiles you may configure has been reached.', 'text', 'nelio-content' );
				?>"></div>
		<% } %>
			<div class="nc-name"><?php echo esc_html_x( 'Twitter', 'text', 'nelio-content' ); ?></div>
		</div><!-- .nc-twitter -->

		<% if ( isLoadingSocialProfiles ) { %>
			<div class="nc-network nc-facebook-personal disabled">
				<div class="nc-logo"></div>
		<% } else if ( isFacebookEnabled ) { %>
			<div class="nc-network nc-facebook-personal" data-href="<?php
				$url = nc_get_api_url( '/connect/facebook', 'browser' );
				$url = add_query_arg( 'siteId', nc_get_site_id(), $url );
				$url = add_query_arg( 'creatorId', get_current_user_id(), $url );
				$url = add_query_arg( 'redirect', $redirect_url, $url );
				$url = add_query_arg( 'lang', nc_get_language(), $url );
				echo esc_url( $url );
			?>">
				<div class="nc-logo"></div>
		<% } else { %>
			<div class="nc-network nc-facebook-personal disabled">
				<div class="nc-logo" title="<?php
					echo esc_attr_x( 'The maximum number of Facebook profiles you may configure has been reached.', 'text', 'nelio-content' );
				?>"></div>
		<% } %>
			<div class="nc-name"><?php echo esc_html_x( 'Facebook', 'text', 'nelio-content' ); ?></div>
		</div><!-- .nc-facebook-profile -->

		<% if ( isLoadingSocialProfiles ) { %>
			<div class="nc-network nc-facebook-page disabled">
				<div class="nc-logo"></div>
		<% } else if ( isFacebookEnabled ) { %>
			<div class="nc-network nc-facebook-page" data-href="<?php
				$url = nc_get_api_url( '/connect/facebook/page', 'browser' );
				$url = add_query_arg( 'siteId', nc_get_site_id(), $url );
				$url = add_query_arg( 'creatorId', get_current_user_id(), $url );
				$url = add_query_arg( 'redirect', $redirect_url, $url );
				$url = add_query_arg( 'lang', nc_get_language(), $url );
				echo esc_url( $url );
			?>">
				<div class="nc-logo"></div>
		<% } else { %>
			<div class="nc-network nc-facebook-page disabled">
				<div class="nc-logo" title="<?php
					echo esc_attr_x( 'The maximum number of Facebook profiles you may configure has been reached.', 'text', 'nelio-content' );
				?>"></div>
		<% } %>
			<div class="nc-name"><?php echo esc_html_x( 'Facebook Page', 'text', 'nelio-content' ); ?></div>
		</div><!-- .nc-facebook-page -->

		<% if ( isLoadingSocialProfiles ) { %>
			<div class="nc-network nc-facebook-group disabled">
				<div class="nc-logo"></div>
		<% } else if ( isFacebookEnabled ) { %>
			<div class="nc-network nc-facebook-group" data-href="<?php
				$url = nc_get_api_url( '/connect/facebook/group', 'browser' );
				$url = add_query_arg( 'siteId', nc_get_site_id(), $url );
				$url = add_query_arg( 'creatorId', get_current_user_id(), $url );
				$url = add_query_arg( 'redirect', $redirect_url, $url );
				$url = add_query_arg( 'lang', nc_get_language(), $url );
				echo esc_url( $url );
			?>">
				<div class="nc-logo"></div>
		<% } else { %>
			<div class="nc-network nc-facebook-group disabled">
				<div class="nc-logo" title="<?php
					echo esc_attr_x( 'The maximum number of Facebook profiles you may configure has been reached.', 'text', 'nelio-content' );
				?>"></div>
		<% } %>
			<div class="nc-name"><?php echo esc_html_x( 'Facebook Group', 'text', 'nelio-content' ); ?></div>
		</div><!-- .nc-facebook-group -->

		<% if ( isLoadingSocialProfiles ) { %>
			<div class="nc-network nc-linkedin-personal disabled">
				<div class="nc-logo"></div>
		<% } else if ( isLinkedInEnabled ) { %>
			<div class="nc-network nc-linkedin-personal" data-href="<?php
				$url = nc_get_api_url( '/connect/linkedin', 'browser' );
				$url = add_query_arg( 'siteId', nc_get_site_id(), $url );
				$url = add_query_arg( 'creatorId', get_current_user_id(), $url );
				$url = add_query_arg( 'redirect', $redirect_url, $url );
				$url = add_query_arg( 'lang', nc_get_language(), $url );
				echo esc_url( $url );
			?>">
				<div class="nc-logo"></div>
		<% } else { %>
			<div class="nc-network nc-linkedin-personal disabled">
				<div class="nc-logo" title="<?php
					echo esc_attr_x( 'The maximum number of LinkedIn profiles you may configure has been reached.', 'text', 'nelio-content' );
				?>"></div>
		<% } %>
			<div class="nc-name"><?php echo esc_html_x( 'LinkedIn', 'text', 'nelio-content' ); ?></div>
		</div><!-- .nc-linkedin-personal -->

		<% if ( isLoadingSocialProfiles ) { %>
			<div class="nc-network nc-linkedin-company disabled">
				<div class="nc-logo"></div>
		<% } else if ( isLinkedInEnabled ) { %>
			<div class="nc-network nc-linkedin-company" data-href="<?php
				$url = nc_get_api_url( '/connect/linkedin/company', 'browser' );
				$url = add_query_arg( 'siteId', nc_get_site_id(), $url );
				$url = add_query_arg( 'creatorId', get_current_user_id(), $url );
				$url = add_query_arg( 'redirect', $redirect_url, $url );
				$url = add_query_arg( 'lang', nc_get_language(), $url );
				echo esc_url( $url );
			?>">
				<div class="nc-logo"></div>
		<% } else { %>
			<div class="nc-network nc-linkedin-company disabled">
				<div class="nc-logo" title="<?php
					echo esc_attr_x( 'The maximum number of LinkedIn profiles you may configure has been reached.', 'text', 'nelio-content' );
				?>"></div>
		<% } %>
			<div class="nc-name"><?php echo esc_html_x( 'LinkedIn Company', 'text', 'nelio-content' ); ?></div>
		</div><!-- .nc-linkedin-company -->

		<% if ( isLoadingSocialProfiles ) { %>
			<div class="nc-network nc-pinterest disabled">
				<div class="nc-logo"></div>
		<% } else if ( isPinterestEnabled ) { %>
			<div class="nc-network nc-pinterest" data-href="<?php
				$url = nc_get_api_url( '/connect/pinterest', 'browser' );
				$url = add_query_arg( 'siteId', nc_get_site_id(), $url );
				$url = add_query_arg( 'creatorId', get_current_user_id(), $url );
				$url = add_query_arg( 'redirect', $redirect_url, $url );
				$url = add_query_arg( 'lang', nc_get_language(), $url );
				echo esc_url( $url );
			?>">
				<div class="nc-logo"></div>
		<% } else { %>
			<div class="nc-network nc-pinterest disabled">
				<div class="nc-logo" title="<?php
					echo esc_attr_x( 'The maximum number of Pinterest profiles you may configure has been reached.', 'text', 'nelio-content' );
				?>"></div>
		<% } %>
			<div class="nc-name"><?php echo esc_html_x( 'Pinterest', 'text', 'nelio-content' ); ?></div>
		</div><!-- .nc-pinterest -->

	</div><!-- .nc-networks -->


	<% if ( isLoadingSocialProfiles ) { %>

		<div class="nc-checking-available-profiles">
			<span class="spinner is-active"></span>
			<?php echo esc_html_x( 'Checking if there are any social profiles connected to Nelio Content&hellip;', 'text (social profile settings)', 'nelio-content' ); ?>
		</div><!-- .nc-checking-available-profiles -->

	<% } else if ( numOfConnectedProfiles > 0 ) { %>

		<h2>
			<?php echo esc_html_x( 'Connected Profiles', 'text', 'nelio-content' ); ?>
			<span class="nc-connected-profile-counter"><span class="nc-count"><%= numOfConnectedProfiles %></span><span class="nc-total">/<%= maxNumOfProfiles %></span></span>
		</h2>

		<p><?php
			echo esc_html_x( 'The following profiles can be managed by any author in your team:', 'text', 'nelio-content' );
		?></p>

		<div class="nc-connected-profiles"></div>

	<% } %>

</script><!-- #_nc-social-profile-settings -->

