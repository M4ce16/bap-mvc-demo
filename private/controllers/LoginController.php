<?php

namespace Website\Controllers;

/**
 * Class LoginController
 *
 * Deze handelt de logica van het inloggen en uitloggen af
 *
 */
class LoginController {

	public function loginForm() {
		if(isset($_SESSION['user_id'])){
			header("Location: ".url('home'));
		}
		$template_engine = get_template_engine();
		echo $template_engine->render('login');
	}

	public function handleLoginForm() {
		if(isset($_SESSION['user_id'])){
			header("Location: ".url('home'));
		}
		$email = $_POST['email'];
		$password = sha1($_POST['password']);
		$result = loginUser($email, $password);
		if(count($result) > 0){
			$_SESSION['user_id'] = $result[0]['id'];
			header("Location: ".url('home'));
		}else{
			$template_engine = get_template_engine();
			echo $template_engine->render('login', ['errors'=>['Kon geen gebruiker met de gebruikte email of wachtwoord vinden.']]);
		}
	}

	public function logout() {

		session_destroy();
		header("Location: ".url('login.form'));
	}

}