<?php
// Dit bestand hoort bij de router, enb bevat nog een aantal extra functiesdie je kunt gebruiken
// Lees meer: https://github.com/skipperbent/simple-php-router#helper-functions
require_once __DIR__ . '/route_helpers.php';

// Hieronder kun je al je eigen functies toevoegen die je nodig hebt
// Maar... alle functies die gegevens ophalen uit de database horen in het Model PHP bestand

/**
 * Verbinding maken met de database
 * @return \PDO
 */
function dbConnect() {

	$config = get_config('DB');

	try {
		$dsn = 'mysql:host=' . $config['HOSTNAME'] . ';dbname=' . $config['DATABASE'] . ';charset=utf8';

		$connection = new PDO( $dsn, $config['USER'], $config['PASSWORD'] );

		$connection->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
		$connection->setAttribute( PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC );

		return $connection;

	} catch ( \PDOException $e ) {
		echo 'Fout bij maken van database verbinding: ' . $e->getMessage();
		exit;
	}

}

/**
 * Geeft de juiste URL terug: relatief aan de website root url
 * Bijvoorbeeld voor de homepage: echo url('/');
 *
 * @param $path
 *
 * @return string
 */
function site_url( $path = '' ) {
	return get_config( 'BASE_URL' ) . $path;
}

function absolute_url( $path = '' ) {
	return get_config( 'BASE_HOST' ) . $path;
}
function get_config( $name ) {
	$config = require __DIR__ . '/config.php';
	$name = strtoupper( $name );

	if ( isset( $config[ $name ] ) ) {
		return $config[$name];
	}

	throw new \InvalidArgumentException( 'Er bestaat geen instelling met de key: ' . $name );
}

/**
 * Hier maken we de template engine en vertellen de template engine waar de templates/views staan
 * @return \League\Plates\Engine
 */
function get_template_engine() {

	$templates_path = get_config( 'PRIVATE' ) . '/views';

	return new League\Plates\Engine( $templates_path );

}

function current_route_is( $name ) {
	$route = request()->getLoadedRoute();

	if ( $route ) {
		return $route->hasName( $name );
	}

	return false;
}

function validateRegistrationData($data) {
	$errors = [];

	$email = filter_var( $_POST['email'], FILTER_VALIDATE_EMAIL);
	$password = trim( $_POST['password'] );

	if ( $email === false ) {
		$errors['email'] = 'Geen geldige email address ingevuld';
	}

	if ( strlen( $password ) < 6 ) {
		$errors['password'] = 'Geen geldige password ingevuld (minimaal 6 tekens)';
	}

	$data = [
		'email' => $email,
		'password' => $password
	];

	return [
		'data' => $data,
		'errors' => $errors
	];

	return $result;

}

function userNotRegistered($email) {

$connection = dbConnect();
$sql        = "SELECT * FROM `accounts` WHERE `email` = :email";
$statement  = $connection->prepare($sql);
$statement->execute( [ 'email' => $email ] );

return ($statement->rowCount() === 0);
}

function createUser($email, $password, $code) {

	$connection = dbConnect();

	$sql           = "INSERT INTO `accounts` (`email`, `password`, `code`) VALUES (:email, :password, :code)";
	$statement     = $connection->prepare($sql);
	$safe_password = sha1( $password );
	$params        = [
	'email'       => $email,
	'password'  => $safe_password,
	'code'       => $code
];
	$statement->execute( $params );
}

/**
 * Maak de SwiftMailer aan en stet hem op de juiste manier in
 *
 * @return Swift_Mailer
 */
function getSwiftMailer() {
	$mail_config = get_config( 'MAIL' );
	$transport   = new \Swift_SmtpTransport( $mail_config['SMTP_HOST'], $mail_config['SMTP_PORT'] );
	$transport->setUsername($mail_config['SMTP_USER'] );
	$transport->setPassword($mail_config['SMTP_PASSWORD']);

	$mailer = new \Swift_Mailer( $transport );

	return $mailer;
}

/**
 * Maak een Swift_Message met de opgegeven subject, afzender en ontvanger
 *
 * @param $to
 * @param $subject
 * @param $from_name
 * @param $from_email
 *
 * @return Swift_Message
 */
function createEmailMessage( $to, $subject, $from_name, $from_email ) {

	// Create a message
	$message = new \Swift_Message( $subject );
	$message->setFrom( [ $from_email => $from_email ] );
	$message->setTo( $to );

	// Send the message
	return $message;
}

/**
 *
 * @param $message \Swift_Message De Swift Message waarin de afbeelding ge-embed moet worden
 * @param $filename string Bestandsnaam van de afbeelding (wordt automatisch uit juiste folder gehaald)
 *
 * @return mixed
 */
function embedImage( $message, $filename ) {
	$image_path = get_config( 'WEBROOT' ) . '/images/email/' . $filename;
	if ( ! file_exists( $image_path ) ) {
		throw new \RuntimeException( 'Afbeelding bestaat niet: ' . $image_path );
	}

	$cid = $message->embed( \Swift_Image::fromPath( $image_path ) );

	return $cid;
}
/**
*	confirms an account bby confirmation code
* @param string $code The code to confirm
*/
function confirmAccount($code) {
	$connection = dbConnect();
	$sql 				= "UPDATE `accounts` SET `code` = NULL WHERE `code` = :code";
	$statement	= $connection->prepare($sql);
	$params = [
		'code' => $code
	];
	$statement->execute($params);
}

function sendConfirmationEmail($email, $code) {

	$url = url('register.name', ['code' => $code]);
	$absolute_url = absolute_url($url);

	$mailer = getSwiftMailer();
	$message = createEmailMessage( $email, 'Bevestig je account', 'covidhelp', '28471@ma-web.nl');
	$email_text = 'Beste klant, <br><br>Bevestig nu je account: <br><br><a style="padding: 10px; background-color: red; color:white; border-radius: 20px; border: solid 2px black; text-decoration: none; font-weight: bold;" href="' . $absolute_url . '">Bevestig nu!</a><br><br><br>met vriendelijke groet,<br><br>Team covidhelp';
	$message->setBody($email_text, 'text/html');
	$mailer->send($message);
}
// // <?php
// // Dit bestand hoort bij de router, enb bevat nog een aantal extra functiesdie je kunt gebruiken
// // Lees meer: https://github.com/skipperbent/simple-php-router#helper-functions
// require_once __DIR__ . '/route_helpers.php';
//
// // Hieronder kun je al je eigen functies toevoegen die je nodig hebt
// // Maar... alle functies die gegevens ophalen uit de database horen in het Model PHP bestand
//
// /**
//  * Verbinding maken met de database
//  * @return \PDO
//  */
// function dbConnect() {
//
// 	$config = get_config('DB');
//
// 	try {
// 		$dsn = 'mysql:host=' . $config['HOSTNAME'] . ';dbname=' . $config['DATABASE'] . ';charset=utf8';
//
// 		$connection = new PDO( $dsn, $config['USER'], $config['PASSWORD'] );
//
// 		$connection->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
// 		$connection->setAttribute( PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC );
//
// 		return $connection;
//
// 	} catch ( \PDOException $e ) {
// 		echo 'Fout bij maken van database verbinding: ' . $e->getMessage();
// 		exit;
// 	}
//
// }
//
// /**
//  * Geeft de juiste URL terug: relatief aan de website root url
//  * Bijvoorbeeld voor de homepage: echo url('/');
//  *
//  * @param $path
//  *
//  * @return string
//  */
// function site_url( $path = '' ) {
// 	return get_config( 'BASE_URL' ) . $path;
// }
//
// function get_config( $name ) {
// 	$config = require __DIR__ . '/config.php';
// 	$name = strtoupper( $name );
//
// 	if ( isset( $config[ $name ] ) ) {
// 		return $config[$name];
// 	}
//
// 	throw new \InvalidArgumentException( 'Er bestaat geen instelling met de key: ' . $name );
// }
//
// /**
//  * Hier maken we de template engine en vertellen de template engine waar de templates/views staan
//  * @return \League\Plates\Engine
//  */
// function get_template_engine() {
//
// 	$templates_path = get_config( 'PRIVATE' ) . '/views';
//
// 	return new League\Plates\Engine( $templates_path );
//
// }
//
// function current_route_is( $name ) {
// 	$route = request()->getLoadedRoute();
//
// 	if ( $route ) {
// 		return $route->hasName( $name );
// 	}
//
// 	return false;
// }
//
// function validateRegistrationData($data) {
// 	$errors = [];
//
// 	$email = filter_var( $_POST['email'], FILTER_VALIDATE_EMAIL);
// 	$password = trim( $_POST['password'] );
//
// 	if ( $email === false ) {
// 		$errors['email'] = 'Geen geldige email address ingevuld';
// 	}
//
// 	if ( strlen( $password ) < 6 ) {
// 		$errors['password'] = 'Geen geldige password ingevuld (minimaal 6 tekens)';
// 	}
//
// 	$data = [
// 		'email' => $email,
// 		'password' => $password
// 	];
//
// 	return [
// 		'data' => $data,
// 		'errors' => $errors
// 	];
//
// 	return $result;
//
// }
//
// function userNotRegistered($email) {
//
// $connection = dbConnect();
// $sql        = "SELECT * FROM `accounts` WHERE `email` = :email";
// $statement  = $connection->prepare($sql);
// $statement->execute( [ 'email' => $email ] );
//
// return ($statement->rowCount() === 0);
// }
//
// function createUser($email, $password) {
//
// 	$connection = dbConnect();
//
// 	$sql           = "INSERT INTO `accounts` (`email`, `password`) VALUES (:email, :password)";
// 	$statement     = $connection->prepare($sql);
// 	$safe_password = sha1( $password );
// 	$params        = [
// 	'email'       => $email,
// 	'password'  => $safe_password
// ];
// 	$statement->execute( $params );
// } -->
//
// //pagination
// // /**
// //  * Geeft het totaal aantal rijen terug
// //  *
// //  * @param $connection
// //  *
// //  * @return int
// //  */
// // function getTotalCountries( $connection ) {
// // 	$sql       = 'SELECT COUNT(*) as `total` FROM `products`';
// // 	$statement = $connection->query( $sql );
// //
// // 	return (int) $statement->fetchColumn();
// // }
// //
// // /**
// //  * Haalt alle landen op voor het opgegeven paginanummer
// //  *
// //  * @param \PDO $connection
// //  * @param int $page
// //  * @param int $pagesize
// //  *
// //  * @return array
// //  */
// // function getCountries( $connection, $page = 1, $pagesize = 10 ) {
// //
// // 	// De parameter $page naar een getal omzetten met (int)
// // 	$page      = (int) $page;
// //
// // 	// Beginnen met de SQL query om ALLES op te halen
// // 	$sql = 'SELECT * FROM `products`';
// //
// // 	// Alle gegevens ophalen die nodig zijn om pagina nummers te berekenen
// // 	$total     = getTotalCountries( $connection );
// // 	$num_pages = (int) round( $total / $pagesize );
// //
// //
// // 	// Als pagina nummer te groot is dan naar laatste pagina zetten
// // 	$offset = ( $page - 1) * $pagesize;
// //
// // 	// Nu plakken we de juiste LIMIT en OFFSET achter de SQl die we al hadden
// // 	$sql    .= ' LIMIT ' . $pagesize . ' OFFSET ' . $offset;
// //
// //
// // 	$statement = $connection->query( $sql );
// //
// // 	// Deze array met informatie geeft de functie terug
// // 	return [
// // 		'statement' => $statement,
// // 		'total'     => $total,
// // 		'pages'     => $num_pages,
// // 		'page'      => $page
// // 	];
// //
// // }
