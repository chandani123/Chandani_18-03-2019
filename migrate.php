
<?php 
ini_set('display_errors', 0);
error_reporting(0);
include("dbconnection.php");
$connection = new database();
$con = $connection->databaseConnect();

$sql_select_insert = "INSERT INTO 	migrated_data (sku, name)  
SELECT SUBSTRING_INDEX(product_code, '_', 1), product_label FROM original_data";
$result = mysqli_query($con,$sql_select_insert);
 try {
		$result = mysqli_query($con,$sqlInsert);
		echo "data migrate successfully";
	}
	catch(Exception $e) {
		echo 'Message: ' .$e->getMessage();
	}

?>