<?php
@session_start();
ob_start();
require_once('../../../../wp-load.php');
global $wpdb;
$getActionFor = $_GET['actionfor'];
$data = array();
$count = 0;
if($getActionFor == 'viewregisteredgirls')
{
	$registeredGirlsArgs = array
	(
		'orderby'    => 'ID',
		'order'    => 'DESC',
		'role' => 'girls', 
		'number'=> -1,
		//'number'=>$programPerPage,
		//'offset' => $offset,
	);
	$registeredGirlsQuery = new WP_User_Query( $registeredGirlsArgs );
	if ( ! empty( $registeredGirlsQuery->results ) ) 
	{
		//pt($registeredGirlsQuery->results);
		foreach($registeredGirlsQuery->results as $registeredGirlsQueryValue)
		{
			$getUserRegisteredDate = $registeredGirlsQueryValue->data->user_registered;
			$getUserRegisteredEmail = $registeredGirlsQueryValue->data->user_email;
			$getUserDisplayName = $registeredGirlsQueryValue->data->display_name;
			$getUserID = $registeredGirlsQueryValue->ID;
			$getUserVoteCount = get_user_meta($getUserID,'admin_set_votes_count',true);
			$getGirlsPictures = get_user_meta($getUserID,'girls_photos',true);
			if($getGirlsPictures)
			{
				$girlsPhotosDecode = json_decode($getGirlsPictures);
				if($girlsPhotosDecode)
				{
					$i=0;
					$allGirlsImages = '';
					$defaultSelection = '';
					foreach($girlsPhotosDecode as $girlsPhotosDecodeValue)
					{
						$getGirlsSelectedPicture = get_user_meta($getUserID,'admin_set_girls_picture',true);
						if($getGirlsSelectedPicture == $girlsPhotosDecodeValue)
						{
							$defaultSelection = 'customimagecheckforparent';
						}
						else
						{
							$defaultSelection = '';
						}
						$girlsPhotosURL = RP_FILE_PATH_GIRLS_URL.'/users/girlsphotos/' . $girlsPhotosDecodeValue;
						$allGirlsImages .= '<li class="girlsphotositem" id="preetyCount'.$count.'"><img name="'.$girlsPhotosDecodeValue.'" id="girlsimageid'.$count.'" data-user-id="'.$getUserID.'" class="owl-lazy girlsimageclickableselect '.$defaultSelection.'" src="'.$girlsPhotosURL.'"></li>';
					}
				}
			}
		
			$action = '<a class="editenquiry editgirslpoints" data-user-id="'.$getUserID.'" ><i title="Edit" class="fa fa-pencil-square-o" aria-hidden="true"></i></a>';
			
			$data[] = array
			(
				'Date Registered'=>"$getUserRegisteredDate",
				'User Email'=>"$getUserRegisteredEmail",
				'Display Name'=>"$getUserDisplayName",
				'Pictures'=>"<ul class='img_list' data-user-id='$getUserID' id='customulid$count'>$allGirlsImages</ul>",
				'Number of Votes'=>"$getUserVoteCount",
				'Action'=>"$action",
			);
			$count++;
		}		
	}
}
$results = array(
"sEcho" => 1,
"iTotalRecords" => count($data),
"iTotalDisplayRecords" => count($data),
"aaData"=>$data
);

echo json_encode($results); ?>