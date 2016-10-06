<?php
/**
 * Slack Invite Handler
 *
 * @package     UpTechLabs\SlackInvite
 * @since       1.0.0
 * @author      hellofromTonya
 * @link        https://UpTechLabs.io
 * @license     GNU General Public License 2.0+
 */
namespace UpTechLabs\SlackInvite;

use Fulcrum\Config\Config_Contract;
use Fulcrum\Fulcrum_Contract;

class Invite {

	/**
	 * Instance of Fulcrum
	 *
	 * @var Fulcrum_Contract
	 */
	protected $fulcrum;

	/**
	 * Instance of the configuration
	 *
	 * @var Config_Contract
	 */
	protected $config;

	protected $team_name;
	protected $api_token;

	protected $packet = array(
		'email'      => '',
		'first_name' => '',
		'last_name'  => '',
		'token'      => '',
		'set_active' => 'true',
		'_attempts'  => 2,
	);

	/**
	 * Response Message
	 *
	 * @var string
	 */
	protected $response_message;

	/**************
	 * Getters
	 *************/

	/**
	 * Get the return response from Slack
	 *
	 * @since 1.0.0
	 *
	 * @return mixed
	 */
	public function getResponse() {
		return $this->response_message;
	}

	/**************************
	 * Instantiate & Initialize
	 *************************/

	/**
	 * Instantiate the object
	 *
	 * @since 1.0.0
	 *
	 * @param Config_Contract $config
	 * @param Fulcrum_Contract $fulcrum
	 */
	public function __construct( Config_Contract $config, Fulcrum_Contract $fulcrum ) {
		$this->config  = $config;
		$this->fulcrum = $fulcrum;

		if ( $this->init_packet() === false ) {
			return;
		}

		$this->process_invite( $this->build_slack_url() );
	}

	/**
	 * Initialize the data packet to be sent to Slack's API
	 *
	 * @since 1.0.0
	 *
	 * @return null
	 */
	protected function init_packet() {
		$options = $this->get_options();
		if ( $options === false ) {
			return false;
		}

		$this->api_token = $this->packet['token'] = strip_tags( $options['api_token'] );
		$this->team_name = strip_tags( $options['team_name'] );

		return $this->init_user_in_packet();
	}

	/**
	 * Initialize the user in the packet.
	 *
	 * @since 1.0.0
	 *
	 * @return bool
	 */
	protected function init_user_in_packet() {
		$user_data = $this->get_user();
		if ( $user_data === false ) {
			return false;
		}

		$this->packet['email']      = sanitize_email( $user_data->user_email );
		$this->packet['first_name'] = strip_tags( $user_data->first_name );
		$this->packet['last_name']  = strip_tags( $user_data->last_name );
	}

	/**************************
	 * Main
	 *************************/

	/**
	 * Process the invite
	 *
	 * @since 1.0.0
	 *
	 * @param string $slack_url
	 *
	 * @return null
	 */
	protected function process_invite( $slack_url ) {
		$response               = wp_remote_post( $slack_url . '/api/users.admin.invite?t=1', array( 'body' => $this->packet ) );
		$this->response_message = $this->get_slack_message( $response );
	}

	/**************************
	 * Helpers
	 *************************/

	/**
	 * Get the Slack Message from the Response
	 *
	 * @since 1.0.0
	 *
	 * @param $response
	 *
	 * @return string
	 */
	protected function get_slack_message( $response ) {
		if ( ! is_wp_error( $response ) && 200 === wp_remote_retrieve_response_code( $response ) ) {
			return $this->decode_slack_response( $response );
		}

		return $this->get_general_error_message( $response );
	}

	/**
	 * Decode Slack Response
	 *
	 * @since 1.0.0
	 *
	 * @param $response
	 *
	 * @return string Returns a message
	 */
	protected function decode_slack_response( $response ) {
		$slack_response = json_decode( wp_remote_retrieve_body( $response ) );
		if ( $slack_response->ok ) {
			return $this->config->messages['success'];
		}

		if ( ! isset( $slack_response->error ) ) {
			return '';
		}

		if ( $this->config->has( "messages.{$slack_response->error}" ) ) {
			return $this->config->messages[ $slack_response->error ];
		}

		return $this->get_general_error_message( $slack_response->error, true );
	}

	/**
	 * Get the General Error Message
	 *
	 * @since 1.0.0
	 *
	 * @param $response
	 * @param bool|false $use_standard_error
	 *
	 * @return string
	 */
	protected function get_general_error_message( $response, $use_standard_error = false ) {
		return sprintf( $this->config->messages['error'],
			$use_standard_error
				? $response
				: wp_remote_retrieve_response_code( $response )
		);
	}

	/**
	 * Build and return Slack URL
	 *
	 * @since 1.0.0
	 *
	 * @return string
	 */
	protected function build_slack_url() {
		return esc_url( 'https://' . $this->team_name . '.slack.com' );
	}

	/**
	 * Get the options.
	 *
	 * @since 1.0.0
	 *
	 * @return bool|array
	 */
	protected function get_options() {
		$options = get_option( $this->fulcrum[ $this->config->slack_option_key ] );
		if ( empty( $options ) || ! array_key_exists( 'team_name', $options ) ) {
			return false;
		}

		return $options;
	}

	/**
	 * Get the user.
	 *
	 * @since 1.0.0
	 *
	 * @return bool
	 */
	protected function get_user() {
		if ( ! $this->fulcrum->has( $this->config->user_id_key ) ) {
			return false;
		}

		$user_id = (int) $this->fulcrum[ $this->config->user_id_key ];

		return get_userdata( $user_id );
	}
}
