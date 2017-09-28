<?php
enforce_login();

$Options = array(
	'1_token' => array(
		'Title' => '1 Freeleech Token',
		'Price' => 1000,
		'Action' => 'tokens',
		'Hidden' => array(
			'Amount' => 1
		)
	),
	'10_tokens' => array(
		'Title' => '10 Freeleech Tokens',
		'Price' => 9500,
		'Action' => 'tokens',
		'Hidden' => array(
			'Amount' => 10
		)
	),
	'50_tokens' => array(
		'Title' => '50 Freeleech Tokens',
		'Price' => 45000,
		'Action' => 'tokens',
		'Hidden' => array(
			'Amount' => 50
		)
	),
	'1_token_other' => array(
		'Title' => '1 Freeleech Token to Other',
		'Price' => 2500,
		'Action' => 'tokens',
		'Hidden' => array(
			'Amount' => 1,
			'Other' => 'true'
		)
	),
	'10_tokens_other' => array(
		'Title' => '10 Freeleech Tokens to Other',
		'Price' => 24000,
		'Action' => 'tokens',
		'Hidden' => array(
			'Amount' => 10,
			'Other' => 'true'
		)
	),
	'50_tokens_other' => array(
		'Title' => '50 Freeleech Tokens to Other',
		'Price' => 115000,
		'Action' => 'tokens',
		'Hidden' => array(
			'Amount' => 50,
			'Other' => 'true'
		)
	),
	'title_nobbcode' => array(
		'Title' => 'Custom Title (No BBCode)',
		'Price' => 50000,
		'Action' => 'title',
		'Hidden' => array(
			'BBCode' => 'false'
		)
	),
	'title_bbcode' => array(
		'Title' => 'Custom Title (BBCode Allowed)',
		'Price' => 150000,
		'Action' => 'title',
		'Hidden' => array(
			'BBCode' => 'true'
		)
	),
	'title_remove' => array(
		'Title' => 'Remove Custom Title',
		'Price' => 0,
		'Action' => 'title',
		'Hidden' => array(
			'Remove' => 'true'
		)
	)
);

if (isset($_GET['action'])) {
	switch ($_GET['action']) {
		case 'bprates':
			require_once(SERVER_ROOT . '/sections/bonus/bprates.php');
			break;
		case 'title':
			require_once(SERVER_ROOT . '/sections/bonus/title.php');
			break;
		case 'tokens':
			require_once(SERVER_ROOT . '/sections/bonus/tokens.php');
			break;
		default:
			error(404);
			break;
	}
}
else {
	require_once(SERVER_ROOT . '/sections/bonus/main.php');
}