<?php
// Model functions
// In dit bestand zet je ALLE functions die iets met data of de database doen

function getUsers() {
	$connection = dbConnect();
	$sql        = "SELECT * FROM `users`";
	$statement  = $connection->query( $sql );

	return $statement->fetchAll();
}

function loginUser($email, $password) {
	$connection = dbConnect();
	$sql        = "SELECT * FROM `accounts` WHERE email = '$email' AND password = '$password'";
	$statement  = $connection->query( $sql );

	return $statement->fetchAll();
}

function getProducts($id = null) {
	if($id === null){
		$sql = "SELECT * FROM `products`";
	}else{
		$sql = "SELECT * FROM `products` WHERE category_id = '$id'";
	}
	$connection = dbConnect();
	$statement  = $connection->query( $sql );

	return $statement->fetchAll();
}

function getCategories() {
	$connection = dbConnect();
	$sql        = "SELECT id, name, (SELECT count(*)  FROM products d WHERE d.category_id = categories.id) AS productAmount  FROM `categories`";
	$statement  = $connection->query( $sql );

	return $statement->fetchAll();
}
