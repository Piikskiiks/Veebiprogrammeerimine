<?php
  require("Functions_main.php");
  require("../../../config_vp2019.php");
  require("functions_user.php");  
  $database = "if19_aleks_rob_1";  
  $notice = null;
  $name = null;
  $surname = null;
  $email = null;
  $gender = null;
  $birthMonth = null;
  $birthYear = null;
  $birthDay = null;
  $birthDate = null;
  $monthNamesET = ["jaanuar", "veebruar", "märts", "aprill", "mai", "juuni","juuli", "august", "september", "oktoober", "november", "detsember"];
  
  //muutujad võimalike veateadetega
  $nameError = null;
  $surnameError = null;
  $birthMonthError = null;
  $birthYearError = null;
  $birthDayError = null;
  $birthDateError = null;
  $genderError = null;
  $emailError = null;
  $passwordError = null;
  $confirmpasswordError = null;
  
  //testtsükkel
  // $i = $i + 1                    $1 += 1       $i ++
  /*for($i = 0; $i < 10; $1++){
	  echo "Tsukkel tootab" .$i ." | ";
  }*/
  
  //kui on uue kasutaja loomise nuppu vajutatud
  //kontrollime, kas sünniaeg sisestati ja kas on korrektne
  if(isset($_POST["submitUserData"])){
	  //eesnimi
	  if(isset($_POST["firstName"]) and !empty($_POST["firstName"])){
		  $name = test_input ($_POST["firstName"]);
	  } else {
		  $nameError = "Palun sisesta oma eesnimi!";
	  }//eesnime kontroll
	  //perekonnanimi
	  $surname = test_input($_POST["surName"]);
	  
	  //sugu
	  $gender = test_input ($_POST["gender"]);
	  
	  
	  
	  if(isset($_POST["birthDay"]) and !empty($_POST["birthDay"])){
	  $birthDay = intval($_POST["birthDay"]);
  } else {
	  $birthDayError = "Palun vali sünnikuupäev!";
  }
  
  if(isset($_POST["birthMonth"]) and !empty($_POST["birthMonth"])){
	  $birthMonth = intval($_POST["birthMonth"]);
  } else {
	  $birthMonthError = "Palun vali sünnikuu!";
  }
  
  if(isset($_POST["birthYear"]) and !empty($_POST["birthYear"])){
	  $birthYear = intval($_POST["birthYear"]);
  } else {
	  $birthYearError = "Palun vali sünniaasta!";
  }
  //kas on korrektne kuupaev, kui on, moodustame kuupaeva obketi
  if(!empty($birthDay) and !empty($birthMonth) and !empty($birthYear)){
	  if(checkdate($birthMonth, $birthDay, $birthYear)){
      $tempDate = new DateTime($birthYear ."-" .$birthMonth ."-" .$birthDay);
      $birthDate = $tempDate->format("Y-m-d");
      } else {
	    $birthDateError = "Kahjuks valitud kuupäeva pole olemas";
	  }//if checkdate
 
// if checkdate
  }//kas kuupaev on valiidne
  $email = test_input($_POST["email"]);
  
  //paroolikontroll
  //strlen($_POST["password"]) > 8
  //kui koik korras siis salvestame

    if(empty($surnameError) and empty($nameError) and  empty($birthMonthError) and  empty($birthYearError) and  empty($birthDayError) and empty($birthDateError) and empty ($genderError)and empty($passwordError)and empty($confirmpasswordError)){
		echo  "Kommentaar lihtsalt uks";
		$notice = signUp($name, $surname, $email, $gender, $birthDate, $_POST["password"]);
	}
  
  }//kui on nuppu vajutada
  
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
	<title>Katselise veebi uue kasutaja loomine</title>
  </head>
  <body>
    <h1>Loo endale kasutajakonto</h1>
	<p>See leht on valminud TLÜ õppetöö raames ja ei oma mingisugust, mõtestatud või muul moel väärtuslikku sisu.</p>
	<hr>
	
	<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
	  <label>Eesnimi:</label><br>
	  <input name="firstName" type="text" value="<?php echo $name; ?>"><span><?php echo $nameError; ?></span><br>    
      <label>Perekonnanimi:</label><br>
	  <input name="surName" type="text" value="<?php echo $surname; ?>"><span><?php echo $surnameError; ?></span><br>
	  <input type="radio" name="gender" value="2" <?php if($gender == "2"){		echo " checked";} ?>><label>Naine</label>
	  <input type="radio" name="gender" value="1" <?php if($gender == "1"){		echo " checked";} ?>><label>Mees</label><br>
	  <span><?php echo $genderError; ?></span><br>
	  <label>Sünnipäev </label>
	  <select name="birthDay">
	    <option value="" selected disabled>päev</option>
	  <?php
	    for($i = 1; $i <32; $i ++) {
			echo '<option value="' .$i .'"';
		if($i == $birthDay){
				echo " selected";
			}
			echo ">" .$i ."</option>" ;
		}
	  ?>
	  
	  
	   </select>

	  <label>Sünnikuu: </label>
	  <?php
	    echo '<select name="birthMonth">' ."\n";
		echo '<option value="" selected disabled>kuu</option>' ."\n";
		for ($i = 1; $i < 13; $i ++){
			echo '<option value="' .$i .'"';
			if ($i == $birthMonth){
				echo " selected ";
			}
			echo ">" .$monthNamesET[$i - 1] ."</option> \n";
		}
		echo "</select> \n";
	  ?>
	  <label>Sünniaasta: </label>
	  <?php
	    echo '<select name="birthYear">' ."\n";
		echo '<option value="" selected disabled>aasta</option>' ."\n";
		for ($i = date("Y") - 15; $i >= date("Y") - 110; $i --){
			echo '<option value="' .$i .'"';
			if ($i == $birthYear){
				echo " selected ";
			}
			echo ">" .$i ."</option> \n";
		}
		echo "</select> \n";
	  ?>
	  <br>
	  <span><?php echo $birthDateError ." " .$birthDayError ." " .$birthMonthError ." " .$birthYearError; ?></span>
	  
	    
	  <br>
	  
	  <label>E-mail (kasutajatunnus):</label><br>
	  <input type="email" name="email" value="<?php echo $email; ?>"><span><?php echo $emailError; ?></span><br>
	  <label>Salasõna (min 8 tähemärki):</label><br>
	  <input name="password" type="password"><span><?php echo $passwordError; ?></span><br>
	  <label>Korrake salasõna:</label><br>
	  <input name="confirmpassword" type="password"><span><?php echo $confirmpasswordError; ?></span><br>
	  <input name="submitUserData" type="submit" value="Loo kasutaja"><span><?php echo $notice; ?></span>
	</form>
	<hr>
		
  </body>
</html>