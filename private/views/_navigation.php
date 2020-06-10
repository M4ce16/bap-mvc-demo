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
  <a href="<?php echo url( '' ) ?>"<?php if (current_route_is('')): ?> class="active"<?php endif ?>>Winkel</a>
  <a href="<?php echo url( 'register.form' ) ?>"<?php if (current_route_is('register.form')): ?> class="active"<?php endif ?>>Registreren</a>
  <a href="<?php echo url( 'inloggen.form' ) ?>"<?php if (current_route_is('inloggen.form')): ?> class="active"<?php endif ?>>inloggen</a>
  <a href="<?php echo url( '' ) ?>"<?php if (current_route_is('')): ?> class="active"<?php endif ?>>Winkelwagen</a>
  </a>
</div>
