<?php

namespace Website\Controllers;

class ShoppingcartController {

public function shoppingcart() {

  $template_engine = get_template_engine();
  echo $template_engine->render('shoppingcart');
}
}
