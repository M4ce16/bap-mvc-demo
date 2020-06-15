<!-- <ul>
  <li>
    <a href="<?php echo url( 'home' ) ?>"<?php if (current_route_is('home')): ?> class="active"<?php endif ?>>Home</a>
  </li>
  <li>
    <a href="<?php echo url( 'register.form' ) ?>"<?php if (current_route_is('register.form')): ?> class="active"<?php endif ?>>Registreren</a>
  </li>
</ul> -->
<!-- <div class="nav">
  <a href="<?php echo url('home')?>"><h1 id="logo">logo</a>
  <a href="index.html" id="home">Producten</a>
  <a href="bestellen.html" id="home">Recepten</a>
  <a href="login.html" id="home">Hulpservice</a>
  <input id="zoeken" type="text" placeholder="Zoeken..">
  <a href="winkelwagen.html">Winkelwagen</a>
</div> -->
<div class="topnav" id="myTopnav">
  <a href="<?php echo url( 'home' ) ?>"<?php if (current_route_is('home')): ?> class="active"<?php endif ?>>Home</a>
  <a href="<?php echo url( 'register.form' ) ?>"<?php if (current_route_is('register.form')): ?> class="active"<?php endif ?>>Registreren</a>
  <a href="<?php echo url( 'login.form' ) ?>"<?php if (current_route_is('login.form')): ?> class="active"<?php endif ?>>inloggen</a>
  <a href="<?php echo url( 'uitleg' ) ?>"<?php if (current_route_is('uitleg')): ?> class="active"<?php endif ?>>uitleg</a>
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
