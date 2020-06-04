<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="<?php echo site_url('/css/style.css')?>">
    <title></title>
  </head>
  <body>
    <!-- <header>
      <a href="<?php echo url('home')?>"><h1 id="logo">LOGO
        <a href="index.html" id="home">producten</a>
        <a href="bestellen.html" id="home">recepten</a>
        <a href="login.html" id="home">hulpservice</a>
        <input id="zoeken" type="text" placeholder="Zoeken..">
        <a href="winkelwagen.html"><img id="wagen" src="<?php echo site_url('/images/winkelwagen.png')?>" alt="winkelwagen"></a>
      </h1></a>
    </header> -->
    <header>
    <nav>
      <?php if ($this->section( 'navigation' ) ): ?>
        <?php echo $this->section('navigation') ?>
      <?php else: ?>
        <?php echo $this->fetch( '_navigation' ) ?>
      <?php endif ?>
    </nav>
  </header>
    <section>
      <?php echo $this->section('content')  ?>
    </section>
    <!-- <div class="images">
      <div class="grid1"><img id="outline" src="<?php echo site_url('/images/korn-brood.jpg')?>" alt="korn-brood"></div>
      <div class="grid2"><img id="outline" src="<?php echo site_url('/images/bruin-brood.jpg')?>" alt="bruin-brood"></div>
      <div class="grid3"><img id="outline" src="<?php echo site_url('/images/wit-brood.jpg')?>" alt="wit-brood"></div>
      <div class="grid4"><img id="outline" src="<?php echo site_url('/images/fruit.jpg')?>" alt="fruit"></div>
    </div> -->
  </body>
</html>
