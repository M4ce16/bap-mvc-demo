<?php $this->layout('layout') ?>
<div id="demo">
<button class="uitleg" type="button" onclick="loadDoc()">Uitleg<br>klik hier</button>
</div>

<script>
function loadDoc() {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("demo").innerHTML = 
      this.responseText;
    }
  };

  xhttp.open("GET", "uitleg_text.txt", true);
  xhttp.send();
}
</script>
 <style media="screen">
   #demo {
     margin: 0 auto;
     width: 50%;
     text-align: center;
   }

   .uitleg {
     margin-top: 40px;
     color: white;
     font-size: 30px;
     border-radius: 100px;
     border: solid darkred 7px;
     padding-top: 20px;
     padding-bottom: 20px;
     padding-left: 40px;
     padding-right: 40px;
     background-color: red;
   }
 </style>
