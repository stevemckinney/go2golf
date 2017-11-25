<?php
/*
	Admin panel initialisation helpers.
 */

 require_once(plugin_dir_path( __FILE__ ) . '../functionality/helpers.php');


function lcp_admin_menu() { add_menu_page( 'Locup Search Settings', 'Locup Search', 'manage_options', 'locup-search', 'lcp_admin_page' ); }
function lcp_admin_page() {

	// Output buffering allows nice code formatting in the template.
	ob_start();
	require_once(plugin_dir_path( __FILE__ ) . '../templates/admin.php');
	$markup = ob_get_contents();
	ob_end_clean();

	echo $markup;
}

function locup_init() {

	// Register sections.
	add_settings_section(
		'locup_settings',
		'General Settings',
		'locup_general_options_cb',
		'locup-search'
	);


	// Register fields.
	add_settings_field(
		'locup_google_key',
		'Google API key',
		'locup_field_key_markup',
		'locup-search',
		'locup_settings'
	);
	add_settings_field(
		'locup_match_title',
		'Location Title Search',
		'locup_field_title_markup',
		'locup-search',
		'locup_settings'
	);
	add_settings_field(
		'locup_blacklist',
		'Blacklist',
		'locup_field_blacklist_markup',
		'locup-search',
		'locup_settings'
	);


	// register settings for the plugin.
	//  register_setting( 'locup', 'lcp_places' ); this is auto generates
	register_setting( 'locup-search', 'locup_match_title' );
	register_setting( 'locup-search', 'locup_blacklist' );
	register_setting( 'locup-search', 'locup_google_key' );

}

function locup_field_blacklist_markup() {
	$html = '<label for="locup_blacklist">Comma-separated list of words to ignore in the location name search.</label><br />';
	$html .= '<textarea id="locup_blacklist" name="locup_blacklist" rows="5">';
	$html .= get_option('locup_blacklist');
    $html .= '</textarea>';

    echo $html;
}
function locup_field_title_markup() {
	$html = '<input type="checkbox" id="locup_match_title" name="locup_match_title" value="1" ' . checked(1, get_option('locup_match_title'), false) . '/>';

    echo $html;
}
function locup_field_key_markup() {
	$html = '<input type="text" id="locup_google_key" name="locup_google_key" value="' . get_option('locup_google_key') . '" />';

    echo $html;
}


 ?>
