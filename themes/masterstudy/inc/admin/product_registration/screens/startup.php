<?php

// Do not allow directly accessing this file.
if (!defined('ABSPATH')) {
	exit('Direct script access denied.');
}

$theme = stm_get_theme_info();
$theme_name = $theme['name'];

$creds = stm_get_creds();
$auth_code = stm_check_auth();

$message = '';

if (!empty($auth_code)) {
	$icon = 'dashicons dashicons-yes';
	$envato_market = Envato_Market::instance();
	$envato_market->items()->set_themes(true);
	$themes = $envato_market->items()->themes('purchased');
} else {
	$icon = 'dashicons dashicons-no';
	$message = esc_html__('Please make sure you have purchased this theme with the account you registered current token', 'masterstudy');
}

if (empty($creds['t'])) {
	$icon = 'dashicons dashicons-post-status';
	$message = '';
}
?>

<div class="wrap about-wrap stm-admin-wrap stm-admin-start-screen">

	<?php stm_get_admin_tabs(); ?>

	<?php if (empty($auth_code)) { ?>
        <div class="stm-notice">
            <p class="about-description">
				<?php printf(esc_html__('Thank you for choosing %s! Please register it to enable the %1$s demos and theme auto updates. The instructions below must be followed exactly.', 'masterstudy'), $theme_name); ?>
            </p>
        </div>
	<?php } ?>

    <div class="two-col panel">
		<?php
		if (!empty($themes) and !empty($auth_code)) {
			envato_market_themes_column('active');
		}
		?>
    </div>



	<?php if (!empty($message)): ?>
        <div class="stm-admin-message"><?php echo wp_kses_post($message); ?></div>
	<?php endif; ?>

	<?php if (!empty($auth_code)) { ?>
        <h3><?php esc_html_e('Congratulations! Your product is registered now.', 'masterstudy'); ?></h3>
        
	<?php } ?>

</div>