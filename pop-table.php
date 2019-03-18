
<?php 
ini_set('display_errors', 0);
error_reporting(0);
include("dbconnection.php");
$connection = new database();
$con = $connection->databaseConnect();

if (isset($_REQUEST["import"])) {
    $fileName = $_FILES["file"]["tmp_name"];
 
    if ($_FILES["file"]["size"] > 0) {
        
        $file = fopen($fileName, "r");$i=0;
        
        while (($column = fgetcsv($file, 10000, ",")) !== FALSE) {
			
			// use of $i condition : skip first row because in first row is column name.
			if($i > 0)
			{
				/*$gender = "women";
				if(strtolower($column[2]) === "m")
				{
					$gender = "men";
				}*/
				$gender = $column[2];
				$sqlInsert = "INSERT into original_data (product_code,product_label,gender)
					   values ('" . $column[0] . "','" . $column[1] . "','" . $gender . "')";
					   
				 try {
                        $result = mysqli_query($con,$sqlInsert);
						$message = "true";
                    }
                    catch(Exception $e) {
                        echo 'Message: ' .$e->getMessage();
                    }
			}
			$i++; 
        }
		echo "File import successfully.";
    }
}
?>
<form  action="" method="post" name="uploadCSV" enctype="multipart/form-data">
    <div class="input-row">
        <label class="col-md-4 control-label">Choose CSV File</label> <input
            type="file" name="file" id="file" accept=".csv" >
        <button type="submit" id="submit" name="import"
            class="btn-submit">Import</button>
        <br />

    </div>
    <div id="labelError"></div>
</form>
