<?php
	//print_r($_SESSION['idvluchtheen']);
	session_start();
	if(isset($_POST['doen']))
	{
		include('connect_db.php');
		//include('vluchten.php');
		//Verzamelen van values van de html form
		$voornaam = $_POST['voornaam'];
		$achternaam = $_POST['achternaam'];
		$geslacht = $_POST['geslacht'];
		$email = $_POST['email'];
		$wachtwoord = $_POST['wachtwoord'];
		$telefoonnummer = $_POST['telefoonnummer'];

		$_SESSION['emailklant'] = $email;

		//checken of de variabelen niet leeg zijn
		if (empty($voornaam) OR empty($achternaam) OR empty($email) OR empty($wachtwoord) OR empty($telefoonnummer)) 
		{
			print_r('Je moet alles invullen') AND die;
		}	
		else{ 
			$stmt = $conn->prepare("insert into klant(voornaam, achternaam, geslacht, email, wachtwoord, telefoonnummer) values(?, ?, ?, ?, ?, ?)");
			$stmt->bind_param("sssssi", $voornaam, $achternaam, $geslacht, $email, $wachtwoord, $telefoonnummer);
			$stmt->execute();
			echo "Het aanmelden is succesvol afgerond...";
			$stmt->close();
			$conn->close();

			header('Location:vliegticket.php');
		}
	}else {
		
		$heenreis  = $_POST['heenreis'];
		//echo "<br>====Registation.php=========================";
		//echo "<br> the id of the heenreis is ".$heenreis;
		$_SESSION['idvluchtheen']  = $heenreis; 

		if (isset($_POST['terugreis'])){
			$terugreis = $_POST['terugreis'];
			//echo "<br> the id of the terugreis is ".$terugreis;
			$_SESSION['idvluchtterug'] = $terugreis;
		}else{
			$_SESSION['idvluchtterug'] = '-1'; //Voor een enkele reis ticket is er geen terugvlucht id, dus zetten we hier '-1'.
		}
		//echo "<br>===========================================";
		
    	
		
		
	}


 ?>
<!DOCTYPE html>
<html>
<head>

	<title>SkyTraveller | Registratie</title>
	<link rel="stylesheet" type="text/css" href="style.css">

</head>
<body>

<div id="container">

	<div id="head">
		
		<div id="header">
			
			<a href="index.php"><div id="booking">
				<p>SkyTraveller</p>
			</div></a>
			
			<a href="account.php"><div id="account">
				<p>account</p>
			</div></a>

		</div>
		
		<div id="navigation">

			<a href=""><div id="verblijven"><p>verblijven</p></div></a>

			<a href="vluchten.php"><div id="vluchten"><p>vluchten</p></div></a>

			<a href=""><div id="autoverhuur"><p>autoverhuur</p></div></a>

		</div>

	</div>

<form action="registration.php" method="POST">

	<div id="login">

			<p>voornaam</p>
			<input type="text" id="firstName" name="voornaam" placeholder="voornaam" />
		
			<p>achternaam</p>
			<input type="text" id="lastName" name="achternaam" placeholder="achternaam" />
		
			<p>geslacht</p>

			<input type="radio" name="geslacht" id="man" value="m" checked>man</label>
			<input type="radio" name="geslacht" id="vrouw" value="v">vrouw</label>
	
			<p>email</p>
			<input type="text" id="email" name="email" placeholder="email" />
	
			<p>wachtwoord</p>
			<input type="password" id="wachtwoord" name="wachtwoord" placeholder="wachtwoord" />
			
			<p>telefoonnummer</p>
			<input type="text" id="telefoonnummer" name="telefoonnummer" placeholder="telefoonnummer" /><br><br>
			
			<input type="submit" id="doen" name="doen" value="registreren">

 	</div>

</from>


		<div id="footer">
			<p>©copyright: Lorenzo Horden, Wassim Belloum, Jesse Pranger, Soraya Oranje</p>
		</div>

</body>
</html>