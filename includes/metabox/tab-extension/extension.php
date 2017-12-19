<?php
if ( is_admin() ) {
	// Run autoloader
	include __DIR__ . '/inc/assets.class.php';
	include __DIR__ . '/inc/cmb2-tabs.class.php';

	// Connection css and js
	new Assets();

	// Run global class
	new CMB2_Tabs();
}
?>