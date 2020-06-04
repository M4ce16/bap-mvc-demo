<?php

namespace Website\Controllers;

class RegistrationController {

  public function registrationForm() {

    $template_engine = get_template_engine();
    echo $template_engine->render('register_form');
  }
  public function handleRegistrationForm(){

    $result = validateRegistrationData($_POST);


    if ( count( $result['errors'] ) === 0 ) {


      if ( userNotRegistered($result['data']['email'])) {

        createUser($result['data']['email'], $result['data']['wachtwoord']);

        $bedanktUrl = url('register.bedankt');
        redirect($bedanktUrl);

      } else {
        $errors['email'] = 'Dit email address is al in gebruik';
      }
    }

    $template_engine = get_template_engine();
    echo $template_engine->render( 'register_form', ['errors' => $result['errors']] );

}

  public function registrationBedankt(){
    $template_engine = get_template_engine();
    echo $template_engine->render("register_bedankt");
  }
}
