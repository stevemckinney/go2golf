<?php
/**
 * Variable Wordpress configurations as included by wp-config.php
 */

define('PROJECT_NAME', 'go2golf');
$project_name = PROJECT_NAME;

$environments = array(
    'local_james' => 'localhost',
    'test' => 'test.',
    'stage' => 'stage.',
    'live' => 'domain.com'
);
// Get Server name
$server_name = $_SERVER['SERVER_NAME'];
 
foreach ( $environments AS $key => $env ) {
	if( strstr( $server_name, $env ) ) {
		define( 'ENVIRONMENT', $key );
		break;
	}
}
 
// If no environment is set default to production
if( ! defined('ENVIRONMENT') ) define( 'ENVIRONMENT', 'live' );

// Define different DB connection details depending on environment
switch( ENVIRONMENT ) {
    case 'local_james':
        define( 'DB_NAME', $project_name );
        define( 'DB_USER', 'jtudsbury' );
        define( 'DB_PASSWORD', 'uB9SNHczbuEmWDJC' );
        define( 'DB_HOST', 'localhost' );
        define( 'WP_DEBUG', true );
        define( 'WP_SITEURL', 'http://localhost/' . $project_name );
        define( 'WP_HOME', 'http://localhost/' . $project_name );
        
        define ('JETPACK_DEV_DEBUG', true);
        
		break;
 
    case 'test':
 
        define( 'DB_NAME', ''  );
        define( 'DB_USER', '' );
        define( 'DB_PASSWORD', '' );
        define( 'DB_HOST', 'localhost' );
        define( 'WP_SITEURL', '' . $project_name );
        define( 'WP_HOME', '' . $project_name );
    
    break;
}

if( isset( $_GET['debug'] ) ) {
	die('The current environment is: ' . ENVIRONMENT .'<br> NSM_SERVER_NAME: ' . $server_name);
}

?>