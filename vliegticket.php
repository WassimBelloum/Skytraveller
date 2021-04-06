<?php 
	include('connect_db.php');
	
	session_start();
	// check if the id's of the vluchten are set correctly
	$idvluchtheen_local  = $_SESSION['idvluchtheen'];
	$idvluchtterug_local = $_SESSION['idvluchtterug'];
	$emailklant_local    = $_SESSION['emailklant'];
	echo "==== vliegticket.php==============================<br>";
	echo "<br> the id of heenvlucht ".$idvluchtheen_local;
	echo "<br> the id of terugvlucht ".$idvluchtterug_local;
	echo "<br> de klant id is ".$_SESSION['emailklant'];

	if (empty($idvluchtheen_local) AND empty($idvluchtterug_local)) {
		//header('Location:home.php');
	}else{
		// search for kland_id using the email address provided by the klant in the form 
		 $queryidklant = "SELECT * FROM klant WHERE email LIKE '$emailklant_local'";
		 //run the query
		$queryidklant_run = mysqli_query($conn, $queryidklant);
		//collect the result of the query
	   	$searchresultidklant = mysqli_fetch_all($queryidklant_run, MYSQLI_ASSOC);
	 	foreach($searchresultidklant as $searchresultidklant){ 
			$klantid_local = htmlspecialchars($searchresultidklant['id']);
			echo "<br> de klant id is ".$klantid_local;
	  		echo "<br>===========================================<br>";
	 	}

	 	$_SESSION['klantid'] = $klantid_local;

	 	//saving the ids: klantid_local, idvluchtheen_local, $idvluchtterug_local in the database table vleighticket
		$stmt = $conn->prepare("insert into vliegticket(klant_id, vluchtheen_id, vluchtterug_id) values(?, ?, ?)");
		$stmt->bind_param("iii", $klantid_local, $idvluchtheen_local, $idvluchtterug_local);
		$stmt->execute();
			echo "De ticket is opgeslagen...";
	 	
		$stmt->close();
		$conn->close();
        header('Location:show_ticket_info.php');
	}
	   	

 ?>