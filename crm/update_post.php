<?php
// check if a form was submitted
if( !empty( $_POST ) ){
	$myhash = md5_file($_FILES['rule_file']['tmp_name']);
	$postArray["rule_id"] = $_POST["rule_id"];
	$postArray["name"] = $_POST["name"];
	$postArray["hashRule"] = $myhash;
	$postArray["taxes"] = $_POST["taxes"];
	$postArray["fare"]["name"] = $_POST["fare_name"];
	$postArray["fare"]["type"] = $_POST["fare_type"];
	$postArray["fare"]["charge"] = $_POST["fare_charge"];





	$url = "http://127.0.0.1:8000/api/rules/update";    
	$content = json_encode($postArray);

	$curl = curl_init($url);
	curl_setopt($curl, CURLOPT_HEADER, false);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($curl, CURLOPT_HTTPHEADER,
	        array("Content-type: application/json"));
	curl_setopt($curl, CURLOPT_POST, true);
	curl_setopt($curl, CURLOPT_POSTFIELDS, $content);

	$json_response = curl_exec($curl);

	$status = curl_getinfo($curl, CURLINFO_HTTP_CODE);

	


	curl_close($curl);

	$response = json_decode($json_response, true);
	if($response){
		header("Location: index.php?status=updated");
	}


}
?>