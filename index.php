<?php

require 'facebook/src/facebook.php';

// Create our Application instance (replace this with your appId and secret).
$facebook = new Facebook(array(
'appId'  => '531707813512666',
'secret' => '8007fa623a8b5d8e014a45b13de21da9',
));

// Get User ID
$user = $facebook->getUser();

// Login or logout url will be needed depending on current user state.
if ($user) {
  $logoutUrl = $facebook->getLogoutUrl();
} else {
  $loginUrl = $facebook->getLoginUrl();
}

?>

<!--[if lte IE 6]>
<script type="text/javascript" src="ie6/ie6-warning.js"></script>
<script type="text/javascript">
	window.onload=function(){
		e("js/ie6/");
	}
</script>
<![endif]-->



<!DOCTYPE html>
<html>
    <head>
        <title></title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link href="css/reset.css" rel="stylesheet" type="text/css" />
        <link href="css/MyFontsWebfontsKit.css" rel="stylesheet" type="text/css" />
        
        <style>
            body {
                background: url(MI_CREAMFIELDS01.jpg) no-repeat center top;
            }
        </style>
        <link href="css/style.css" rel="stylesheet" type="text/css" />
        <script src="js/jquery-1.7.2.min.js"></script>
        <script src="js/jquery.queryloader2.js"></script>
        <script>
            $(document).ready(function() {
                $("body").queryLoader2({ 
                    backgroundColor: '#FFF', 
                    barColor: '#000',
                    percentage: true
                });
            });
        </script>
      
    </head>
    <body>
            <?php if ($user): ?>
                <div id="start"><a href="paso_1_Creamfields.php"><img src="images/start.png" /></a></div>
            <?php else: ?>
                <div id="like">
                    Ingresa a Facebook
                    <a href="<?php echo $loginUrl; ?>">Login</a>
                </div>
            <?php endif ?>
        </div>
    </body>
</html>
