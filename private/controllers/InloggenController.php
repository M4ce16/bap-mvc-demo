<?php

namespace Website\Controllers;

class InloggenController {

  public function inloggenForm() {

    $template_engine = get_template_engine();
    echo $template_engine->render('inloggen_form');
  }
}
