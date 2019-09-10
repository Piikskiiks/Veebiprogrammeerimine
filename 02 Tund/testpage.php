<?php
  $userName = "Aleksandr Rõbakov";
  $fullTimeNow = date("d.m.Y H:i:s");
  $hourNow = date("H");
  $partOfDay = "hägune aeg";
  
  if($hourNow < 8){
  $partOfDay = "hommik";
  }
?>
<!DOCTYPE html>
<html lang="et">
<head>
  <meta charset="utf-8">
  <title>
  <?php
    echo $userName;
  ?>
  Mingi imelik pealkiri</title>

</head>
<body>
  <?php
    echo "<h1>" .$userName .", tunnistajate seminar Tallinnas</h1>";
  ?>
  <p>Reedel kell 16.00 toimub Jehoova tunnistajte seminar aadressil Narva maantee 44.See leht on loodud õppimise raames ning ei sisalda tõsist informatsiooni!</p> gitti minek https://piikskiiks@github.com/Piikskiiks/Veebiprogrammeerimine.git
  giti e mail on siis    git config user.name kiikspiiks@users.noreplay.github.com
  failide laadimine githubi *laeme koik muudatused
  git add .
  et kontrollida git status
  git commit -m "kommentaar" maarab uleslaadimiseks ja lisab kommentaari
  git push et saaks uleslaadida
  <hr>
  <?php
    echo "<p>Lehe avamise hetkel oli aeg: " .$fullTimeNow .", " . $partOfDay .".</p>";
	?>
</body>
</html>