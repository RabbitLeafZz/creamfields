<?
    $resultado = array();
    $resultado['status'] = 0;
    
    if (isset($_POST['imagen'])) {
        require_once('facebook/src/facebook.php');

        $config = array(
            'appId' => '333806526702514',
            'secret' => '07e8161a75613781f2074ae23daa154b',
            'fileUpload' => true,
        );

        $facebook = new Facebook($config);
        $user_id = $facebook->getUser();

        $photo = $_POST['imagen']; // Path to the photo on the local filesystem
        $message = 'Photo upload via MYSTERYLAND TIMELINE COVER APP!';
        
        $photo_details = array(
            'message'=> $message
        );
        $photo_details['image'] = '@' . $photo;
        
        
        if($user_id) {

            // We have a user ID, so probably a logged in user.
            // If not, we'll get an exception, which we handle below.
            try {

                // Upload to a user's profile. The photo will be in the
                // first album in the profile. You can also upload to
                // a specific album by using /ALBUM_ID as the path 
                $ret_obj = $facebook->api('/me/photos', 'POST', array(
                                                'source' => '@' . $photo,
                                                'message' => $message,
                                                )
                                            );
                
                $resultado['status'] = 1;
                $resultado['photo_id'] = $ret_obj['id'];

            } catch(FacebookApiException $e) {
                $resultado['error_type'] = $e->getType();
                $resultado['error_message'] = $e->getMessage();
            }
        }
        
    }
    
    echo json_encode($resultado);
    
?>