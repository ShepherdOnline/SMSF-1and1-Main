<?php
/**
 * Nelio Content subscription-related functions.
 *
 * @package    Nelio_Content
 * @subpackage Nelio_Content/includes
 * @author     David Aguilera <david.aguilera@neliosoftware.com>
 * @since      1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}//end if

/**
 * This function returns information about the current subscription.
 *
 * @return array information about the current subscription.
 *
 * @since 1.0.0
 */
function nc_get_subscription() {

	return get_option( 'nc_subscription', array(
		'creationDate' => '',
		'email'        => '',
		'firstname'    => '',
		'isInvitation' => false,
		'lastname'     => '',
		'license'      => '',
		'period'       => 'none',
		'plan'         => 'none',
		'state'        => 'active',
	) );

}//end nc_get_subscription()

/**
 * This function returns the plan the user is subscribed to. If he's using the
 * Community Edition, `none` is returned.
 *
 * @return string the plan the user is subscribed to.
 *
 * @since 1.0.0
 */
function nc_get_subscription_plan() {

	$subscription = nc_get_subscription();
	if ( 'none' === $subscription['plan'] ) {
		return 'none';
	} else {
		return $subscription['plan'] . '-plan';
	}//end if

}//end nc_get_subscription_plan()

/**
 * Returns whether the current user is a paying customer or not.
 *
 * @return boolean whether the current user is a paying customer or not.
 *
 * @since 1.0.0
 */
function nc_is_subscribed() {

	return nc_get_subscription_plan() !== 'none';

}//end nc_is_subscribed()

/**
 * Returns whether the user is subscribed to the specified plan or not.
 *
 * @param string $req_plan The plan the user should be subscribed to.
 * @param string $mode     Optional. If `exactly`, the current user must be
 *                         subscribed to the required plan. If `or-above`, the
 *                         required plan or an superior plan would return true.
 *                         Default: `or-above`.
 *
 * @return boolean whether the user is subscribed to the specified plan or not.
 *
 * @since 1.0.0
 */
function nc_is_subscribed_to( $req_plan, $mode = 'or-above' ) {

	if ( ! nc_is_subscribed() ) {
		return false;
	}//end if

	// Check if the plan the user is subscribed to is exactly the required plan.
	$plan = nc_get_subscription_plan();
	if ( $req_plan === $plan ) {
		return true;
	}//end if

	// If it isn't, let's check if the plan he's subscribed to is, at least, the
	// required plan.
	if ( 'or-above' === $mode ) {

		// Reminder: this switch should contain all possible plans. Right now,
		// though, there's only two plans (personal and team), so we only need
		// the lowest plan.
		switch ( $req_plan ) {

			case 'personal-plan':
				return true;

		}//end switch

	}//end if

	return false;

}//end nc_is_subscribed_to()

