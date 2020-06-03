<?php

namespace Website\Controllers;

class WebsiteController {

  public function home() {

    $template_engine = get_template_engine();
    echo $template_engine->render('homepage');
  }
}
