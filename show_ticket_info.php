<?php 
	include('connect_db.php');
	
	session_start();
	// check if the id's of the vluchten are set correctly
	$emailklant_local    = $_SESSION['emailklant'];
	
	//echo "==== show_ticket_info.php==============================<br>";
	//echo "<br> de klant email is ".$_SESSION['emailklant'];

	if (empty($emailklant_local)) {
		//header('Location:home.php');
	}
	else{
		//1. SQL Query: Retreive kland_id using the email address provided by the klant in the form 
		 $queryidklant = "SELECT * FROM klant WHERE email LIKE '$emailklant_local'";
		 //run the SQL query
		$queryidklant_run = mysqli_query($conn, $queryidklant);
		//collect the result of the SQL query
	   	$searchresultidklant = mysqli_fetch_all($queryidklant_run, MYSQLI_ASSOC);
	 	foreach($searchresultidklant as $searchresultidklant){ 
			$klantid_local = htmlspecialchars($searchresultidklant['id']);
			$klant_achternaam = htmlspecialchars($searchresultidklant['achternaam']);
			$klant_voornaam = htmlspecialchars($searchresultidklant['voornaam']);
			//echo "<br> de klant id is ".$klantid_local;
	  		//echo "<br>===========================================<br>";
	 	}
	 	//$_SESSION['klantid'] = $klantid_local;
	    //2. SQL Query: Retreive vluchtidheen and vluchtidterug using the klandid from database 	
	   	$queryvluchtenids = "SELECT * FROM vliegticket WHERE klant_id LIKE '$klantid_local' ";
	   	//run the SQL query
		$queryvluchtenids_run = mysqli_query($conn, $queryvluchtenids);
		//collect the result of the SQL query
	   	$resultqueryvluchtenids = mysqli_fetch_all($queryvluchtenids_run, MYSQLI_ASSOC);
		foreach($resultqueryvluchtenids as $resultqueryvluchtenids){ 
			$vluchtheen1 = htmlspecialchars($resultqueryvluchtenids['vluchtheen_id']);
			$vluchtterug2 = htmlspecialchars($resultqueryvluchtenids['vluchtterug_id']);
	 	}


	 	// =======================================================================
	 	// print infomation vlucht heen: plaatsvertrek, plaatsaankomst, datum, tijd, prijs 
	 	// =======================================================================

     	//3. SQL Query: Retreive vluchtheen information using vluchtheen_id 
     	if(!empty($vluchtheen1)){
	 		$queryvluchtheen = "SELECT * FROM vluchten WHERE id LIKE '$vluchtheen1' ";
	 	
	 		//run the SQL query
			$queryvluchtheen_run = mysqli_query($conn, $queryvluchtheen);
			//collect the result of the query
	   		$resultvluchtheen = mysqli_fetch_all($queryvluchtheen_run, MYSQLI_ASSOC);

        	
        }
        else{
        	echo "=========================================================<br>";
        	echo "Sorry u heeft nog niks geboekt";
        	echo "<br>=========================================================<br>";
        }

	 	// =======================================================================
	 	// print infomation vlucht terug: plaatsvertrek, plaatsaankomst, datum, tijd, prijs 
	 	// =======================================================================
		//4. SQL Query: Retreive vluchtterug information using vluchtterug_id 
		if(!empty($vluchtterug2)){
			if($vluchtterug2 !== '-1'){
				$queryvluchtterug = "SELECT * FROM vluchten WHERE id LIKE '$vluchtterug2' ";
				//run the SQL query
				$queryvluchtterug_run = mysqli_query($conn, $queryvluchtterug);
				//collect the result of the SQL query
	   			$resultvluchtterug= mysqli_fetch_all($queryvluchtterug_run, MYSQLI_ASSOC);

         		
	    	}
	    }
		$conn->close();

		//header('Location:home.php');

        // =======================================================================
	 	// stuur email naar Klant
	 	// Note: Ubder development 
	 	// Objectve: stuur an email to the provided Klant email containing the information about 
	 	//           the boeking 
	 	// =======================================================================
		if(isset($_POST['semail']))
	    {
			$to = $emailklant_local;
			$subject = 'confirmation';
			$from = "no-reply@sktrip.com"; 
 
			// To send HTML mail, the Content-type header must be set
			$headers  = 'MIME-Version: 1.0' . "\r\n";
			$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

			// Create email headers
			$headers .= 'From: '.$from."\r\n".
    		'Reply-To: '.$from."\r\n" .
    		'X-Mailer: PHP/' . phpversion();

			// Compose a simple HTML email message
			$message = '<html><body>';
			$message .= '<h1 style="color:#f40;">'; 
			$message .= $klant_achternaam ;
			$message .= '</h1>'; 
			$message .= '<p style="color:#080;font-size:18px;">';
			$message .= '<p style="color:#080;font-size:18px;">Heenreis p>';
			$message .= '<p style="color:#080;font-size:12px;">Vertreek:';
			//$message .= echo html…. ;  //read vertrekplaats form Database
			$message .= 'p><p style="color:#080;font-size:12px;">Aankomst: ';
			//$message .= echo html…. ;  //read aankomstplaats form Database
			$message .= 'p><p style="color:#080;font-size:12px;">Datum: ';
			//$message .= echo html….;   //read datum form Database
			$message .= ' p><p style="color:#080;font-size:12px;">Prijs: ';
			//$message .=  echo html…. ; //read prijs form Database
			$message .= 'p><p style="color:#080;font-size:12px;">  p>';

			$message .= '<p style="color:#080;font-size:18px;">Terugreis p>';
			$message .= '<p style="color:#080;font-size:12px;">Vertreek: ';
			//$message .= echo html…. ;   //read aankomstplaats form Database
			$message .= 'p><p style="color:#080;font-size:12px;">Aankomst: ';
			//$message .= echo html…. ;   //read vertrekplaats form Database
			$message .= 'p><p style="color:#080;font-size:12px;">Datum: ';
			$message .= '<p style="color:#080;font-size:12px;">Prijs: ';
			//$message .= echo html…. ;   //read prijs form Database
			$message .= 'p><p style="color:#080;font-size:12px;">  p>';

			$message .= '</body></html>';

			// Sending email
			if(mail($to, $subject, $message, $headers)){
	    		echo 'Your mail has been sent successfully.';
			} else{
	   			echo 'Unable to send email. Please try again.';
			}
		}

        // =======================================================================





	}

 ?>

 <!DOCTYPE html>
 <html>
 <head>
 	<title>SkyTraveller | Ticket informatie</title>
	<link rel="stylesheet" type="text/css" href="style.css">
 	</title>
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


		<div id="klantgegevens">

		<!--<p id="title">Vliegticket van <?php echo $_SESSION['emailklant']; ?></p> -->
		<p id="title">Vliegticket van <?php echo " ".$klant_achternaam.', '.$klant_voornaam; ?></p>
				
		<?php if(!empty($resultvluchtheen)){ ?>

			<?php foreach($resultvluchtheen as $resultvluchtheen){  ?>

								<p id="title">Heenreis</p>
								<p><?php echo '<b>Vertrekplaats: </b>' .htmlspecialchars($resultvluchtheen['plaatsvertrek' ]); ?></p>
								<p><?php echo '<b>Plaatsaankomst: </b>'.htmlspecialchars($resultvluchtheen['plaatsaankomst']); ?></p>
								<p><?php echo '<b>Datum: </b>'.htmlspecialchars($resultvluchtheen['datum']);?></p>
								<p><?php echo '<b>Tijd: </b>'.htmlspecialchars($resultvluchtheen['tijd']);?></p>
								<p><?php echo '<b>Prijs: </b>'.htmlspecialchars($resultvluchtheen['prijs']).' euro';?></p>

								<style>
									p {
										color: white;
									}

									#klantgegevens {
										background-color: #ebb167;
										padding: 30px;
										margin:30px 30px;
										
									}
								</style>

			<?php } ?>

			<?php if($vluchtterug2 !== '-1'){ ?>

					<?php foreach($resultvluchtterug as $resultvluchtterug){  ?>

								<p id="title">Terugreis</p>
								<p><?php echo '<b>Vertrekplaats: </b>' .htmlspecialchars($resultvluchtterug['plaatsvertrek' ]); ?></p>
								<p><?php echo '<b>Plaatsaankomst: </b>'.htmlspecialchars($resultvluchtterug['plaatsaankomst']); ?></p>
								<p><?php echo '<b>Datum: </b>'.htmlspecialchars($resultvluchtterug['datum']);?></p>
								<p><?php echo '<b>Tijd: </b>'.htmlspecialchars($resultvluchtterug['tijd']);?></p>
								<p><?php echo '<b>Prijs: </b>'.htmlspecialchars($resultvluchtterug['prijs']).' euro';?></p>

								<style>
									p {
										color: white;
									}

									#klantgegevens {
										background-color: #ebb167;
										padding: 30px;
										margin:30px 30px;
										
										
									}
								</style>
								
					<?php } ?>
				<?php } ?>
	<?php }else{ ?>
				<p><?php echo 'sorry u heeft geen boeking ... '; } ?></p> 		
				<!-- Javascript voor printen van de vliegticket. -->
				<!--<script>
				
				var prtContent = document.getElementById("klantgegevens");
				var WinPrint = window.open('', '', 'left=0,top=0,width=800,height=900,toolbar=0,scrollbars=0,status=0');
				WinPrint.document.write(prtContent.innerHTML);
				WinPrint.document.close();
				WinPrint.focus();
				WinPrint.print();
				WinPrint.close();	


				</script>-->

				<a href="index.php"><input style="background-color: #e8c599;" type="button" name="button" value="Terug naar home pagina"></input></a>
				<!-- Dit zorgt ervoor dat deze pagina wordt geprint. bron w3schools -->
				<input style="background-color: #e8c599;" type="button" name="print" onclick="window.print()" value="Vliegticket printen"></input>

				<form action="show_ticket_info.php" method="POST">
					<input type="submit" id="semail" name="semail" value="stuur email">
				</form>
		</div>
	</div>
	</div>

	<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>


		<div id="footer">
			<p>©copyright: Lorenzo Horden, Wassim Belloum, Jesse Pranger, Soraya Oranje</p>
		</div>
 
 </body>
 </html>