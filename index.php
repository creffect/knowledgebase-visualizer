<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

// Konfig laden
require_once('config.php');

// Funktionen einbinden
require_once('functions.php');

// Skript initialisieren
require_once('init.php');


?><!DOCTYPE html>
<html xmlns:foaf="http://xmlns.com/foaf/0.1/" xmlns:dc="http://purl.org/dc/elements/1.1/">
<head>
<meta charset='utf-8'> 
<link href='css/bootstrap.min.css' rel='stylesheet' type='text/css' />
<link href='css/style.css' rel='stylesheet' type='text/css' />
	
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js" type="text/javascript"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.9.2/jquery-ui.min.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript" src="js/d3/d3.js"></script>
<script type="text/javascript" src="js/d3/src/layout/index.js"></script>
<script type="text/javascript" src="js/d3/src/geom/index.js"></script>

<title>Wissensbasis-Visualisierer - Beta</title>
</head>
<body>
<div class="container-fluid">
 <div class="row header">
  <div class="col-xs-12 col-sm-6 col-md-5 col-lg-4"><h1 ><a href="?"><span class="glyphicon glyphicon-glyphicon glyphicon-fullscreen"></span> Wissensbasis-Visualisierer</h1></a></div>
  <div class="col-xs-12 col-sm-6 options">
   <a href="javascript:void(0);" id="properties"><span class="glyphicon glyphicon-transfer"></span> Link-URIs</a>
   <a href="<?php echo getPermalink(); ?>" id="properties"><span class="glyphicon glyphicon-refresh"></span> Neu laden</a>
   <a href="<?php echo getPermalink(); ?>" target="_blank"><span class="glyphicon glyphicon-link"></span> Permalink</a>
   <a href="hilfe.php" target="_blank"><span class="glyphicon glyphicon glyphicon-question-sign"></span> Hilfe</a>
   
   </div>
 </div>
</div>
<?php
// Wurde Formular abgesendet? JSON generieren
if ($dataSent) {
	ob_start();
	require('json.php');
	$JSON = ob_get_contents();
	ob_end_clean();
	?>
	<div class="container-fluid"><div id='chart'></div></div> 
	<script type="text/javascript">
	jsonGraph = <?php echo $JSON; ?>;
	</script>
	<script type="text/javascript" src='js/main.js'></script>
	<?php
} else {
	// "Getting started" 
	?><div class="container-fluid" >
		<div id="intro">
		<h1>Willkommen!</h1>
		
		Der Wissensbasis-Visualiserer ermöglicht die graphische Visualisierung beliebiger SPARQL-Anfragen an die Wissensbasis.<br /><br />
		
		Beispielabfragen und eine kurze Anleitung finden Sie in der <a href="hilfe.php" target="_blank">Hilfe</a>.<br /><br />
		
		Viel Spaß beim Visualisieren!
		</div>
	  </div>
	<?php
}

?>
<div id='sparql-input' class="container-fluid">
<h2>SPARQL-Abfragen</h2>

<form method="post" action="?">
<h3>Node-Query<h3>
<textarea name="nodeQuery"><?php echo $nodeQuery; ?></textarea>
 <br /> <br />
<h3>Link-Query</h3>
<textarea name="linkQuery"><?php echo $linkQuery; ?></textarea>
<br /><br />
<input type="submit" value="Anzeigen >" class="btn btn-primary"/>
</form>

<br /><br />
<?php 
// Ggf. die Ergebnisse hier ausgeben
if ($dataSent) {
	?><h2>Text-Ausgabe Node-Query</h2><?php 
	echo sparqlQueryTable($nodeQuery);
	
	if ($linkQuery) {
	?><h2>Text-Ausgabe Link-Query</h2><?php 
	//echo sparqlQueryTable($linkQuery);  
	}	
}
?>
<br /><br />
</div>

</body>
</html>


