<?php
if (isset($_POST['imagen'])) {
    $nombre_imagen = $_POST['imagen'];
    $texto = $_POST['texto'];
} else {
    header('Location: paso_1_Creamfields.php') ;
}
$fecha = new DateTime();


    require 'facebook/src/facebook.php';

    // Create our Application instance (replace this with your appId and secret).
    $facebook = new Facebook(array(
    'appId'  => '333806526702514',
    'secret' => '07e8161a75613781f2074ae23daa154b',
    ));

    // Get User ID
    $user = $facebook->getUser();
    
    if ($user) {
        try {
            // Proceed knowing you have a logged in user who's authenticated.
            $profile = $facebook->api('/me');
        } catch (FacebookApiException $e) {
            error_log($e);
            $user = null;
        }
    }
    
?>
<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE html>
<html>
    <head>
        <title></title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link href="css/reset.css" rel="stylesheet" type="text/css" />
        <link href="css/MyFontsWebfontsKit.css" rel="stylesheet" type="text/css" />
        
        <style>
            body {
                background: url(images/background-3.png) no-repeat center top;
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
                
                $('#cambiar-click').click(function() {
                    $('#volver').submit();
                });
                $('#seguir-click').click(function() {
                    $('#terminar').submit();
                });
            });
        </script>
    </head>
    <body>
        <?php include_once("analyticstracking.php") ?>
        <div id="contenido">
            <p id="titulo">CRÉA TU TIMELINE COVER DE MYSTERYLAND</p>
            <div id="titulo-leyenda-p2">
                <p>HEY! <?php echo $profile['first_name']?>,</p>
                <p>GENIAL, ACABAS DE CREAR TU PROPIO MYSTERYLAND TIMELINE COVER Y ESTAMOS SEGUROS DE QUE ESTA MUY BUENO! 
                    SI ESTAS CONTENTO CON TU IMAGEN PUEDES CONTINUAR CON EL ULTIMO PASO Y AÑADIR TU TIMELINE COVER A TU ALBUM DE FOTOS, 
                    SI NO, SOLO VUELVE ATRAS Y DALE OTRA VUELTA!.</p>
                <p style="color: #EC2E68; margin-top: 5px;">COMPARTE TU MYSTERYLAND TIMELINE COVER CON NOSOTROS Y PODRAS GANAR ESOS PASAJES PARA MYSTERYLAND 2012!</p>
            </div>
            <div style="margin-top: 10px;">
                <img src="upload/cover/<?php echo $nombre_imagen . "?timestamp=" . $fecha->getTimestamp(); ?>" id="imagen" style="border-radius: 25px; border: 1px solid #79b5b6;"/>
            </div>
            <div id="border">
                <img src="images/border.png" />
            </div>
            <div id="bottom-2">
                <div id="cambiar">
                    <span style="font-size: 18pt; cursor: pointer;" id="cambiar-click">CAMBIAR</span><span style="margin-left: 15px;">NOT SO HAPPY?</span>
                </div>
                <div id="seguir">
                    <span>HAPPY?</span><span style="font-size: 18pt; margin-left: 15px; cursor: pointer;" id="seguir-click">SIGUIENTE</span>
                </div>
            </div>
        </div>
        <form action="paso_1.php" method="POST" id="volver">
            <input type="hidden" name="texto" value="<?php echo $_POST['texto'] ?>" />
            <input type="hidden" name="grafica" value="<?php echo $_POST['grafica'] ?>" />
            <input type="hidden" name="colorfondo" value="<?php echo $_POST['colorfondo'] ?>" />
            <input type="hidden" name="colortexto" value="<?php echo $_POST['colortexto'] ?>" />
            <input type="hidden" name="fuente" value="<?php echo $_POST['fuente'] ?>" />
            <input type="hidden" name="tamfuente" value="<?php echo $_POST['tamfuente'] ?>" />
            <input type="hidden" name="align" value="<?php echo $_POST['align'] ?>" />
            <input type="hidden" name="imagen" value="<?php echo $_POST['imagen'] ?>" />
        </form>
        <form action="paso_3.php" method="POST" id="terminar">
            <input type="hidden" name="imagen" value="<?php echo $_POST['imagen'] ?>" />
        </form>
    </body>
</html>
