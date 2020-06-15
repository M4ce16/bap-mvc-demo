<?php

namespace Website\Controllers;

class uitlegController {

public function uitleg() {
  $template_engine = get_template_engine();
  echo $template_engine->render('uitleg');
}

}
