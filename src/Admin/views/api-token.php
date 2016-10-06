<?php
$options = get_option( $this->config->option_name );
$team_name = is_array( $options ) && array_key_exists( 'team_name', $options ) ? esc_attr( $options['team_name'] ) : 'SLACKTEAMNAME';
$api_token = is_array( $options ) && array_key_exists( 'team_name', $options ) ? esc_attr( $options['api_token'] ) : '';
?>

<label>
	<input type="text" required="required" name="<?php echo $this->config->option_name; ?>[api_token]" value="<?php echo $api_token; ?>" size="50">
</label>
<p class="description">
	<?php _e( 'API Security Token from the team\'s Slack invitation group.', 'wpdc' ); ?>
</p>
<!-- Credit to Julio Potier for this applet -->
<br />
<p class="description">
	<?php printf( __( 'To find your token you have to use the bookmarklet below.  Open up the teams invitation page <code>https://%s.slack.com/admin/invites</code>. Then drag and drop the link below into the browser\'s address bar.', 'wpdc' ), $team_name ); ?>
</p>
<p>
	<a class="button button-small button-secondary" href="javascript:prompt( 'Slack Invite API Token', boot_data.api_token);" onclick="alert('<?php echo esc_js( __( 'Drag/drop me in our browser toolbar before!', 'wpdc' ) ); ?>');return false;">
		<?php _e( 'Slack Invite API Token', 'wpdc' ); ?>
	</a>
</p>