<?php
	if(!empty( $_POST ) ){
		$myhash = md5_file($_FILES['rule_file']['tmp_name']);
		$postArray["id"] = $_POST["rule"];
		$postArray["hashRule"] = $myhash;



		$url = "http://127.0.0.1:8000/api/rules/check";    
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
			header("location: index.php?status=confirmed");
		}else{
			header("location: update.php?id=".$postArray["id"]);
		}
	}

?>