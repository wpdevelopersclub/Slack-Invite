<?php
$options = get_option( $this->config->option_name );
$team_name = is_array( $options ) && array_key_exists( 'team_name', $options ) ? esc_attr( $options['team_name'] ) : '';
?>
<label>
	<input type="text" required="required" name="<?php echo $this->config->option_name; ?>[team_name]" value="<?php echo $team_name; ?>">
</label>
<p class="description">
	<?php _e( 'Name of the Slack Team.', 'wpdc' ); ?>
</p>