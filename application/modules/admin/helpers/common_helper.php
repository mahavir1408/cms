<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if (!function_exists('stripNumericElements'))
{
    function stripNumericElements($arrayEntry) { 
		return !is_numeric($arrayEntry);
	}
}