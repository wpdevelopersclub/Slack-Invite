<h3><?php _e( 'Slack Invite', 'slack_invite' ); ?></h3>
<table class="form-table">
	<tbody>
	<tr>
		<th scope="row"><?php _e( 'Invite Status', 'genesis' ); ?></th>
		<td>
			<label for="slackinvite_meta[_slack_invite_sent]">
				<input id="slackinvite_meta[_slack_invite_sent]" name="slackinvite_meta[_slack_invite_sent]" type="checkbox" value="1" <?php checked( get_the_author_meta( '_slack_invite_sent', $user->ID ) ); ?> />
				<?php _e( 'Slack Invite Sent?', 'slack_invite' ); ?>
			</label>
		</td>
	</tr>
	<tr>
		<th scope="row"><?php _e( 'Request Invitation', 'genesis' ); ?></th>
		<td>
			<label for="_slack_invite_send_request">
				<input id="slackinvite_meta[_slack_invite_send_request]" name="_slack_invite_send_request" type="checkbox" value="1" />
				<?php _e( 'Request Invite from Slack', 'slack_invite' ); ?>
			</label><br>
			<span class="description">Click to request an invitation to be sent to this specific user.</span>
		</td>
	</tr>
	</tbody>
</table>