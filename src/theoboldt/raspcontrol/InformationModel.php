<?php
/**
 * Base for data models
 *
 * @category   theoboldt
 * @package    theoboldt_raspcontrol
 */

/**
 * @namespace
 */
namespace theoboldt\raspcontrol;


class InformationModel {

	/**
	 * Convert a string containing underscore separated words to camel case
	 *
	 * @param	string	$name					The name with underscore separated words
	 * @param	boolean $capitaliseFirstChar	If true, capitalise the first char in $str
	 * @return	string							The name in camel case
	 * @link	http://paulferrett.com/2009/php-camel-case-functions/
	 */
	public static function underscoreToCamel($name, $capitaliseFirstChar = false) {
	  if($capitaliseFirstChar) {
		$name[0]	= strtoupper($name[0]);
	  }
	  return preg_replace_callback(
			'/_([a-z])/',
		  	function($c) {
		  		return strtoupper($c[1]);
			},
		  	$name
	  );
	}

	/**
	 * Convert a camel case name to a string with underscore separated words
	 *
	 * @param	string	$name	The name in camel case
	 * @return	string			The name with underscore separated words
	 * @link	http://paulferrett.com/2009/php-camel-case-functions/
	 */
	public static function camelToUnderscore($name) {
	  $name[0]	= strtolower($name[0]);
	  return preg_replace_callback(
		  '/([A-Z])/',
		  function($c) {
			  return '_'.strtolower($c[1]);
		  },
		  $name
	  );
	}


	/**
	 * Get a value of a model property
	 *
	 * @param	string|null $property			Property its data you want to get
	 * @throws	\BadMethodCallException			If the given property is not available
	 * @return	mixed							Value the property contains
	 */
	public function data($property = null) {
		if ($property) {
			$element	= self::underscoreToCamel('data_'.$property);

			//check data methods
			if (method_exists($this, $element)) {
				return $this->$element();
			}

			//check protected data properties
			$element	= '_'.$element;
			if (property_exists($this, $element)) {
				return $this->$element;
			}

			//nothing found
			throw new \BadMethodCallException('No data method nor property with given name exists');
		} else {
			$data			= array();
			$propertyList	= get_class_vars(get_class($this));

			foreach($propertyList as $property => $value) {
				if (preg_match('/^_data(.*)$/', $property, $propertyName)) {
					$propertyName			= lcfirst($propertyName[1]);
					$data[$propertyName]	= $value;
				}
			}
			return $data;
		}
	}


}