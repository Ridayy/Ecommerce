<?php require APPPATH.'views/inc/header.php' ; ?>
<?php require APPPATH.'views/inc/navbar.php' ; ?>

<?php

$profile_id = $_SESSION['user_id'];
$imgSrc = "";
$result_path = "";
$msg = "";

/***********************************************************
	0 - Remove The Temp image if it exists
***********************************************************/
$root =  dirname(dirname(dirname(dirname(__FILE__))));
	$target_dir = $root."/"; 
	if (!isset($_POST['x']) && !isset($_FILES['image']['name']) ){
		//Delete users temp image
			$temppath = $target_dir.'assets/img/profile_pics/'.$profile_id.'_temp.jpeg';
			if (file_exists ($temppath)){ @unlink($temppath); }
	} 
	

if(isset($_FILES['image']['name'])){	
/***********************************************************
	1 - Upload Original Image To Server
***********************************************************/	
	//Get Name | Size | Temp Location		    
		$ImageName = $_FILES['image']['name'];
		$ImageSize = $_FILES['image']['size'];
		$ImageTempName = $_FILES['image']['tmp_name'];
	//Get File Ext   
		$ImageType = @explode('/', $_FILES['image']['type']);
		$type = $ImageType[1]; //file type	
	//Set Upload directory
		   
		$uploaddir = $target_dir.'assets/img/profile_pics/';
	//Set File name	
		$file_temp_name = $profile_id.'_original.'.md5(time()).'n'.$type; //the temp file name
		$fullpath = $uploaddir."/".$file_temp_name; // the temp file path
		$file_name = $profile_id.'_temp.jpeg'; //$profile_id.'_temp.'.$type; // for the final resized image
		$fullpath_2 = $uploaddir."/".$file_name; //for the final resized image
	//Move the file to correct location
		$move = move_uploaded_file($ImageTempName ,$fullpath) ; 
		chmod($fullpath, 0777);  
		//Check for valid uplaod
		if (!$move) { 
			die ('File didnt upload');
		} else { 
			$imgSrc= '../assets/img/profile_pics/'.$file_name; // the image to display in crop area
			$msg= "Upload Complete!";  	//message to page
			$src = $file_name;	 		//the file name to post from cropping form to the resize		
		} 

/***********************************************************
	2  - Resize The Image To Fit In Cropping Area
***********************************************************/		
		//get the uploaded image size	
			clearstatcache();				
			$original_size = getimagesize($fullpath);
			$original_width = $original_size[0];
			$original_height = $original_size[1];	
		// Specify The new size
			$main_width = 500; // set the width of the image
			$main_height = $original_height / ($original_width / $main_width);	// this sets the height in ratio									
		//create new image using correct php func			
			if($_FILES["image"]["type"] == "image/gif"){
				$src2 = imagecreatefromgif($fullpath);
			}elseif($_FILES["image"]["type"] == "image/jpeg" || $_FILES["image"]["type"] == "image/pjpeg"){
				$src2 = imagecreatefromjpeg($fullpath);
			}elseif($_FILES["image"]["type"] == "image/png"){ 
				$src2 = imagecreatefrompng($fullpath);
			}else{ 
				$msg .= "There was an error uploading the file. Please upload a .jpg, .gif or .png file. <br />";
			}
		//create the new resized image
			$main = imagecreatetruecolor($main_width,$main_height);
			imagecopyresampled($main,$src2,0, 0, 0, 0,$main_width,$main_height,$original_width,$original_height);
		//upload new version
			$main_temp = $fullpath_2;
			imagejpeg($main, $main_temp, 90);
			chmod($main_temp,0777);
		//free up memory
			imagedestroy($src2);
			imagedestroy($main);
			//imagedestroy($fullpath);
			@ unlink($fullpath); // delete the original upload					
									
}//ADD Image 	

/***********************************************************
	3- Cropping & Converting The Image To Jpg
***********************************************************/
if (isset($_POST['x'])){
	
	//the file type posted
		$type = $_POST['type'];	
	//the image src
		$src = $target_dir.'assets/img/profile_pics/'.$_POST['src'];	
		$finalname = $profile_id.md5(time());	
	
	if($type == 'jpg' || $type == 'jpeg' || $type == 'JPG' || $type == 'JPEG'){	
	
		//the target dimensions 150x150
			$targ_w = $targ_h = 150;
		//quality of the output
			$jpeg_quality = 90;
		//create a cropped copy of the image
			$img_r = imagecreatefromjpeg($src);
			$dst_r = imagecreatetruecolor( $targ_w, $targ_h );
			imagecopyresampled($dst_r,$img_r,0,0,$_POST['x'],$_POST['y'],
			$targ_w,$targ_h,$_POST['w'],$_POST['h']);
		//save the new cropped version
			imagejpeg($dst_r, $target_dir.'assets/img/profile_pics/'.$finalname."n.jpeg", 90); 	
			 		
	}else if($type == 'png' || $type == 'PNG'){
		
		//the target dimensions 150x150
			$targ_w = $targ_h = 150;
		//quality of the output
			$jpeg_quality = 90;
		//create a cropped copy of the image
			$img_r = imagecreatefrompng($src);
			$dst_r = imagecreatetruecolor( $targ_w, $targ_h );		
			imagecopyresampled($dst_r,$img_r,0,0,$_POST['x'],$_POST['y'],
			$targ_w,$targ_h,$_POST['w'],$_POST['h']);
		//save the new cropped version
			imagejpeg($dst_r, $target_dir."assets/img/profile_pics/".$finalname."n.jpeg", 90); 	
						
	}else if($type == 'gif' || $type == 'GIF'){
		
		//the target dimensions 150x150
			$targ_w = $targ_h = 150;
		//quality of the output
			$jpeg_quality = 90;
		//create a cropped copy of the image
			$img_r = imagecreatefromgif($src);
			$dst_r = imagecreatetruecolor( $targ_w, $targ_h );		
			imagecopyresampled($dst_r,$img_r,0,0,$_POST['x'],$_POST['y'],
			$targ_w,$targ_h,$_POST['w'],$_POST['h']);
		//save the new cropped version
			imagejpeg($dst_r, $target_dir."assets/img/profile_pics/".$finalname."n.jpeg", 90); 	
		
	}
		//free up memory
			imagedestroy($img_r); // free up memory
			imagedestroy($dst_r); //free up memory
			@ unlink($src); // delete the original upload					
		
		//return cropped image to page	
		$result_path = "assets/img/profile_pics/".$finalname."n.jpeg";

		//Insert image into database

		?>
		
		<script>
				$(document).ready(function(){
					$.post( '<?= base_url(); ?>' + 'users/change', { pic: '<?= $result_path; ?>' }, function(data){
						if(data == "success"){
							window.location.href='<?= base_url(); ?>' + 'users/settings';
						}
						console.log(data);
					} );
				});
		</script>
<?php
														
}// post x
?>
<section>
	<div class="container">
	<div id="Overlay"></div>
	<div class="">


		<div id="formExample" class="p-5 d-block" style="width:800px;margin:auto">
			
			<p><b> <?=$msg?> </b></p>
			
			<form action="<?= base_url().'users/upload'; ?>" method="post"  enctype="multipart/form-data">
			<h3> Upload Image </h3>
			<div class="bottom-line"></div>
			<br>
			<div class="custom-file">
				<input type="file" class="custom-file-input" id="image" name="image" >
				<label class="custom-file-label" for="image">Choose file</label>
			</div>
			<br /><br /><br>
				<input type="submit" value="Submit" class="btn"  />
			</form><br /><br />
			
		</div> <!-- Form-->  

	

    <?php
    if($imgSrc){ //if an image has been uploaded display cropping area?>
	    <script>
	    	$('#Overlay').show();
			$('#formExample').hide();
	    </script>
	    <div id="CroppingContainer" style="width:800px; max-height:600px; background-color:#FFF;margin:auto; position:relative; overflow:hidden; border:2px #666 solid; padding-bottom:0px;">  
	    
	        <div id="CroppingArea" style="width:500px; max-height:400px; position:relative; overflow:hidden; margin:40px 0px 40px 40px; border:2px #666 solid; float:left;">	
	            <img src="<?=$imgSrc?>" border="0" id="jcrop_target" style="border:0px #990000 solid; position:relative; margin:0px 0px 0px 0px; padding:0px; " />
	        </div>  

	        <div id="InfoArea" style="width:180px; height:150px; position:relative; overflow:hidden; margin:40px 0px 0px 40px; border:0px #666 solid; float:left;">	
	           <p style="margin:0px; padding:0px; color:#444; font-size:18px;">          
	                <b>Crop Profile Image</b><br /><br />
	                <span style="font-size:14px;">
	                    Crop / resize your uploaded profile image. <br />
	                   Then please click save.
						
	                </span>
	           </p>
	        </div>  

	        <br />

	        <div id="CropImageForm" style="width:100px; height:30px; float:left; margin:10px 0px 10px 40px;" >  
	            <form action="<?= base_url().'users/upload'; ?>" method="post" onsubmit="return checkCoords();">
	                <input type="hidden" id="x" name="x" />
	                <input type="hidden" id="y" name="y" />
	                <input type="hidden" id="w" name="w" />
	                <input type="hidden" id="h" name="h" />
	                <input type="hidden" value="jpeg" name="type" /> <?php // $type ?> 
	                <input type="hidden" value="<?=$src?>" name="src" />
	                <input type="submit" value="Save" class="btn" style="width:200px;margin-bottom:10px;"  />
	            </form>
	        </div>

	        <div id="CropImageForm2" style="width:100px; height:30px; float:left; margin:10px 0px 0px 40px;" >  
	            <form action="<?= base_url().'users/upload'; ?>" method="post" onsubmit="return cancelCrop();">
	                <input type="submit" value="Cancel Crop" class="btn"  style="width:200px"  />
	            </form>
	        </div>            
	            
	    </div><!-- CroppingContainer -->
		<br><br><br>
	<?php 
	} ?>
</div>
 
 
 
 
 
 <?php if($result_path) {
	 ?>
     
	 
	 <img src="../<?=$result_path?>" style="position:relative; width:200px; height:200px;margin:20px auto;display:block;border:3px solid #ccc" />
 	<strong><p class="text-dark-primary text-center">Your New Profile Pic</p></strong>
	 
 <?php } ?>
	
 
    <br /><br />

	</div>
</section>

<script>
	function saveToDatabase(){
		console.log('Saved');
	}
</script>
<?php require APPPATH.'views/inc/main-footer.php' ; ?>
<?php require APPPATH.'views/inc/footer.php' ; ?>
