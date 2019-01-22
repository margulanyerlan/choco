<html lang="en">
<head>
	<title>Update RULE</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
<!--===============================================================================================-->
</head>
<body>
	
	<?php

		if(!empty($_POST)){
			$response = file_get_contents('http://127.0.0.1:8000/api/rules/'.$_POST["id"]);
			$response = json_decode($response);
			$rule = $response->rule;
			$taxes = $response->taxes;
			$fare = $response->fares[0];
		
	?>
	
	<div class="container-contact100">
		<div class="wrap-contact100">
			<form class="contact100-form validate-form" action="calculate_post.php" method="post" enctype="multipart/form-data">
				<span class="contact100-form-title">
					Update Rule
				</span>
				<input type="hidden" name="rule_id" value="<?php echo $_POST["id"]?>">
				<div class="wrap-input100 validate-input" data-validate="Name is required">
					<span class="label-input100">Ticket Price</span>
					<input class="input100" type="number" name="ticket_fare" required="true" placeholder="Enter ticket price">
					<span class="focus-input100"></span>
				</div>
				<div class="wrap-input100 validate-input" data-validate = "Message is required">
					<span class="label-input100">Unrefundable Taxes</span>
					<table id="taxes_inputs">
						<?php
						for($i=0; $i<count($taxes); $i++){?>
							<tr><td>

								<input class="input100" required="true" type="number" name="taxes[<?php echo $taxes[$i]->name ?>][]" placeholder="<?php echo $taxes[$i]->name ?>"></td></tr>
						<?php
						}
						

						?>
					</table>
					<span class="focus-input100"></span>
				</div>
				

				


				<div class="container-contact100-form-btn">
					<div class="wrap-contact100-form-btn">
						<div class="contact100-form-bgbtn"></div>
						<button class="contact100-form-btn">
							<span>
								Submit
								<i class="fa fa-long-arrow-right m-l-7" aria-hidden="true"></i>
							</span>
						</button>
					</div>
				</div>
			</form>
		</div>
	</div>



	<div id="dropDownSelect1"></div>

<!--===============================================================================================-->
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
	<script>
		$(".selection-2").select2({
			minimumResultsForSearch: 20,
			dropdownParent: $('#dropDownSelect1')
		});
	</script>
<!--===============================================================================================-->
	<script src="vendor/daterangepicker/moment.min.js"></script>
	<script src="vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<script src="js/main.js"></script>

	<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-23581568-13"></script>
<script>


<?php
		}
	?>
</body>
</html>
