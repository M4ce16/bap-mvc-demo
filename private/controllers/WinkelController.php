<?php

namespace Website\Controllers;

class WinkelController {

  public function winkel() {

    $template_engine = get_template_engine();
    echo $template_engine->render('winkel_home');
  }
}
