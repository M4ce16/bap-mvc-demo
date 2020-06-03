<?php $this->layout('layout') ?>

<h3>Inschrijven</h3>

<p>Schrijf u in om uw boodschappen te kunne laten bezorgen</p>

<form action="<?php echo url("register.handle")?>" method="POST">
  <div class="form-group">
    <label for="email">Email</label>
    <input type="email" name="email" value="" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Example 123@mail.nl">
    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
  </div>
  <div class="form-group">
    <label for="wachtwoord">Wachtwoord</label>
    <input type="password" name="wachtwoord" id="wachtwoord" class="form-control" placeholder="wachtwoord">
  </div>
  <button type="submit" class="btn btn-primary">registreren</button>
</form>
