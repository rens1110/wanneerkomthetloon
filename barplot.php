<?php
$servername = "localhost";
$username = "wanneerloon";
$password = "ap3DUhMQeeSABYTT";

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}
// echo "Connected successfully";

mysqli_select_db($conn,"wanneerloon") or die ("no database");
	
$payments = mysqli_query($conn,"SELECT * FROM data WHERE payed = 1");
$plotdatax = array();
$plotdatay = array();
foreach($payments as $payment)
{
	$delay = ceil((strtotime($payment['payoutdate'])-strtotime($payment['date']))/(3600*24));
	$plotdatax[] = $payment['date'];
	$plotdatay[] = intval($delay);
};

//var_dump($plotdatay);

require_once 'jpgraph/jpgraph.php';
require_once 'jpgraph/jpgraph_line.php';
require_once 'jpgraph/jpgraph_bar.php';

//var_dump($plotdata);

// Width and height of the graph
$width = 600; $height = 200;

// Create a graph instance
$graph = new Graph($width,$height);

// Specify what scale we want to use,
// int = integer scale for the X-axis
// int = integer scale for the Y-axis
$graph->SetScale('intint');

// Setup a title for the graph
$graph->title->Set('Uitbetaling later dan datum');

// Setup titles and X-axis labels
$graph->xaxis->title->Set('uitbetalingsmaand');

// Setup Y-axis title
$graph->yaxis->title->Set('dagen te laat');

// Create the linear plot
$lineplot=new BarPlot($plotdatay);

// Add the plot to the graph
$graph->Add($lineplot);

// Display the graph
$graph->Stroke();


?>