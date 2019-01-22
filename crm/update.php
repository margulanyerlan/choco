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

		if($_GET['id']){
			echo '
			<div class="alert alert-warning alert-dismissible">
			  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			  The relevance of this rule is not confirmed. You have to make a change
			</div>';
			$response = file_get_contents('http://127.0.0.1:8000/api/rules/'.$_GET['id']);
			$response = json_decode($response);
			$rule = $response->rule;
			$taxes = $response->taxes;
			$fare = $response->fares[0];
			?>
	
	<div class="container-contact100">
		<div class="wrap-contact100">
			<form class="contact100-form validate-form" action="update_post.php" method="post" enctype="multipart/form-data">
				<span class="contact100-form-title">
					Update Rule
				</span>

				<div class="wrap-input100 validate-input" data-validate="Name is required">
					<span class="label-input100">Name of Rule</span>
					<input class="input100" type="text" name="name" value="<?php echo $rule->name?>"required="true" placeholder="Enter name of RULE">
					<input type="hidden" name="rule_id" value="<?php echo $_GET["id"]?>">
					<span class="focus-input100"></span>
				</div>


				<div class="wrap-input100 validate-input" data-validate="Name is required">
					<span class="label-input100">Rule File</span>
					<input class="input100" required='true' type="file" name="rule_file" placeholder="Enter name of RULE">
					<span class="focus-input100"></span>
				</div>

				<div class="wrap-input100 validate-input" data-validate = "Message is required">
					<span class="label-input100">Unrefundable Taxes</span>
					<table id="taxes_inputs">
						<tr id=row1><td><input class="input100" required="true" value="<?php echo $taxes[0]->name?>" type="text" name="taxes[]" placeholder="Enter name of Taxe"></td>
							<td><button type="button" name="add" id="add" class="btn btn-success">Add More</button></td>
						</tr>
						<?php
						for($i=1; $i<count($taxes); $i++){?>
							<tr id="row<?php echo ($i+1) ?>"><td><input class="input100" required="true" type="text" name="taxes[]" value = "<?php echo $taxes[$i]->name ?>"placeholder="Enter name of Taxe"></td><td><button type="button" name="remove" id="<?php echo ($i+1) ?>" class="btn btn-danger btn_remove">X</button></td></tr>
						<?php
						}
						

						?>
					</table>
					<span class="focus-input100"></span>
				</div>
				

				<div class="wrap-input100 input100-select">
					<span class="label-input100">Unrefundable Fare</span>
					<div>
							<input class="input100" type="text" required="true" name="fare_name" placeholder="Enter name of Fare" value="<?php echo($fare->name)?>">
					
						<input class="input100" type="number"  required="true" name="fare_charge" placeholder="Unrefundable fare" value="<?php echo($fare->charge)?>">
							<select class="selection-2" name="fare_type" >
							<?php
								if($fare->type){
									echo '<option value="0">Percent of the ticket price</option>
									<option value="1" selected="true">Tenge</option>';
								}else{
									echo '<option value="0" selected="true">Percent of the ticket price</option>
									<option value="1">Tenge</option>';
								}
							?>
							
						</select>
					</div>
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
$(document).ready(function(){
	var i=1;
	$('#add').click(function(){
		i++;
		$('#taxes_inputs').append('<tr id="row'+i+'"><td><input class="input100" required="true" type="text" name="taxes[]" placeholder="Enter name of Taxe"></td><td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></td></tr>');
	});
	
	$(document).on('click', '.btn_remove', function(){
		var button_id = $(this).attr("id"); 
		$('#row'+button_id+'').remove();
	});
	});
</script>

<?php
		}
	?>
</body>
</html>
