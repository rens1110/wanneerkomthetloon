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
						Het vorige loon was uitbetaald op:
						<h3><?php echo gmdate("d F Y", $previousdate+86400); ?></h3>
					</div>
					<div class="col-md-6">
						Het volgende loon wordt uitbetaald op:
						<h3><?php echo gmdate("d F Y", $nextdate+86400); ?></h3>
					</div
				</div>
			</div>
			<br />
			<div class="row">
				<div class="col-md-8 col-md-offset-2 text-center">
					<div>
						<h4>Je hebt nog 
						<?php 
							echo ceil(($nextdate+7200-time())/86400);
							if(ceil(($nextdate+7200-time())/86400)<2)
								{
									echo ' dag';
								}
								else
								{
									echo ' dagen';
								};
						?> 
						te gaan.</h4>
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
			<div class="row-fluid">
				<div class="col-md-8 col-md-offset-2 text-center">
					<h3> Betalingsgeschiedenis </h3>
				</div
				<div class="col-md-8 col-md-offset-2 text-center">	
					<img src="barplot.php" class="img-responsive center-block">
				</div>
				<div class="col-md-8 col-md-offset-2 text-center">	
					<br />
					<?php 
						$payments = mysqli_query($conn,"SELECT * FROM data WHERE payed = 1");
						$plotdatax = array();
						$plotdatay = array();
						foreach($payments as $payment)
						{
							echo '<br />';
							$delay = ceil((strtotime($payment['payoutdate'])-strtotime($payment['date']))/(3600*24));
							echo $payment['date'].' uitbetaald op '.$payment['payoutdate'].' ('.$delay.' dagen te laat)';
							$plotdatax[] = $payment['date'];
							$plotdatay[] = $delay;
						};
						
						echo '<br />';
						
					
						//include_once 'barplot.php';

					?>
					
					
				</div>
			</div>
		</div>
		<div style="padding:100px">   </div>
		<div class="navbar">
            <div class="container-fluid">
                <a href="/"><p class="text-muted">&copy; Rens Werink</p></a>
            </div>
        </div>
	</body>
</html>