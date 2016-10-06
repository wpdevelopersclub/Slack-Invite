<?php
/**
 * Slack Invite Runtime Configuration Parameters.
 *
 * @package     UpTechLabs\SlackInvite
 * @since       1.0.0
 * @author      hellofromTonya
 * @link        https://UpTechLabs.io
 * @license     GNU General Public License 2.0+
 */

namespace UpTechLabs\SlackInvite;

use Fulcrum\Config\Config;
use UpTechLabs\SlackInvite\Admin\SettingsPage;

return array(
	'settings_page_key' => 'settings_page.slack_invite',

	'initial_parameters' => array(
		'slack_invite_user_id'    => 0,
		'slack_invite_option_key' => '_uptechlabs_slack_invite',
	),

	'register_concretes' => array(
		'invite_handler.slack_invite' => array(
			'autoload' => false,
			'concrete' => function ( $container ) {
				return new Invite(
					new Config( SLACK_INVITE_PLUGIN_DIR . 'config/invite.php' ),
					$container,
					$container['slack_invite_user_id']
				);
			}
		),
		'settings_page.slack_invite'  => array(
			'autoload' => false,
			'concrete' => function ( $container ) {
				return new SettingsPage(
					new Config( SLACK_INVITE_PLUGIN_DIR . 'config/admin/settings-page.php' )
				);
			}
		),
	),
);
