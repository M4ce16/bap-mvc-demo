<?php

namespace Website\Controllers;

class RegistrationController {

  public function registrationForm() {

    $template_engine = get_template_engine();
    echo $template_engine->render('register_form');
  }
}
