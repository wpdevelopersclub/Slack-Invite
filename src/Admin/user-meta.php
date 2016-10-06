<?php
/**
 * User Metabox
 *
 * @package     UpTechLabs\SlackInvite\Admin
 * @since       1.0.0
 * @author      hellofromTonya
 * @link        https://UpTechLabs.io
 * @license     GNU General Public License 2.0+
 */
namespace UpTechLabs\SlackInvite\Admin;

add_action( 'show_user_profile', __NAMESPACE__ . '\render_user_metabox' );
add_action( 'edit_user_profile', __NAMESPACE__ . '\render_user_metabox' );
function render_user_metabox( $user ) {

	if ( ! current_user_can( 'edit_users', $user->ID ) ) {
		return false;
	}

	require_once( 'views/send-user-request.php' );
}
