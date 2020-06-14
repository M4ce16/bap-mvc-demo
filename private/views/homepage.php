<?php $this->layout('layout') ?>
<form action="">
<select name="customers" onchange="showCustomer(this.value)">
<option value="">Select a customer:</option>
<option value="ALFKI">Alfreds Futterkiste</option>
</select>
</form>
<br>
<div id="txtHint">Customer info will be listed here...</div>

<script>
function showCustomer(str) {
  var xhttp;
  if (str == "") {
    document.getElementById("txtHint").innerHTML = "";
    return;
  }
  xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("txtHint").innerHTML = this.responseText;
    }
  };
  xhttp.open("GET", "getcustomer.php?q="+str, true);
  xhttp.send();
}
</script>



  <div class="products">
  <?php foreach($products as $key=>$value): ?>
    <div class="all">
      <div class="d-block">
          <img style="width: 300px;" src="<?php echo $value['product_foto']; ?>">
          <div class="text">
          <h1><?php echo $value['name']; ?></h1>
              <div class="price">
                  <h2 style="padding-bottom: 10px;"><?php echo $value['price']; ?></h2>
                  <a href="#" class="add">Voeg toe aan winkelwagen</a>
              </div>
          </div>
      </div>
    </div>
      <?php endforeach; ?>
  </div>
<style>
  .products {
    margin: 0 auto;
    width: 90%;
  }

.d-block {
  text-align: center;
  padding-top: 20px;
  padding-left: 20px;
  padding-right: 20px;
  border: solid gray 1px;
  border-radius: 20px;
  margin: 40px;
  width: 300px;
  float: left;
  padding-bottom: 40px;
  min-height: 493.719px;
}

.add {
  color: white;
  text-decoration: none;
  padding: 10px;
  background-color: red;
  border-radius: 40px;
  border: solid darkred 5px;
}
</style>
