<?php

$debug = true;

$config = array(
	'db'				    	=> 'syzygy',
	'dbuser'				    => 'hotworkorders',
	'dbpwd'				        => '1stank-mofo',
	'dbhost'				    => 'localhost',
	'stylesheet_directory' 		=> 'css/',
	'javascript_directory' 		=> 'js/',
	'image_directory'			=> 'images/',
	'site_domain'			    => 'syzygy.dev',
	'login_instructions'		=> 'Please login...',
	'time_zone'			    	=> 'America/Chicago',
    'order_number_seed'         => '10010',
    'theme'                     => 'default',
    'store_id'                  => '3',
    'full_url'                  => 'http://syzygy.dev/',
    'items_per_page'            => '10',
    'filters'                   => '0'
);

$states = array(
	'AL' 	=> 'Alabama',
	'AK'	=> 'Alaska',
	'AZ'	=> 'Arizona',
	'AR'	=> 'Arkansas',
	'CA'	=> 'California',
	'CO'	=> 'Colorado',
	'CT'	=> 'Connecticut',
	'DE'	=> 'Delaware',
	'DC'	=> 'Washington D.C.',
	'FL'	=> 'Florida',
	'GA'	=> 'Georgia',
	'HI'	=> 'Hawaii',
	'ID'	=> 'Idaho',
	'IL'	=> 'Illinois',
	'IN'	=> 'Indiana',
	'IA'	=> 'Iowa',
	'KS'	=> 'Kansas',
	'KY'	=> 'Kentucky',
	'LA'	=> 'Louisiana',
	'ME'	=> 'Maine',
	'MD'	=> 'Maryland',
	'MA'	=> 'Massachusetts',
	'MI'	=> 'Michigan',
	'MN'	=> 'Minnesota',
	'MS'	=> 'Mississippi',
	'MO'	=> 'Missouri',
	'MT'	=> 'Montana',
	'NE'	=> 'Nebraska',
	'NV'	=> 'Nevada',
	'NH'	=> 'New Hampshire',
	'NJ'	=> 'New Jersey',
	'NM'	=> 'New Mexico',
	'NY'	=> 'New York',
	'NC'	=> 'North Carolina',
	'ND'	=> 'North Dakota',
	'OH'	=> 'Ohio',
	'OK'	=> 'Oklahoma',
	'OR'	=> 'Oregon',
	'PA'	=> 'Pennsylvania',
	'PR'	=> 'Puerto Rico',
	'RI'	=> 'Rhode Island',
	'SC'	=> 'South Carolina',
	'SD'	=> 'South Dakota',
	'TN'	=> 'Tennessee',
	'TX'	=> 'Texas',
	'UT'	=> 'Utah',
	'VT'	=> 'Vermont',
	'VA'	=> 'Virginia',
	'WA'	=> 'Washington',
	'WV'	=> 'West Virginia',
	'WI'	=> 'Wisconsin',
	'WY'	=> 'Wyoming',
	'AB'	=> 'Alberta',
	'BC'	=> 'British Columbia',
	'MB'	=> 'Manitoba',
	'NB'	=> 'New Brunswick',
	'NF'	=> 'Newfoundland',
	'NS'	=> 'Nova Scotia',
	'NT'	=> 'NW Territories & Nunavut',
	'ON'	=> 'Ontario',
	'PE'	=> 'Prince Edward Island',
	'QC'	=> 'Quebec',
	'SK'	=> 'Saskatchewan',
	'YT'	=> 'Yukon',

);

$lowercase_fields = array('email');

$sales_tax_regions = array('state' => array('MN'));

define('DSEP', '/');
define('SITE_PATH', realpath(dirname(__FILE__)) . '/frontend/');
define('THEME_PATH', realpath(dirname(__FILE__)) . '/frontend/themes/'. $config['theme'] . DSEP);


?>