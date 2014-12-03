<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
| -------------------------------------------------------------------
| Site and HQ configuration
| -------------------------------------------------------------------
| This file is used to store config options for HQ code. Having this stored
| in a seperate file makes it easier to upgrade when new versions of
| CodeIgniter are released.
|
| -------------------------------------------------------------------
| SQL Query Logging
| -------------------------------------------------------------------
|
| The HQ_DB class provides the ability to log all queries executed when
| generating a page. This can be useful in troubleshooting, but can generate
| very large log files if left on in production.
|
| Only turn on this setting in production when troubleshooting.
|
*/

// When set to true, all SQL queries will be logged.
$config['log_sql']  = FALSE;

// Where to store the SQL logs, the folder must exist or logging will fail.
$config['log_sql_path'] = realpath(APPPATH.'logs'.DIRECTORY_SEPARATOR.'sql'.DIRECTORY_SEPARATOR);
// There are two types of sql log, csv and multi.
// - csv is for working with the data in excel or loading into a db table.
// - multi is a multi-line display that is easier to read without external tools.
$config['log_sql_type']  = 'csv';

/*
| -------------------------------------------------------------------
| Layout defaults
| -------------------------------------------------------------------
|
| The HQ_Layout class uses these settings as defaults. Setting these values means
| they don't need to be set in the controller.
|
*/

// Which layout to use?
// Options are 3col, 2col and 1col
$config['layout'] = '4col';

// This is the doctype that will be used throughout the site:
// - trasitional: XTHML 1.0 transitional doctype
// - strict: XTHML 1.0 strict doctype
// - If you don't want either of these doctypes, set this value to the doctype you want to use
$config['doctype'] = 'html5';

// Filename of the css file to use for layout
// Give the filename / path in relation to the site/css folder
$config['layout_css'] = '';

// Standard css files to be used site-wide
//$config['standard_css'] = array('style.css');
$config['standard_css'] = array();

// Standard print css files to be used site-wide
//$config['standard_print_css'] = array('');

// Standard meta tags to be used site-wide
// Array entries should be in the format 'name' => 'content'
// Example:  'copyright' => 'All content and images copyright &copy; 2008, Sitename';
$config['standard_meta'] = array();

// Standard javascript files to be used site-wide
// Give the filename / path in relation to the site/js folder
//$config['standard_js'] = array('jquery.min.js','autohidetimeout.js');
$config['standard_js'] = array();

// Set extra code that should be added to the head tag site-wide
// Should be the actual code, no transformation is done on this value.
$config['standard_misc_head'] = '<!-- This is a comment in the head -->';

//Set the default structure file for setting the content inside head tag
$config['structureFile'] = 'frontend/structure';
?>
