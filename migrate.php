
<?php 
ini_set('display_errors', 0);
error_reporting(0);
include("dbconnection.php");
$connection = new database();
$con = $connection->databaseConnect();

$sql_select_insert = "INSERT INTO 	migrated_data (sku, name)  
SELECT CONCAT(SUBSTRING_INDEX(product_code, '_', 1),'_',IF(gender = 'm', 'male', 'women')), product_label FROM original_data";

 try {
		$result = mysqli_query($con,$sql_select_insert);
		echo "Data migrate successfully";
	}
	catch(Exception $e) {
		echo 'Message: ' .$e->getMessage();
	}

?>