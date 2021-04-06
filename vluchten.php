<?php //include('templates/header.php');
	 	  //include('query.php');
	 	  include('connect_db.php');
	 	  $idvluchtheen = '-1';
	 	  $idvluchtterug = '-1';
	 	  $klantid = '-1';

	 	//  if(isset($_POST['book'])){
		//	print_r('hello:vluchten.php');
		//	    header('Location: index.php');
  		//	}

    //============ store user's provided values in variables =============
	//lines 24 - 136 executed only after you fill the forms and push submit

	if(isset($_POST['submit']))
	{
	    $van = $_POST['van'];
	    $naar = $_POST['naar'];
	    $vertrek = $_POST['vertrek'];
	    $terug = $_POST['terug'];
	    $reisoptie = $_POST['reisoptie'];
	  	$prijs = $_POST['prijs'];

	    //================================== check that the user provided the correct values ===============

	    // checken of aankomst en vertrek ingevuld zijn
	    if (empty($van) OR empty($naar) ) {
	   		print_r("Je moet eerst aankomst en vertrek plaats invullen") AND die;	
	   	}

	    // for a oneway ticket, departure time should be provided
		if ($reisoptie == 'enkelereis' AND empty($vertrek)){ 
	        print_r("Je moet eerst vertrek datum invullen") AND die;
		}

	    // for a return ticket, the return time should be provided
		if ($reisoptie == 'retour' AND empty($terug)){ 
	        print_r("Je moet eerst terug datum invullen") AND die;
		}

		// for a return ticket, departure time should before the return time, never trust the users :)
		// source W3school
		if($reisoptie == 'retour'){
			$diff=date_diff(date_create($vertrek) , date_create($terug));

			if ( $diff->format("%R%a") < 0 ){ 
	        	print_r("departure time should before the return time") AND die;
			}
		}

	    //================================== search queries for heen reis ======================================
	    // We support four queries given
	    //  - departure place and arrival place 
	    //	- departure place and arrival place and data departure
	    //	- departure place and arrival place and maximal price 
	    //  - departure place and arrival place and data departure and maximal price
	    //======================================================================================================

	   	// zoeken voor vluchten met aankomst en vertrek plaats
	   	if (!empty($van) AND !empty($naar)) {
	   		$queryheen = "SELECT * FROM vluchten WHERE plaatsvertrek LIKE '$van' AND plaatsaankomst LIKE '$naar'";
	   	}

	    //search for trip given the departure, the arrival and the date 
	   	if (!empty($van) AND !empty($naar) AND !empty($vertrek)) {
	   		$queryheen = "SELECT * FROM vluchten WHERE plaatsvertrek LIKE '$van' AND plaatsaankomst LIKE '$naar' AND datum LIKE '$vertrek' ";
	   	}
	   	
	    //  zoeken voor vluchten met aankomst en vertrek plaats en prijs
	 	if (!empty($van) AND !empty($naar) AND !empty($prijs)) {
	   		$queryheen = "SELECT * FROM vluchten WHERE plaatsvertrek LIKE '$van'  AND plaatsaankomst LIKE '$naar' AND prijs < $prijs";
	   			   	}

	   	//search for trip given the departure, the arrival, the date and the max prijs
	   	if (!empty($van) AND !empty($naar) AND !empty($vertrek) AND !empty($prijs)) {
	   		$queryheen = "SELECT * FROM vluchten WHERE plaatsvertrek LIKE '$van' AND plaatsaankomst LIKE '$naar' AND datum LIKE '$vertrek' AND prijs <= '$prijs'";
	  	}
	   	
	   	//run the query
		$queryheen_run = mysqli_query($conn, $queryheen);
		//collect the result of the query
	   	$searchresultheen = mysqli_fetch_all($queryheen_run, MYSQLI_ASSOC);

	   	//================================== Hier beginnen terugreis query's ======================================
	   	// NOTE: A simple way to seach for the rerun flight is to exchange the plaatsvertrek with plaatsaankomst 
	   	//       in the quey (queryterug)
	   	// we support the same queries as the heer reis
	    //=========================================================================================================

	   	//search for trip given the departure, the arrival
	   	if ($reisoptie == 'retour' AND !empty($terug)) 
	   	{
	   	
	   		if (!empty($van) AND !empty($naar) AND empty($terug)) {
	   			$queryterug = "SELECT * FROM vluchten WHERE plaatsvertrek LIKE '$naar' AND plaatsaankomst LIKE '$van'";
	   		}
	   		if (empty($van) AND empty($naar) AND empty($terug) AND empty($prijs)) {
	   			print_r("you need to fill at least the the departure place");
	   		die;
	   		}

	   		// zoeken voor vluchten met aankomst en vertrek plaats
	   		if (!empty($van) AND !empty($naar)) {
	   			$queryterug = "SELECT * FROM vluchten WHERE plaatsvertrek LIKE '$naar' AND plaatsaankomst LIKE '$van'";
	   		}

	    	//search for trip given the departure, the arrival and the date 
	   		if (!empty($van) AND !empty($naar) AND !empty($terug)) {
	   			$queryterug = "SELECT * FROM vluchten WHERE plaatsvertrek LIKE '$naar' AND plaatsaankomst LIKE '$van' AND datum LIKE '$terug'";
	   		}
	   	
	    	//  zoeken voor vluchten met aankomst en vertrek plaats en prijs
	    	if (!empty($van) AND !empty($naar) AND !empty($prijs)) {
	   			$queryterug = "SELECT * FROM vluchten WHERE plaatsvertrek LIKE '$naar'  AND plaatsaankomst LIKE '$van' AND prijs < $prijs";
	   		}

	   		//search for trip given the departure, the arrival, the date and the max prijs
	   		if (!empty($van) AND !empty($naar) AND !empty($terug) AND !empty($prijs)) {
	   			$queryterug = "SELECT * FROM vluchten WHERE plaatsvertrek LIKE '$naar' AND plaatsaankomst LIKE '$van' AND datum LIKE '$terug' AND prijs <= '$prijs'";
	   		}

	   		//run the query
	   		$queryterug_run = mysqli_query($conn, $queryterug);
	   		//collect the result of the query
	   		$searchresultterug = mysqli_fetch_all($queryterug_run, MYSQLI_ASSOC);
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
		
		<button type="button" class="collapsiblecovid">covid-19 informatie</button>
			
			<div id="covid">
				<p>Controleer of er reisbeperkingen gelden. Mogelijk is reizen alleen toegestaan voor bepaalde doeleinden en is recreatief reizen specifiek niet toegestaan.</p>	
			</div>

		<script>
		var coll = document.getElementsByClassName("collapsiblecovid");
		var i;

		for (i = 0; i < coll.length; i++) {
		  coll[i].addEventListener("click", function() {
		    this.classList.toggle("active");
		    var covid = this.nextElementSibling;
		    if (covid.style.maxHeight){
		      covid.style.maxHeight = null;
		    } else {
		      covid.style.maxHeight = covid.scrollHeight + "px";
		    }
		  });
		}
		</script>

		<!-- filter -->
		<form action="vluchten.php" method="POST">
		<div id="filtertotaal">

		<button type="button" class="collapsible">filter</button>
			
			<div id="filter">

					<br>
					<input type="radio" id="retour" name="reisoptie" value="retour" checked>
					<label for="Retour">Retour</label><br>
					<input type="radio" id="enkelereis" name="reisoptie" value="enkelereis">
					<label for="Enkele reis">Enkele reis</label>
					<br><br><br>

					<label>Van: </label><input type="text" name="van" placeholder="vertrek plaats">           
					<label>Naar: </label><input type="text" name="naar" placeholder="aankomst plaats">
					<br><br>
					<label>Vertrek: </label><input type="date" id="vertrek" name="vertrek" placeholder="vertrekdatum">
					<label>Terug: </label><input type="date" id="terug" name="terug">
					<br><br>
					<label>Prijs: </label><input type="integer" name="prijs" placeholder="typ je maximale prijs">
					<button id="button" type="submit" name="submit" value="submit">filteren</button>
					<br><br>

			</div>

		</div>
		</form>

		<script>
		var coll = document.getElementsByClassName("collapsible");
		var i;

		for (i = 0; i < coll.length; i++) {
		  coll[i].addEventListener("click", function() {
		    this.classList.toggle("active");
		    var filter = this.nextElementSibling;
		    if (filter.style.maxHeight){
		      filter.style.maxHeight = null;
		    } else {
		      filter.style.maxHeight = filter.scrollHeight + "px";
		    }
		  });
		}
		</script>

<!--==== Display the result of the query  (heen reis) ===================================
         Note: - we use htmlspecialchars() to protect us against html and databas escape injections
               - the form instruction lines 247 - 293 is protectect by isset test in line 244
  -->

<?php if(isset($_POST['submit'])){ ?>
	
<form action="registration.php" method="POST">
	

<style>
#flight {
    background-color: #ebb167;
    width: 40%;
    margin: 50px;
    padding: 20px;
    text-align: left;
    float: left;
}

#title {
    font-size: 28px;
}

.boekbutton {
    width: 80%;
    margin-top: 30px;
    margin-bottom: 30px;
    margin-left: 10%;
    margin-right: 10%;
    font-size: 24px;
    padding-top: 10px;
    padding-bottom: 10px;
}
</style>

	<div id="results">			
			
			<?php foreach($searchresultheen as $searchresultheen){ ?>
				
				<div id="flight">
							<p id="title"><?php echo 'Heenreis van ' .htmlspecialchars($searchresultheen['plaatsvertrek']) .' naar'; ?></p>
							<p><?php echo '<b>Plaatsaankomst: </b>'.htmlspecialchars($searchresultheen['plaatsaankomst']); ?></p>
							<p><?php echo '<b>Vertrekdatum: </b> '.htmlspecialchars($searchresultheen['datum']); ?></p>
							<p><?php echo '<b>Prijs: </b>'.htmlspecialchars($searchresultheen['prijs']) .' euro'; ?></p>
							<p><?php $GLOBALS['idvluchtheen'] = htmlspecialchars($searchresultheen['id']); ?></p>
							<div><label><input type="checkbox" name="heenreis" id="heenreis" value='<?php echo $idvluchtheen; ?>' >selecteer de vlucht</label></div>
						    

				</div>

			<?php } ?>

<!--================================== Display the result of the query  (terug reis) ==================================		
     Note: we use htmlspecialchars() to protect us against html and databas escape injections
  -->
			<?php 	if ($reisoptie == 'retour' AND !empty($terug)){ 
					foreach($searchresultterug as $searchresultterug){ ?>
						<div id="flight">
								<p id="title"><?php echo 'Terugreis van ' .htmlspecialchars($searchresultheen['plaatsaankomst']) .' naar'; ?></p>
								<p><?php echo '<b>Plaatsaankomst: </b>'.htmlspecialchars($searchresultterug['plaatsaankomst']); ?></p>
								<p><?php echo '<b>Vertrekdatum: </b> '.htmlspecialchars($searchresultterug['datum']); ?></p>
								<p><?php echo '<b>Prijs: </b>'.htmlspecialchars($searchresultterug['prijs']) .' euro'; ?></p>
								<p><?php $GLOBALS['idvluchtheen'] = htmlspecialchars($searchresultheen['id']); ?></p>
								<div><label><input type="checkbox" name="heenreis" id="heenreis" value='<?php echo $idvluchtheen; ?>' >selecteer de vlucht</label></div>
							    
						</div>
			<?php 	}} ?>
	</div>

<!--================================== the Booking button  ==================================-->
		<button id="button" class="boekbutton">boeken</button>
</form>
<?php } ?>
</div>

<div id="footer">
			<p>©copyright: Lorenzo Horden, Wassim Belloum, Jesse Pranger, Soraya Oranje</p>
</div>

</div>
</body>
</html>
