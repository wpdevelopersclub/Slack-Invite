<?php
/**
 * Invite Handler's Runtime Configuration Parameters.
 *
 * @package     UpTechLabs\SlackInvite
 * @since       1.0.0
 * @author      hellofromTonya
 * @link        https://UpTechLabs.io
 * @license     GNU General Public License 2.0+
 */
namespace UpTechLabs\SlackInvite;

return array(
	'user_id_key'      => 'slack_invite_user_id',
	'slack_option_key' => 'slack_invite_option_key',
	'messages'         => array(
		'success'         => __( 'Your invitation is on its way to you. Check your inbox.  If it\'s there, please check in your spam box.', 'slack_invite' ),
		'already_in_team' => __( 'You are already registered in our Slack Community.', 'slack_invite' ),
		'sent_recently'   => __( 'You have already been invited in this team!', 'slack_invite' ),
		'invalid_auth'    => __( 'Whoops, the Slack configuration is not correct.  Use our Contact Form and let us know about it.', 'slack_invite' ),
		'error'           => __( 'Whoops, something went wrong: %s', 'slack_invite' ),
	),
);