<?php 

use Aws\S3\Exception\S3Exception;

require 'app/start.php';




if(isset($_FILES['file']))
{
	$file = $_FILES['file'];
	
	//file details
	$name     = $file['name'];
	$tmp_name = $file['tmp_name'];
	
	$extension  = explode('.',$name);
	$extension  = strtolower(end($extension));
	
	//tem details 
	$key = md5(uniqid());
	$tem_file_name = "{$key}.{$extension}";
	$tem_file_path = "files/{$tem_file_name}";
	
	//move the file 
	move_uploaded_file($tmp_name,$tem_file_path);
    
	 try{
		 
		 $php->putObject([
		 'Bucket' => $config['php']['bucket'],
		 'Key' => "uploads/{$name}",
		 'Body' => fopen($tem_file_path,'rb'),
		 'ACL'  => 'public-read'
		 ]);
		 
		 unlink($tem_file_path);
	 } catch(S3Exception $e){
		 
		 die("Error uploading");
		 }
}
?>

<form action="upload.php" method="post" enctype="multipart/form-data">
<input type="file" name="file" />
<input type="submit" value="upload" />
</form>