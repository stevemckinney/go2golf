<?php
/**
 * Variable Wordpress configurations as included by wp-config.php
 */

define('PROJECT_NAME', 'go2golf');
$project_name = PROJECT_NAME;

$environments = array(
    'local_james' => 'goandgolf.dev',
    'local_steve' => 'goandgolf.dev',
    'stage' => 'stage.',
    'live' => 'goandgolf.co.uk'
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
        define( 'WP_SITEURL', 'http://goandgolf.dev' );
        define( 'WP_HOME', 'http://goandgolf.dev' );
        
        define ('JETPACK_DEV_DEBUG', true);
        
		break;
		
    case 'local_steve':
        define( 'DB_NAME', 'gogolf' );
        define( 'DB_USER', 'root' );
        define( 'DB_PASSWORD', 'root' );
        define( 'DB_HOST', 'localhost' );
        define( 'WP_DEBUG', true );
        define( 'WP_SITEURL', 'http://goandgolf.dev' );
        define( 'WP_HOME', 'http://goandgolf.dev' );
        
        define ('JETPACK_DEV_DEBUG', true);
        
		break;

    case 'live':
 
        define( 'DB_NAME', 'goandgol_wordpress'  );
        define( 'DB_USER', 'goandgol_admin' );
        define( 'DB_PASSWORD', 'g@cH5spebRak' );
        define( 'DB_HOST', '10.169.0.141' );
        define( 'WP_SITEURL', 'http://goandgolf.co.uk' );
        define( 'WP_HOME', 'http://goandgolf.co.uk' );
    
    break;
}

if( isset( $_GET['debug'] ) ) {
	die('The current environment is: ' . ENVIRONMENT .'<br> NSM_SERVER_NAME: ' . $server_name);
}

?>