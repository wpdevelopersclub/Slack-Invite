<div class="wrap">
	<h2><?php echo $this->config->page_title; ?></h2>

	<form action="options.php" method="POST">
		<?php
		settings_fields( $this->config->setting_field );
		do_settings_sections( $this->config->setting_field );
		submit_button();
		?>
	</form>
</div>