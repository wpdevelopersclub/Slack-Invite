<?php
/**
 * Plugin Controller
 *
 * @package     UpTechLabs\SlackInvite
 * @since       1.2.0
 * @author      hellofromTonya
 * @link        https://UpTechLabs.io
 * @license     GNU General Public License 2.0+
 */
namespace UpTechLabs\SlackInvite;

use Fulcrum\Addon\Addon;

class Plugin extends Addon {

	/**
	 * The plugin's version
	 *
	 * @var string
	 */
	const VERSION = '1.0.0';

	/**
	 * The plugin's minimum WordPress requirement
	 *
	 * @var string
	 */
	const MIN_WP_VERSION = '4.5';

	/**
	 * Invite Handler
	 *
	 * @var Invite
	 */
	protected $invite_handler;

	/**
	 * Initialize events.
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	protected function init_events() {
		add_action( 'admin_menu', array( $this, 'init_settings_page') );

		add_action( 'register_new_user', array( $this, 'slack_invite' ) );
		add_action( 'edit_user_profile_update', array( $this, 'check_if_slack_invite_requested' ) );
	}

	public function check_if_slack_invite_requested( $user_id ) {
		if ( ! current_user_can( 'edit_user', $user_id ) ) {
			return;
		}

		if ( ! isset( $_POST['_slack_invite_send_request'] ) || ! $_POST['_slack_invite_send_request'] ) {
			return;
		}

		$this->slack_invite( $user_id );
	}

	/**
	 * Send out the Slack Invitation for a new member
	 *
	 * @since 1.1.1
	 *
	 * @param integer $user_id The ID of the registered user
	 * @return null
	 */
	public function slack_invite( $user_id ) {
		$this->fulcrum['slack_invite_user_id'] = (int) $user_id;

		if ( $this->fulcrum->has( 'invite_handler.slack_invite' ) ) {
			$this->invite_handler = $this->fulcrum['invite_handler.slack_invite'];
		}
	}

	/**
	 * Initialize the settings page.
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	public function init_settings_page() {
		$key = $this->config->settings_page_key;

		if ( ! $key ) {
			return;
		}

		if ( $this->fulcrum->has( $key ) ) {
			$this->fulcrum[ $key ];
		}
	}
}
