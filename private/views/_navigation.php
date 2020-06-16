<div class="topnav" id="myTopnav">
  <a href="<?php echo url( 'home' ) ?>"<?php if (current_route_is('home')): ?> class="active"<?php endif ?>>Home</a>
 <?php if(!isLoggedIn()): ?><a href="<?php echo url( 'register.form' ) ?>"<?php if (current_route_is('register.form')): ?> class="active"<?php endif ?>>Registreren</a><?php endif ?>
 <?php if(!isLoggedIn()): ?><a href="<?php echo url( 'login.form' ) ?>"<?php if (current_route_is('login.form')): ?> class="active"<?php endif ?>>inloggen</a><?php endif ?>
 <?php if(isLoggedIn()): ?><a href="<?php echo url( 'logout' ) ?>"<?php if (current_route_is('logout')): ?> class="active"<?php endif ?>>uitloggen</a><?php endif ?>
  <a href="<?php echo url( 'uitleg' ) ?>"<?php if (current_route_is('uitleg')): ?> class="active"<?php endif ?>>uitleg</a>
    <a href="<?php echo url( 'shoppingcart' ) ?>"<?php if (current_route_is('shoppingcart')): ?> class="active"<?php endif ?>>winkelwagen</a>
  </a>
</div>
<style>
.topnav {
  background-color: darkred;
  overflow: hidden;
}

.topnav a {
  float: left;
  display: block;
  color: white;
  text-align: center;
  padding: 40px 50px;
  text-decoration: none;
  font-size: 25px;
}

.topnav a:hover {
  background-color: red;
  color: white;
}

.topnav a.active {
  background-color: black;
  color: white;
}

.topnav .icon {
  display: none;
}

</style>
