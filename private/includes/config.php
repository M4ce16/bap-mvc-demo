<?php
// Kopieer dit bestand naar config.php met je eigen gegevens
// config.php wordt niet naar Github gestuurd, wel zo veilig.
// Zet dus NOOIT in dit bestand je geheime gegevens, deze dient alleen als voorbeeld

$config = [
	'DB'       => [
		'HOSTNAME' => 'localhost',
		'DATABASE' => 'covidhelp',
		'USER'     => 'root',
		'PASSWORD' => ''
		// 'HOSTNAME' => '127.0.0.1',
		// 'DATABASE' => 'c4989covid19',
		// 'USER'     => 'c4989covid19',
		// 'PASSWORD' => 'jmaejzsx'
	],
	'MAIL'       => [
		'SMTP_HOST' 		=> 'debugmail.io',
		'SMTP_USER' 		=> '28471@ma-web.nl',
		'SMTP_PASSWORD' => 'dc4968e0-b7ba-11ea-b1f3-51dcc2843610',
		'SMTP_PORT' 		=> '25',
	],
	'BASE_URL' => '/proj/public',  // Zet hier het pad naar de public map in, vanaf http://localhost, anders werken je routes niet!
	'BASE_HOST' => 'http://localhost',
	'ROOT'     => dirname( dirname( __DIR__ ) ),
	'PRIVATE'  => dirname( __DIR__ ),
	'WEBROOT'  => dirname( dirname( __DIR__ ) ) . '/public'
];

return $config;
