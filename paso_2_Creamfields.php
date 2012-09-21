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

<!DOCTYPE html>
<html>
    <head>
        <title></title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link href="css/reset.css" rel="stylesheet" type="text/css" />
        <link href="css/MyFontsWebfontsKit.css" rel="stylesheet" type="text/css" />
        
        <style>
            body {
                background: url(MI_CREAMFIELDS03.jpg) no-repeat center top;
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
        <script type="text/javascript">

            var _gaq = _gaq || [];
            _gaq.push(['_setAccount', 'UA-32023083-3']);
            _gaq.push(['_trackPageview']);

            (function() {
                var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
                ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
                var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
            })();

        </script>
    </head>
    <body>
    
  <div id="formContainer">
			<form id="login" method="post" action="./">
				<a href="#" id="flipToRecover" class="flipLink">Recordar Contraseña?</a>
			</form>
			<form id="recover" method="post" action="./">
				<a href="#" id="flipToLogin" class="flipLink">Recordar Contraseña?</a>
			</form>
		</div>
    
    
    
            <?php if ($user): ?>
                <div id="start"><a href="paso_3_Creamfields.php"><img src="images/start.png" /></a></div>
            <?php else: ?>
                <div id="like">
                    Ingresa a Facebook
                    <a href="<?php echo $loginUrl; ?>">Login</a>
                </div>
            <?php endif ?>
        </div>
         <!-- JavaScript includes -->
		<script src="http://code.jquery.com/jquery-1.7.1.min.js"></script>
		<script src="js/script.js"></script>
    </body>
</html>
