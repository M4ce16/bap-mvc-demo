<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="<?php echo site_url('/css/style.css')?>">
    <title></title>
  </head>
  <body>
    <nav>
      <?php if ($this->section( 'navigation' ) ): ?>
        <?php echo $this->section('navigation') ?>
      <?php else: ?>
        <?php echo $this->fetch( '_navigation' ) ?>
      <?php endif ?>
    </nav>
    <section>
      <?php echo $this->section('content')  ?>
    </section>
    <!-- <footer>
      <p>&copy; COVIDHELP<p>
    </footer> -->
  </body>
</html>
