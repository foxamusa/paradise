<?php
global $wpdb;$current_user;
// if(is_user_logged_in())
// {
// 	wp_redirect(get_site_url(),301);
// 	exit;
// }
$getPhotosFilePath = RP_FILE_PATH_GIRLS_DIR.'/users/girlsphotos';
$getVideosFilePath = RP_FILE_PATH_GIRLS_DIR.'/users/girlsvideos';
if (!file_exists($getPhotosFilePath)) 
{
    mkdir($getPhotosFilePath, 0777, true);
}
if (!file_exists($getVideosFilePath)) 
{
    mkdir($getVideosFilePath, 0777, true);
}

if(isset($_POST['girlsregsubmit']))
{
	$error = '';
	$isSetFirstName = $_POST['girlsReg']['first_name'];
	$isSetLastName = $_POST['girlsReg']['last_name'];
	$isSetPhone = $_POST['girlsReg']['phone'];
	$isSetAge = $_POST['girlsReg']['age'];
	$isSetCity = $_POST['girlsReg']['city'];
	$isSetCountry = $_POST['girlsReg']['billing_country'];
	$isSetUserLogin = $_POST['girlsReg']['user_login'];
	$isSetUserEmail = $_POST['girlsReg']['user_email'];
	$isSetPassword = $_POST['girlsReg']['pass1'];
	$isSetConfirmPassword = $_POST['girlsReg']['pass2'];
	$girlsphotosList = $_POST['fileuploader-list-girlsphotos'];
	$girlsvideosList = $_POST['fileuploader-list-girlsvideos'];
	
	if( empty( $isSetFirstName ) )
		$error .= '<p class="is_error">Please enter your first name</p>';
	
	if( empty( $isSetLastName ) )
		$error .= '<p class="is_error">Please enter your last name</p>';
	
	if( empty( $isSetPhone ) )
		$error .= '<p class="is_error">Please enter your phone number</p>';
	
	if( empty( $isSetAge ) )
		$error .= '<p class="is_error">Please enter your age</p>';
	
	if( empty( $isSetCity ) )
		$error .= '<p class="is_error">Please enter your city</p>';
	
	if( empty( $isSetCountry ) )
		$error .= '<p class="is_error">Please select your country</p>';
	
	if( empty( $isSetUserLogin ) )
		$error .= '<p class="is_error">Please enter user name</p>';
	elseif(username_exists( $isSetUserLogin ) || email_exists( $isSetUserLogin ) )
	{
		$error .= '<p class="is_error">This user name already exists, please pick another</p>';
	}
	
	if( empty( $isSetUserEmail ) )
		$error .= '<p class="is_error">Please enter your email address</p>';
	elseif( !filter_var($isSetUserEmail, FILTER_VALIDATE_EMAIL) )
		$error .= '<p class="is_error">Please enter valid email address</p>';
	elseif(email_exists( $isSetUserEmail ))
	{
		$error .= '<p class="is_error">This email address already exists, please pick another</p>';
	}
	
	if( empty( $isSetPassword ) )
		$error .= '<p class="is_error">Please enter your password</p>';
		
	if( empty( $isSetConfirmPassword ) )
		$error .= '<p class="is_error">Please enter your confirm password</p>';
	
	if( $isSetPassword != $isSetConfirmPassword)
		$error .= '<p class="is_error">Password and Confirm password must be equal</p>';
	
	if(empty($girlsphotosList))
		$error .= '<p class="is_error">Please select photos</p>';
	
	if(empty($girlsvideosList))
		$error .= '<p class="is_error">Please select videos</p>';
	
	include(RP_FILE_PATH.'/photouploader/class.fileuploader.php');
	$FilePhotosUploader = new FileUploader('girlsphotos', array(
	'uploadDir' => RP_FILE_PATH_GIRLS_DIR.'/users/girlsphotos/',
	'title' => 'name',
	));
	$FileVideosUploader = new FileUploader('girlsvideos', array(
	'uploadDir' => RP_FILE_PATH_GIRLS_DIR.'/users/girlsvideos/',
	'title' => 'name',
	));
	
	if(isset($_FILES['girlsphotos']['name']) && !empty($_FILES['girlsphotos']['name'])) 
	{
		$listInputPhotos = str_replace('\\','',$girlsphotosList);
		$fileListInputPhotos = json_decode($listInputPhotos, true);
		if($fileListInputPhotos)
		{
			$countFileListArrayPhotos = count($fileListInputPhotos);
			if($countFileListArrayPhotos <5)
			{
				$error .= '<p class="is_error">A minimum of 5 photos are required to submit</p>';
			}
			else
			{
				$dataPhotos = $FilePhotosUploader->upload();
				if($dataPhotos['isSuccess'] && count($dataPhotos['files']) > 0) 
				{
					$uploadedFilesPhotos = $dataPhotos['files'];
				}
				else
				{
					$error .= '<p class="is_error">Error: Something went wrong while uploading photos</p>';
				}
			}
		}
		else
		{
			$error .= '<p class="is_error">Error: Something went wrong while uploading photos</p>';
		}
	}
	else
	{
		$error .= '<p class="is_error">Error: Something went wrong while uploading photos</p>';
	}
	
	if(isset($_FILES['girlsvideos']['name']) && !empty($_FILES['girlsvideos']['name'])) 
	{
		$listInputVideos = str_replace('\\','',$girlsvideosList);
		$fileListInputVideos = json_decode($listInputVideos, true);
		if($fileListInputVideos)
		{
			$countFileListArrayVideos = count($fileListInputVideos);
			if($countFileListArrayVideos <5)
			{
				$error .= '<p class="is_error">A minimum of 5 videos are required to submit</p>';
			}
			else
			{
				$dataVideos = $FileVideosUploader->upload();
				if($dataVideos['isSuccess'] && count($dataVideos['files']) > 0) 
				{
					$uploadedFilesVideos = $dataVideos['files'];
				}
				else
				{
					$error .= '<p class="is_error">Error: Something went wrong while uploading videos</p>';
				}
			}
		}
		else
		{
			$error .= '<p class="is_error">Error: Something went wrong while uploading videos</p>';
		}
	}
	else
	{
		$error .= '<p class="is_error">Error: Something went wrong while uploading videos</p>';
	}

	if( empty( $error ) )
	{
		$finalFileListArrayPhotos = $FilePhotosUploader->getFileList();
		$finalFileListArrayVideos = $FileVideosUploader->getFileList();
		$finalListPhotosNameArrayPhotos = array();
		$finalListPhotosNameArrayVideos = array();
		if($finalFileListArrayPhotos)
		{	
			$countFinalFileListArrayPhotos = count($finalFileListArrayPhotos);
			$countFinalFileListArrayVideos = count($finalFileListArrayVideos);
			if($countFinalFileListArrayPhotos <5 || $countFinalFileListArrayVideos <5 )
			{
				echo '<p class="is_error">Error: Upload photos are lesser than 5 </p>';
				foreach($finalFileListArrayPhotos as $finalFileListArrayPhotosValuePhotos)
				{
					unlink(RP_FILE_PATH_GIRLS_DIR.'/users/girlsphotos/' . $finalFileListArrayPhotosValuePhotos['name']);
				}
				echo '<p class="is_error">Error: Upload videos are lesser than 5 </p>';
				foreach($finalFileListArrayVideos as $finalFileListArrayPhotosValueVideos)
				{
					unlink(RP_FILE_PATH_GIRLS_DIR.'/users/girlsvideos/' . $finalFileListArrayPhotosValueVideos['name']);
				}
			}
			else
			{
				foreach($finalFileListArrayPhotos as $finalFileListArrayPhotosValuePhotos)
				{
					$finalListPhotosNameArrayPhotos[] = $finalFileListArrayPhotosValuePhotos['name'];
				}
				$jsonEncodeFinalListPhotosNamePhotos = json_encode($finalListPhotosNameArrayPhotos);
				
				foreach($finalFileListArrayVideos as $finalFileListArrayPhotosValueVideos)
				{
					$finalListPhotosNameArrayVideos[] = $finalFileListArrayPhotosValueVideos['name'];
				}
				$jsonEncodeFinalListPhotosNameVideos = json_encode($finalListPhotosNameArrayVideos);
			
				$addedUserID = wp_create_user( $isSetUserLogin,$isSetPassword,$isSetUserEmail );
				if( is_wp_error($addedUserID) )
				{	 
					$msg = ''; 
					foreach( $addedUserID->errors as $key=>$val )
					{
						foreach( $val as $k=>$v )
						{
							$msg = '<p class="is_error">'.$v.'</p>';
						}
					}
					echo $msg;
					foreach($finalFileListArrayPhotos as $finalFileListArrayPhotosValuePhotos)
					{
						unlink(RP_FILE_PATH_GIRLS_DIR.'/users/girlsphotos/' . $finalFileListArrayPhotosValuePhotos['name']);
					}
					foreach($finalFileListArrayVideos as $finalFileListArrayPhotosValueVideos)
					{
						unlink(RP_FILE_PATH_GIRLS_DIR.'/users/girlsvideos/' . $finalFileListArrayPhotosValueVideos['name']);
					}
				}
				else
				{		
					$setUserRole = new WP_User( $addedUserID );
					$setUserRole->set_role( 'girls' );
					$isSetDisplayName = $isSetFirstName.' '.$isSetLastName;
					update_user_meta( $addedUserID, 'first_name', $isSetFirstName );
					update_user_meta( $addedUserID, 'pmpro_bfirstname', $isSetFirstName );
					update_user_meta( $addedUserID, 'billing_first_name', $isSetFirstName );
					update_user_meta( $addedUserID, 'pmpro_bfirstname', $isSetFirstName );
					
					update_user_meta( $addedUserID, 'last_name', $isSetLastName );
					update_user_meta( $addedUserID, 'billing_last_name', $isSetLastName );
					update_user_meta( $addedUserID, 'pmpro_blastname', $isSetLastName );
					
					update_user_meta( $addedUserID, 'phone', $isSetPhone );
					update_user_meta( $addedUserID, 'billing_phone', $isSetPhone );
					update_user_meta( $addedUserID, 'pmpro_bphone', $isSetPhone );
					
					update_user_meta( $addedUserID, 'age', $isSetAge );
					
					update_user_meta( $addedUserID, 'billing_city', $isSetCity );
					update_user_meta( $addedUserID, 'pmpro_bcity', $isSetCity );
					
					update_user_meta( $addedUserID, 'billing_country', $isSetCountry );
					update_user_meta( $addedUserID, 'pmpro_bcountry', $isSetCountry );
					
					update_user_meta($addedUserID,'user_password',$isSetPassword);
					update_user_meta($addedUserID,'girls_photos',$jsonEncodeFinalListPhotosNamePhotos);
					update_user_meta($addedUserID,'girls_videos',$jsonEncodeFinalListPhotosNameVideos);
					wp_update_user( array( 'ID' => $addedUserID, 'display_name' => $isSetDisplayName ) );
					prepareGirlsRegEmails($addedUserID,$isSetUserEmail,$isSetDisplayName);
					wp_redirect( get_site_url().'/login?registration=complete', 301 );
					exit();
				}
			}
		}
		else
		{
			echo '<p class="is_error">Error: Photos upload error </p>';
		}
	}
	else
	{
		echo $error;
		$finalFileListArrayPhotos = $FilePhotosUploader->getFileList();
		$finalListPhotosNameArrayPhotos = array();
		if($finalFileListArrayPhotos)
		{	
			foreach($finalFileListArrayPhotos as $finalFileListArrayPhotosValuePhotos)
			{
				unlink(RP_FILE_PATH_GIRLS_DIR.'/users/girlsphotos/' . $finalFileListArrayPhotosValuePhotos['name']);
			}
		}
		$finalFileListArrayVideos = $FileVideosUploader->getFileList();
		$finalListPhotosNameArrayVideos = array();
		if($finalFileListArrayVideos)
		{	
			foreach($finalFileListArrayVideos as $finalFileListArrayPhotosValueVideos)
			{
				unlink(RP_FILE_PATH_GIRLS_DIR.'/users/girlsvideos/' . $finalFileListArrayPhotosValueVideos['name']);
			}
		}
	}
}
?>
<style>
.tml{max-width:100%;}
.tml .maxwidththml{max-width:320px;}
</style>
<div class="tml tml-register" id="theme-my-login">

	<div class="loaderdiv"></div>
		<div class="modal fade in custommodal uploadgirlphotoserror" id="" role="dialog" data-backdrop="static" data-keyboard="false">
			<div class="modal-dialog" data-toggle="modal">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title" id="myModalLabel">Upload Photos</h4>
					</div>
					<div class="modal-body">
						<p>A minimum of 5 photos are required to submit</p>
					</div>	
				</div>
			</div>
		</div>
		<div class="modal fade in custommodal uploadgirlvideoserror" id="" role="dialog" data-backdrop="static" data-keyboard="false">
			<div class="modal-dialog" data-toggle="modal">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title" id="myModalLabel">Upload Videos</h4>
					</div>
					<div class="modal-body">
						<p>A minimum of 5 videos are required to submit</p>
					</div>	
				</div>
			</div>
		</div>
		<div class="modal fade in custommodal uploadphotosremovealterbox" id="" role="dialog">
			<div class="modal-dialog" data-toggle="modal">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title" id="myModalLabel">Remove Photo</h4>
					</div>
					<div class="modal-body">
						<p>Are you sure you want to remove this file?</p>
					</div>
					<div class="modal-footer button-section">
						<button type="button" data-dismiss="modal" class="btn btn-sm btnred" id="girlsphotosconfirmremove">Yes</button>
						<button type="button" data-dismiss="modal" class="btn btn-sm btnred">No</button>
					</div>						
				</div>
			</div>
		</div>
		<div class="modal fade in custommodal uploadvideosremovealterbox" id="" role="dialog">
			<div class="modal-dialog" data-toggle="modal">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title" id="myModalLabel">Remove Video</h4>
					</div>
					<div class="modal-body">
						<p>Are you sure you want to remove this file?</p>
					</div>
					<div class="modal-footer button-section">
						<button type="button" data-dismiss="modal" class="btn btn-sm btnred" id="girlsvideosconfirmremove">Yes</button>
						<button type="button" data-dismiss="modal" class="btn btn-sm btnred">No</button>
					</div>						
				</div>
			</div>
		</div>

	<p class="message maxwidththml">Register For This Site</p>
	<form class="tmlregistrationformforgirls" name="registerform" id="registerformgirls" action="#" method="post" enctype="multipart/form-data">
		<p class="tml-user-login-wrap maxwidththml">
			<label for="user_login"><?php _e( 'Username', 'theme-my-login' ); ?> <span class="requiredred">*</span></label> 
			<input type="text" name="girlsReg[user_login]" id="user_login" class="input" value="" size="20" />
		</p>
	
		<p class="tml-first-name-wrap maxwidththml">
			<label for="first_name"><?php _e( 'First Name', 'theme-my-login' ); ?> <span class="requiredred">*</span></label> 
			<input type="text" name="girlsReg[first_name]" id="first_name" class="input" value="" size="20" />
		</p>
		<p class="tml-last-name-wrap maxwidththml">
			<label for="last_name"><?php _e( 'Last Name', 'theme-my-login' ); ?> <span class="requiredred">*</span></label> 
			<input type="text" name="girlsReg[last_name]" id="last_name" class="input" value="" size="20" />
		</p>
		<p class="tml-phone-wrap maxwidththml">
			<label for="phone"><?php _e( 'Phone Number', 'theme-my-login' ); ?> <span class="requiredred">*</span></label> 
			<input type="text" name="girlsReg[phone]" id="phone" class="input" value="" size="20" />
		</p>
		<p class="tml-age-wrap maxwidththml">
			<label for="age"><?php _e( 'Age', 'theme-my-login' ); ?> <span class="requiredred">*</span></label> 
			<input type="text" name="girlsReg[age]" id="age" class="input" value="" size="20" />
		</p>
		
		<p class="tml-city-wrap maxwidththml">
			<label for="city"><?php _e( 'City', 'theme-my-login' ); ?> <span class="requiredred">*</span></label> 
			<input type="text" name="girlsReg[city]" id="city" class="input" value="" size="20" />
		</p>
		<label for="girlsReg[billing_country]">Select Country <span class="requiredred">*</span></label> 
		<?php 
			global $woocommerce;    
			woocommerce_form_field( 'girlsReg[billing_country]', array( 'type' => 'country','class'      => array( 'tml-user-bcountry-wrap maxwidththml' ) ) );
		?>
		
		<p class="tml-user-email-wrap maxwidththml">
			<label for="user_email"><?php _e( 'E-mail', 'theme-my-login' ); ?> <span class="requiredred">*</span></label> 
			<input type="text" name="girlsReg[user_email]" id="user_email" class="input" value="" size="20" />
		</p>
		
		<p class="tml-user-pass1-wrap maxwidththml">
			<label for="pass1">Create your Password <span class="requiredred">*</span></label> 
			<input autocomplete="off" name="girlsReg[pass1]" id="pass1" class="input customErrorClass" size="20" value="" type="password" aria-describedby="pass1-error">
		</p>
	
		<p class="tml-user-pass2-wrap maxwidththml">
			<label for="pass2">Confirm your Password <span class="requiredred">*</span></label> 
			<input autocomplete="off" name="girlsReg[pass2]" id="pass2" class="input customErrorClass" size="20" value="" type="password" aria-describedby="pass2-error">
		</p>
		
		<p class="fullwidthpara">
			We would like to emphasize one more time that girls do not pay anything at all for this amazing vacation in paradise.
		</p>
		
		<p class="fullwidthpara">
			Girls who will win the contest will come to Paradise Club free of charge and will enjoy all amazing facilities, events and activities that Paradise Club offers (food and drinks included).
		</p>
		
		<p class="fullwidthpara">
			You will come to Paradise Club absolutely free of charge.
		</p>
		
		<p class="tml-user-photos-wrap maxwidththml">
			<label for="photos">PHOTOS (Min 5 Required) <span class="requiredred">*</span></label> 
			<input type="file" name="girlsphotos" id="girlsphotos" accept="image/x-png,image/gif,image/jpeg"/>
		</p>
		
		<p class="tml-user-videos-wrap maxwidththml">
			<label for="videos">Videos (Min 5 Required) <span class="requiredred">*</span></label> 
			<input type="file" name="girlsvideos" id="girlsvideos" accept="video/mp4,video/x-m4v,video/*"/>
		</p>
		
		<p class="tml-submit-wrap maxwidththml">
			<input type="submit" name="girlsregsubmit" id="girlsregsubmit" value="<?php esc_attr_e( 'Register', 'theme-my-login' ); ?>" />
		</p>
		<div class="customloader"></div>
	</form>
	<ul class="tml-action-links">
		<li><a href="<?php echo get_site_url().'/login';?>" rel="nofollow">Log In</a></li>
		<li><a href="<?php echo get_site_url().'/lostpassword';?>" rel="nofollow">Lost Password</a></li>
	</ul>
</div>
