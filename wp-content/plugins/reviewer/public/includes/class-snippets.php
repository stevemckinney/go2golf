<?php

/*  for PRO users! - *
 * Reviewer Plugin v.3
 * Created by Michele Ivani
 */
class RWP_Snippets
{
	// Instance of this class
	protected static $instance = null;
	protected $properties;

	function __construct( $properties = array() )
	{
		$default = array(
			'@context' => 'http://schema.org/',
			'@type' => 'Product',
		);

		$this->properties = array_merge( $default, $properties );
	}

	public function insert() 
	{
		echo '<script type="application/ld+json">';
		echo json_encode( $this->properties );
		echo '</script>';
		//RWP_Reviewer::pretty_print( $this->get_properties() );
	}

	public function add( $key = '', $value = '' ) 
	{
		$exploded = explode('.', $key);
		$temp = &$this->properties;
		foreach($exploded as $key) {
		    $temp = &$temp[$key];
		}
		$temp = $value;
		unset($temp);
	}

	public function get_properties() 
	{
		return $this->properties;
	}

	public static function get_instance() 
	{
		// If the single instance hasn't been set, set it now.
		if ( null == self::$instance ) {
			self::$instance = new self;
		}

		return self::$instance;
	}
}