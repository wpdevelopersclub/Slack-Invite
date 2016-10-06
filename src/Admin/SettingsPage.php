<?php
/**
 * Slack Invite Settings Page
 *
 * @package     UpTechLabs\SlackInvite\Admin
 * @since       1.0.0
 * @author      hellofromTonya
 * @link        https://UpTechLabs.io
 * @license     GNU General Public License 2.0+
 */
namespace UpTechLabs\SlackInvite\Admin;

use Fulcrum\Config\Config_Contract;

class SettingsPage {

	/**
	 * Instance of the configuration
	 *
	 * @var Config_Contract
	 */
	protected $config;

	/**
	 * Menu Page
	 *
	 * @var string
	 */
	protected $menu_page = '';

	/**************************
	 * Instantiate & Initialize
	 *************************/

	/**
	 * Instantiate the object
	 *
	 * @since 1.0.0
	 *
	 * @param Config_Contract $config
	 */
	public function __construct( Config_Contract $config ) {
		$this->config = $config;

		$this->add_admin_menu();
		$this->init_events();
	}

	/**
	 * Initialize the events.
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	protected function init_events(){
		add_action( 'admin_init', array( $this, 'setup_settings_api' ) );
	}

	/**
	 * Setup the Settings API
	 *
	 * @since 1.0.0
	 *
	 * @return null
	 */
	protected function add_admin_menu() {
		add_options_page(
			$this->config->page_title,
			$this->config->menu_title,
			$this->config->capability,
			$this->config->menu_slug,
			array( $this, 'render_admin_menu' )
		);
	}

	/**
	 * Setup the section and fields
	 *
	 * @since 1.0.0
	 *
	 * @return null
	 */
	public function setup_settings_api() {
		register_setting( $this->config->setting_field, $this->config->option_name );

		add_settings_section(
			$this->config->settings_section['id'],
			$this->config->settings_section['title'],
			array( $this, 'render_section' ),
			$this->config->setting_field
		);

		array_walk( $this->config->settings_fields, array( $this, 'add_settings_field' ) );
	}

	/**
	 * Add the settings field
	 *
	 * @since 1.0.0
	 *
	 * @param array $setting
	 */
	protected function add_settings_field( array $setting ) {
		add_settings_field(
			$setting['id'],
			$setting['title'],
			array( $this, 'render_field' ),
			$this->config->setting_field,
			$setting['section'],
			$setting['args']
		);
	}

	/**
	 * Render the page's HTML
	 *
	 * @since 1.0.0
	 *
	 * @return null
	 */
	public function render_admin_menu() {
		if ( is_readable( $this->config->views['page'] ) ) {
			include_once( $this->config->views['page'] );
		}
	}

	/**
	 * Render the section's HTML
	 *
	 * @since 1.0.0
	 *
	 * @param array $args
	 */
	public function render_section( array $args ) {
		if ( is_readable( $this->config->views['section'] ) ) {
			include_once( $this->config->views['section'] );
		}
	}

	/**
	 * Render the field's HTML
	 *
	 * @since 1.0.0
	 *
	 * @param array $args
	 */
	public function render_field( array $args ) {
		if ( is_readable( $args['view'] ) ) {
			include( $args['view'] );
		}
	}
}
