<?php

namespace Website\Controllers;

class WebsiteController {

public function home($id = null) {
  $template_engine = get_template_engine();
  echo $template_engine->render('homepage', ['products' => getProducts($id)]);
}

public function shoppingcart() {

  $template_engine = get_template_engine();
  echo $template_engine->render('shoppingcart');
}

public function uitleg() {

  $template_engine = get_template_engine();
  echo $template_engine->render('uitleg');
}

}
// $id = null): string
