<?php $this->layout('layout') ?>
<div class="form_help">
<div class="form">
<h3>Inschrijven</h3>

<p>Schrijf u in om uw boodschappen te kunnen laten bezorgen</p>

<form action="<?php echo url("register.handle")?>" method="POST">
  <div class="form-group1">
    <label for="email">Email</label><br>
    <input type="email" name="email" value="<?php echo input('email')?>" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Email...">
    <?php if ( isset( $errors['email'] ) ): ?>
    <?php echo $errors['email'] ?>
  <?php endif; ?>
</div>
  <div class="form-group2">
    <label for="password">password</label><br>
    <input type="password" name="password" id="password" class="form-control" placeholder="password...">
    <?php if ( isset( $errors['password'] ) ): ?>
    <?php echo $errors['password'] ?>
  <?php endif; ?>
  </div>
  <button type="submit" id="submit" class="btn btn-primary">Registreren</button>
</form>
</div>
</div>
<style>
.form_help {
  margin-top: 100px;
}

.form {
  border-radius: 20px;
  border: solid 4px black;
  background-color: darkred;
  width: 400px;
  color: white;
  padding: 40px;
  margin: 0 auto;
  font-size: 30px;
  text-align: center;
}

#exampleInputEmail1 {
  font-size: 20px;
  width: 200px;
  height: 40px;
}

#password {
  font-size: 20px;
  width: 200px;
  height: 40px;
}

.form-group1 {
    margin-top: 20px;
}

.form-group2 {
    margin-top: 20px;
}

#submit {
  margin-top: 30px;
  height: 50px;
  width: 120px;
  border-radius: 20px;
  background-color: darkred;
  color: white;
  border: solid white 4px;
  font-weight: bold;
}

</style>
