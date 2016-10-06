<?php
/**
 * Slack invite's admin settings page runtime configuration parameters
 *
 * @package     UpTechLabs\SlackInvite\Admin;
 * @since       1.0.0
 * @author      hellofromTonya
 * @link        https://UpTechLabs.io
 * @license     GNU General Public License 2.0+
 */

namespace UpTechLabs\SlackInvite\Admin;

return array(
	'page_title'       => 'Slack Invite',
	'menu_title'       => 'Slack Invite',
	'capability'       => 'manage_options',
	'menu_slug'        => 'uptechlabs_slack_invite_settings_menu',

	/******************************
	 * Register Setting Config
	 *****************************/

	'setting_field'    => 'uptechlabs_slack_invite',
	'option_name'      => '_uptechlabs_slack_invite',

	/******************************
	 * Settings Section
	 *****************************/

	'settings_section' => array(
		'id'    => 'uptechlabs_slack_invite_settings_menu',
		'title' => __( 'Setup', 'slack_invite' ),
		'page'  => 'uptechlabs_slack_invite_setup',
	),
	'settings_fields'  => array(
		array(
			'id'      => 'uptechlabs_slack_invite_field_team_name',
			'title'   => __( 'Slack Team Name', 'slack_invite' ),
			'page'    => 'uptechlabs_slack_invite_setup',
			'section' => 'uptechlabs_slack_invite_settings_menu',
			'args'    => array(
				'view' => SLACK_INVITE_PLUGIN_DIR . 'src/Admin/views/team-name.php',
			),
		),
		array(
			'id'       => 'uptechlabs_slack_invite_field_api_token',
			'title'    => __( 'Slack API Token', 'slack_invite' ),
			'callback' => 'api_token',
			'page'     => 'uptechlabs_slack_invite_setup',
			'section'  => 'uptechlabs_slack_invite_settings_menu',
			'args'     => array(
				'view' => SLACK_INVITE_PLUGIN_DIR . 'src/Admin/views/api-token.php',
			),
		),
	),
	'views'            => array(
		'page'    => SLACK_INVITE_PLUGIN_DIR . 'src/Admin/views/settings-page.php',
		'section' => SLACK_INVITE_PLUGIN_DIR . 'src/Admin/views/settings-page.php',
	),
	'page_title'       => __( 'Configure Slack Invite API', 'slack_invite' ),
);
