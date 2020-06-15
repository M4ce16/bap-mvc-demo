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

function createUser($email, $password) {

	$connection = dbConnect();

	$sql           = "INSERT INTO `accounts` (`email`, `password`) VALUES (:email, :password)";
	$statement     = $connection->prepare($sql);
	$safe_password = password_hash( $password, PASSWORD_DEFAULT);
	$params        = [
	'email'       => $email,
	'password'  => $safe_password
];
	$statement->execute( $params );
}

//pagination
/**
 * Geeft het totaal aantal rijen terug
 *
 * @param $connection
 *
 * @return int
 */
function getTotalCountries( $connection ) {
	$sql       = 'SELECT COUNT(*) as `total` FROM `country`'; //TODO: Hier de juiste query zetten om het totaal aantal countries te tellen
	$statement = $connection->query( $sql );

	return (int) $statement->fetchColumn();
}

/**
 * Haalt alle landen op voor het opgegeven paginanummer
 *
 * @param \PDO $connection The database connection
 * @param int $page Pagenumber
 * @param int $pagesize Number of results per page
 *
 * @return array
 */
function getCountries( $connection, $page = 1, $pagesize = 5 ) {

	// De parameter $page naar een getal omzetten met (int)
	$page      = (int) $page;

	// Beginnen met de SQL query om ALLES op te halen
	$sql = 'SELECT * FROM `country`';

	// Alle gegevens ophalen die nodig zijn om pagina nummers te berekenen
	$total     = getTotalCountries( $connection );//TODO: Het totaal aantal landen ophalen (check de functie in dit bestand!)
	$num_pages = (int) round( $total / $pagesize );//TODO: welke berekening moet hier komen? Gebruik de variabelen


	// Als pagina nummer te groot is dan naar laatste pagina zetten
	$offset = ( $page - 1) * $pagesize;//TODO: Hoe bereken je waar je moet beginnen (welke variabelen kun je hiervoor gebruiken?)

	// Nu plakken we de juiste LIMIT en OFFSET achter de SQl die we al hadden
	$sql    .= ' LIMIT ' . $pagesize . ' OFFSET ' . $offset;


	$statement = $connection->query( $sql );

	// Deze array met informatie geeft de functie terug
	return [
		'statement' => $statement,
		'total'     => $total,
		'pages'     => $num_pages,
		'page'      => $page
	];

}
