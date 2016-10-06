# Slack Invite Plugin

This plugin automatically invites new users to your Slack team.  It adds a Settings Page for you to specify your Slack team's name and API key.  Then each time a person signs up, this plugin communicates with the Slack API to invite the new user.
	 	
## How to Use It

This plugin adds a new Settings Page called "Slack Invite."  You can find it in Settings > Slack Invite.  On this page, you add your team's name and the Slack API.  Don't worry.  There's a button and instructions available on the page for you to get the API key.

### Changing When it Fires

The plugin is registered to the WordPress event `register_new_user`, which is fired in Core's `wp-includes/user.php` when the function `register_new_user()` is called.  Therefore, any time that a new user is registered on your website using this function, then this plugin will talk to Slack to invite the new user.  If you want to register this interaction to a different event name, then go into `src/Plugin.php` and change the event name.  For example, maybe you want to use a form plugin such as Ninja Forms or Gravity Forms.  Then you may want to change how this plugin fires.

## Installation

1. Install the [Fulcrum](https://github.com/hellofromtonya/Fulcrum), the central custom repository plugin for WordPress.
2. Then you can install this plugin.

Installation from GitHub is as simple as cloning the repo onto your local machine.  To clone the repo, do the following:

1. Using PhpStorm, open your project and navigate to `wp-content/plugins/`. (Or open terminal and navigate there).
2. Then type: `git clone https://github.com/wpdevelopersclub/Slack-Invite.git`.

## Configuration
Everything is configurable using the configuration files found in the `config` folder.

## Contributions

All feedback, bug reports, and pull requests are welcome.