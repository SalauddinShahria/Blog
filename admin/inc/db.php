<?php 

	$db = mysqli_connect("localhost", "root", "", "riksm-project");

	if($db){
		// echo "Welcome Riksm Project";
	}
	else{
		die("mySql connection field." . mysqli_error($db));
	}

?>