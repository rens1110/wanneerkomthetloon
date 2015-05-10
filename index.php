<!DOCTYPE html>
<html>
	<head>
		<title>Wanneer komt het loon?</title>
		<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
		<script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
		<meta charset="utf-8">
	    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	</head>
	<body>
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
			
				$data = mysqli_query($conn,"SELECT * FROM data");
				//var_dump($data);
				
				foreach ($data as $date){
					if($date['date']>date('Y-m-d')){
						$nextdate = strtotime($date['date']);
						break;
					}
					else 
					{
						$previousdate = strtotime($date['date']);
					}
				}
			?>
		<div class="container-fluid text-center">
			<div class="row">
				<div class="col-md-8 col-md-offset-2">
					<div class="jumbotron text-center">
						<h1>Wanneer komt het loon?</h1>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-8 col-md-offset-2">
					<div class="col-md-6">
						Het volgende loon wordt uitbetaald op:
						<h3><?php echo gmdate("d F Y", $nextdate+86400); ?></h3>
					</div
					<div class="col-md-6">
						Het vorige loon was uitbetaald op:
						<h3><?php echo gmdate("d F Y", $previousdate+86400); ?></h3>
					</div>
				</div>
			</div>
			<br />
			<div class="row">
				<div class="col-md-8 col-md-offset-2 text-center">
					<div>
						<h4>Je hebt nog <?php echo ceil(($nextdate+86400-time())/86400) ?> dagen te gaan.</h4>
					</div>
					<div class="col-md-8 col-md-offset-2">
						<div class="progress">
							<div class="progress-bar" role="progressbar" aria-valuenow="<?php echo time() ?>" aria-valuemin="<?php echo $previousdate+86400 ?>" aria-valuemax="<?php echo $nextdate+86400 ?>" style="width: <?php echo 100*(time()-$previousdate+86400)/($nextdate-$previousdate).'%;' ?>">
								<span class="sr-only"></span>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>