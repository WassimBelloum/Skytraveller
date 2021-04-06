<?php 

	include('connect_db.php');

	if(isset($_POST['inloggen'])){

		session_start();

		$email = $_POST['email'];
		$wachtwoord = $_POST['wachtwoord'];
		$zoekoptie = $_POST['zoekoptie'];
		if(empty($email) AND empty($wachtwoord)){
	   		print_r("Je moet eerst email en wachtwoord invullen invullen") AND die;	
	   	}

        //SQL query: check if email and password retreive password from database
		$querylogin = "SELECT * FROM klant WHERE email LIKE '$email'";

		//run the SQL query
		$querylogin_run = mysqli_query($conn, $querylogin);
		//collect the result of the query
		$resultquerylogin = mysqli_fetch_all($querylogin_run, MYSQLI_ASSOC);
	
		//print_r($searchresultemail);
     	foreach($resultquerylogin as $resultquerylogin){
	 		$emailklant = htmlspecialchars($resultquerylogin['email']);
	 		$wachtwoordklant = htmlspecialchars($resultquerylogin['wachtwoord']);
	 		$klantid = htmlspecialchars($resultquerylogin['id']);
	    }


	    if (empty($emailklant)) {
	    	print_r('wrong email') AND die;
	    }

	    if ($wachtwoordklant !== $wachtwoord ) {
	    	print_r('wrong password') AND die;
	    }
	    
	    $_SESSION['emailklant'] = $emailklant;

	    echo "Je bent ingelogd...";

	    if ($zoekoptie == 'nieuwbooking') {
	    	header('Location:vluchten.php');

	    }else {

	    	header('Location:show_ticket_info.php');
	    }

	    
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>SkyTraveller | Vluchten</title>
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

	<div id="content">
	
		<div id="login">

			<form action="account.php" method="POST">

			<p>Email </p>
			<input type="text" id="email" name="email" placeholder="Email" />

			<p>Wachtwoord</p>
			<input type="password" id="wachtwoord" name="wachtwoord" placeholder="Wachtwoord" />
			<br>

			<div id="radio">
			<input type="radio" id="nieuwbooking" name="zoekoptie" value="nieuwbooking" checked/><label>Nieuwe vlucht boeken</label><br>
		  	<input type="radio" id="mijnboking" name="zoekoptie" value="mijnbooking"/><label>Mijn booking</label><br>
			</div>
			
			<input id="button" type="submit" name="inloggen" value="inloggen">

		</div>

			</form>	

	</div>

	<div id="footer">
			<p>©copyright: Lorenzo Horden, Wassim Belloum, Jesse Pranger, Soraya Oranje</p>
		</div>

</div>
</body>
</html>