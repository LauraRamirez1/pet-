<?php
/**
 * Theme storage manipulations
 *
 * @package WordPress
 * @subpackage TAILS
 * @since TAILS 1.0
 */

// Disable direct call
if ( ! defined( 'ABSPATH' ) ) { exit; }

// Get theme variable
if (!function_exists('tails_storage_get')) {
	function tails_storage_get($var_name, $default='') {
		global $TAILS_STORAGE;
		return isset($TAILS_STORAGE[$var_name]) ? $TAILS_STORAGE[$var_name] : $default;
	}
}

// Set theme variable
if (!function_exists('tails_storage_set')) {
	function tails_storage_set($var_name, $value) {
		global $TAILS_STORAGE;
		$TAILS_STORAGE[$var_name] = $value;
	}
}

// Check if theme variable is empty
if (!function_exists('tails_storage_empty')) {
	function tails_storage_empty($var_name, $key='', $key2='') {
		global $TAILS_STORAGE;
		if (!empty($key) && !empty($key2))
			return empty($TAILS_STORAGE[$var_name][$key][$key2]);
		else if (!empty($key))
			return empty($TAILS_STORAGE[$var_name][$key]);
		else
			return empty($TAILS_STORAGE[$var_name]);
	}
}

// Check if theme variable is set
if (!function_exists('tails_storage_isset')) {
	function tails_storage_isset($var_name, $key='', $key2='') {
		global $TAILS_STORAGE;
		if (!empty($key) && !empty($key2))
			return isset($TAILS_STORAGE[$var_name][$key][$key2]);
		else if (!empty($key))
			return isset($TAILS_STORAGE[$var_name][$key]);
		else
			return isset($TAILS_STORAGE[$var_name]);
	}
}

// Inc/Dec theme variable with specified value
if (!function_exists('tails_storage_inc')) {
	function tails_storage_inc($var_name, $value=1) {
		global $TAILS_STORAGE;
		if (empty($TAILS_STORAGE[$var_name])) $TAILS_STORAGE[$var_name] = 0;
		$TAILS_STORAGE[$var_name] += $value;
	}
}

// Concatenate theme variable with specified value
if (!function_exists('tails_storage_concat')) {
	function tails_storage_concat($var_name, $value) {
		global $TAILS_STORAGE;
		if (empty($TAILS_STORAGE[$var_name])) $TAILS_STORAGE[$var_name] = '';
		$TAILS_STORAGE[$var_name] .= $value;
	}
}

// Get array (one or two dim) element
if (!function_exists('tails_storage_get_array')) {
	function tails_storage_get_array($var_name, $key, $key2='', $default='') {
		global $TAILS_STORAGE;
		if (empty($key2))
			return !empty($var_name) && !empty($key) && isset($TAILS_STORAGE[$var_name][$key]) ? $TAILS_STORAGE[$var_name][$key] : $default;
		else
			return !empty($var_name) && !empty($key) && isset($TAILS_STORAGE[$var_name][$key][$key2]) ? $TAILS_STORAGE[$var_name][$key][$key2] : $default;
	}
}

// Set array element
if (!function_exists('tails_storage_set_array')) {
	function tails_storage_set_array($var_name, $key, $value) {
		global $TAILS_STORAGE;
		if (!isset($TAILS_STORAGE[$var_name])) $TAILS_STORAGE[$var_name] = array();
		if ($key==='')
			$TAILS_STORAGE[$var_name][] = $value;
		else
			$TAILS_STORAGE[$var_name][$key] = $value;
	}
}

// Set two-dim array element
if (!function_exists('tails_storage_set_array2')) {
	function tails_storage_set_array2($var_name, $key, $key2, $value) {
		global $TAILS_STORAGE;
		if (!isset($TAILS_STORAGE[$var_name])) $TAILS_STORAGE[$var_name] = array();
		if (!isset($TAILS_STORAGE[$var_name][$key])) $TAILS_STORAGE[$var_name][$key] = array();
		if ($key2==='')
			$TAILS_STORAGE[$var_name][$key][] = $value;
		else
			$TAILS_STORAGE[$var_name][$key][$key2] = $value;
	}
}

// Merge array elements
if (!function_exists('tails_storage_merge_array')) {
	function tails_storage_merge_array($var_name, $key, $value) {
		global $TAILS_STORAGE;
		if (!isset($TAILS_STORAGE[$var_name])) $TAILS_STORAGE[$var_name] = array();
		if ($key==='')
			$TAILS_STORAGE[$var_name] = array_merge($TAILS_STORAGE[$var_name], $value);
		else
			$TAILS_STORAGE[$var_name][$key] = array_merge($TAILS_STORAGE[$var_name][$key], $value);
	}
}

// Add array element after the key
if (!function_exists('tails_storage_set_array_after')) {
	function tails_storage_set_array_after($var_name, $after, $key, $value='') {
		global $TAILS_STORAGE;
		if (!isset($TAILS_STORAGE[$var_name])) $TAILS_STORAGE[$var_name] = array();
		if (is_array($key))
			tails_array_insert_after($TAILS_STORAGE[$var_name], $after, $key);
		else
			tails_array_insert_after($TAILS_STORAGE[$var_name], $after, array($key=>$value));
	}
}

// Add array element before the key
if (!function_exists('tails_storage_set_array_before')) {
	function tails_storage_set_array_before($var_name, $before, $key, $value='') {
		global $TAILS_STORAGE;
		if (!isset($TAILS_STORAGE[$var_name])) $TAILS_STORAGE[$var_name] = array();
		if (is_array($key))
			tails_array_insert_before($TAILS_STORAGE[$var_name], $before, $key);
		else
			tails_array_insert_before($TAILS_STORAGE[$var_name], $before, array($key=>$value));
	}
}

// Push element into array
if (!function_exists('tails_storage_push_array')) {
	function tails_storage_push_array($var_name, $key, $value) {
		global $TAILS_STORAGE;
		if (!isset($TAILS_STORAGE[$var_name])) $TAILS_STORAGE[$var_name] = array();
		if ($key==='')
			array_push($TAILS_STORAGE[$var_name], $value);
		else {
			if (!isset($TAILS_STORAGE[$var_name][$key])) $TAILS_STORAGE[$var_name][$key] = array();
			array_push($TAILS_STORAGE[$var_name][$key], $value);
		}
	}
}

// Pop element from array
if (!function_exists('tails_storage_pop_array')) {
	function tails_storage_pop_array($var_name, $key='', $defa='') {
		global $TAILS_STORAGE;
		$rez = $defa;
		if ($key==='') {
			if (isset($TAILS_STORAGE[$var_name]) && is_array($TAILS_STORAGE[$var_name]) && count($TAILS_STORAGE[$var_name]) > 0) 
				$rez = array_pop($TAILS_STORAGE[$var_name]);
		} else {
			if (isset($TAILS_STORAGE[$var_name][$key]) && is_array($TAILS_STORAGE[$var_name][$key]) && count($TAILS_STORAGE[$var_name][$key]) > 0) 
				$rez = array_pop($TAILS_STORAGE[$var_name][$key]);
		}
		return $rez;
	}
}

// Inc/Dec array element with specified value
if (!function_exists('tails_storage_inc_array')) {
	function tails_storage_inc_array($var_name, $key, $value=1) {
		global $TAILS_STORAGE;
		if (!isset($TAILS_STORAGE[$var_name])) $TAILS_STORAGE[$var_name] = array();
		if (empty($TAILS_STORAGE[$var_name][$key])) $TAILS_STORAGE[$var_name][$key] = 0;
		$TAILS_STORAGE[$var_name][$key] += $value;
	}
}

// Concatenate array element with specified value
if (!function_exists('tails_storage_concat_array')) {
	function tails_storage_concat_array($var_name, $key, $value) {
		global $TAILS_STORAGE;
		if (!isset($TAILS_STORAGE[$var_name])) $TAILS_STORAGE[$var_name] = array();
		if (empty($TAILS_STORAGE[$var_name][$key])) $TAILS_STORAGE[$var_name][$key] = '';
		$TAILS_STORAGE[$var_name][$key] .= $value;
	}
}

// Call object's method
if (!function_exists('tails_storage_call_obj_method')) {
	function tails_storage_call_obj_method($var_name, $method, $param=null) {
		global $TAILS_STORAGE;
		if ($param===null)
			return !empty($var_name) && !empty($method) && isset($TAILS_STORAGE[$var_name]) ? $TAILS_STORAGE[$var_name]->$method(): '';
		else
			return !empty($var_name) && !empty($method) && isset($TAILS_STORAGE[$var_name]) ? $TAILS_STORAGE[$var_name]->$method($param): '';
	}
}

// Get object's property
if (!function_exists('tails_storage_get_obj_property')) {
	function tails_storage_get_obj_property($var_name, $prop, $default='') {
		global $TAILS_STORAGE;
		return !empty($var_name) && !empty($prop) && isset($TAILS_STORAGE[$var_name]->$prop) ? $TAILS_STORAGE[$var_name]->$prop : $default;
	}
}
?>