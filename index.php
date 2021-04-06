<!DOCTYPE html>
<html>
<head>
	<title>SkyTraveller | Home</title>
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
		
		<button type="button" class="collapsible">covid-19 informatie</button>
			
			<div id="covid">
				<p>Controleer of er reisbeperkingen gelden. Mogelijk is reizen alleen toegestaan voor bepaalde doeleinden en is recreatief reizen specifiek niet toegestaan.</p>	
			</div>

		<script>
		var coll = document.getElementsByClassName("collapsible");
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


		<div id="informatie">
			<p id="grotereText">Wil je graag een reis maken en heb je alleen nog vliegtickets nodig, neem dan zeker een kijkje bij skytraveller. Boek via skytraveller jouw vliegtickets met de beste deals.</p>

			<p id="grotereText">Waarom skytraveller?</p>
			<ul>
				<li>Gemakkelijk zoeken, filteren en boeken.</li>
				<li>Veel bestemmingen</li>
				<li>Al sinds 2003 expert op het gebied van vliegtickets.</li>
			</ul>

			<p id="grotereText">Meest gestelde vragen.</p>
			<dl>
				<dt>Waar vind ik informatie over het coronavirus?</dt>
				<dd>Boven aan de site staat een balkje met “covid-19”, klik daarop en daar staat de informatie.</dd>

				<dt>Wat zijn de kosten voor het omboeken van mijn vlucht?</dt>
				<dd>Vanwege de coronatijd hanteren veel airlines flexibele voorwaardes. De kosten zijn per airline anders, dus neem een kijkje op de site van de airline die je geboekt hebt.</dd>

				<dt>Zijn er corona-maatregelen voor de vliegreizen?</dt>
				<dd>Ja die zijn er. Het is verplicht om een gezondheidsverklaring van de RIVM mee te nemen. Het dragen van een mondkapje is verplicht. Je moet een covid-19 PCR-test ondergaan. De uitslag ontvang je tussen 24-48 uur.</dd>

				<dt>Welke naam vul je in bij de ticket?</dt>
				<dd>Je naam op de ticket moet altijd hetzelfde zijn als de naam die in je paspoort staat vermeld.</dd>
			</dl>
		</div>

	</div>

	<div id="footer">
			<p>©copyright: Lorenzo Horden, Wassim Belloum, Jesse Pranger, Soraya Oranje</p>
	</div>

</div>
</body>
</html>