
<?php 
ini_set('display_errors', 0);
error_reporting(0);
include("dbconnection.php");
$connection = new database();
$con = $connection->databaseConnect();

$target_dir = "media/";
$imgName = date('Ymd_his').basename($_FILES["fileToUpload"]["name"]);

$target_file = $target_dir . $imgName;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

if(isset($_REQUEST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
	
    if($check !== false) {
        
			if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) 
			{
				$product_id = $_REQUEST['product_id'];
				$sql_update = "UPDATE `migrated_data` SET `image_url`='".$imgName."' WHERE product_id = $product_id";
				
				try {
						mysqli_query($con,$sql_update);
							echo "File has been uploaded.";
					}
					catch(Exception $e) {
						echo 'Message: ' .$e->getMessage();
					}
			} 
			else 
			{
				echo "Sorry, there was an error uploading your file.";
			}
		
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}
	$sql_select_productName = "select `name`,`product_id` from migrated_data";
	try {
			$result = mysqli_query($con,$sql_select_productName);
		}
		catch(Exception $e) {
			echo 'Message: ' .$e->getMessage();
		}
	
	
?>
<!DOCTYPE html>
<html>
<body>

<form action="" method="post" enctype="multipart/form-data">
Select productname: <select name="product_id"> 
	<?php 
		while($row=mysqli_fetch_array($result)){?>
		<option value="<?=$row['product_id']?>"><?=$row['name']?></option>
	<?php } ?>
	</select>
    </br></br>
    
	Select image to upload:
    <input type="file" name="fileToUpload" id="fileToUpload" required accept="image">
	</br></br>	
    <input type="submit" value="Upload Image" name="submit">
</form>

</body>
</html>