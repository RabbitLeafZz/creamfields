<?php

if (isset($_POST['imagen'])) {
    $nombre_imagen = $_POST['imagen'];
} else {
    
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
    
    // Login or logout url will be needed depending on current user state.
    if ($user) {
        $fecha = new DateTime();
        $nombre_imagen = $profile['id'] . "_" . $fecha->getTimestamp() . '.png';
    } else {
        header('Location: index.php') ;
    }
}

?>

<!DOCTYPE html>
<html>
    <head>
        <title></title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link href="css/reset.css" rel="stylesheet" type="text/css" />
        <link href="css/MyFontsWebfontsKit.css" rel="stylesheet" type="text/css" />
        <link type="text/css" href="css/custom-theme/jquery-ui-1.8.21.custom.css" rel="stylesheet" />
        
        <style>
            body {
                background: url(images/background-2.png) no-repeat center top;
            }
        </style>
        <link href="css/style.css" rel="stylesheet" type="text/css" />
        
        <script src="js/jquery-1.7.2.min.js"></script>
        <script src="js/jquery-ui-1.8.21.custom.min.js"></script>
        <script src="js/jquery.queryloader2.js"></script>
        <script src="js/jquery.blockUI.js"></script>
        <script>
            
            var canvas;
            var context;
            var img = new Image();
            var borrado;
            var texto;
            
            $(document).ready(function() {
                
                $("body").queryLoader2({ 
                    backgroundColor: '#FFF', 
                    barColor: '#000',
                    percentage: true
                });
                
                $('.colorfondo').click(function() {
                    $('#cover').css('background-color', $(this).css('background-color'));
                    $('input[name="colorfondo"]').attr('value', $(this).css('background-color'));
                });
                
                $('#cover').click(function() {
                    $('input[name="texto"]').focus();
                });
                
                $('#texttool').draggable({ 
                    containment: 'parent'
                });
                
                $('#tamanofuente').slider({
                    min: 15,
                    max: 32,
					value: 25,
                    change: function(event, ui) {
                        $('input[name="texto"]').css('font-size', ui.value+'pt');
                        $('input[name="tamfuente"]').attr('value', ui.value);
                    }
				});
                
                $('#alignleft').click(function() {
                    $('input[name="texto"]').css('text-align', 'left');
                    $('input[name="align"]').attr('value', 'left');
                });
                
                $('#aligncenter').click(function() {
                    $('input[name="texto"]').css('text-align', 'center');
                    $('input[name="align"]').attr('value', 'center');
                });
                
                $('#alignright').click(function() {
                    $('input[name="texto"]').css('text-align', 'right');
                    $('input[name="align"]').attr('value', 'right');
                });
                
                $('#minfont').click(function() {
                    $('#tamanofuente').slider('value', 15);
                });
                
                $('#maxfont').click(function() {
                    $('#tamanofuente').slider('value', 35);
                });
                
                $('#font1').click(function() {
                    $('input[name="texto"]').css('font-family', 'Populaire');
                    $('input[name="fuente"]').attr('value', $('input[name="texto"]').css('font-family'));
                    $('#font1 img').attr('src', 'images/dot-active.png');
                    $('#font2 img').attr('src', 'images/dot.png');
                });
                
                $('#font2').click(function() {
                    $('input[name="texto"]').css('font-family', 'Billboard');
                    $('input[name="fuente"]').attr('value', $('input[name="texto"]').css('font-family'));
                    $('#font2 img').attr('src', 'images/dot-active.png');
                    $('#font1 img').attr('src', 'images/dot.png');
                });
                
                $('.colorfuente').click(function() {
                    $('input[name="texto"]').css('color', $(this).children('div').css('background-color'));
                    $('input[name="colortexto"]').attr('value', $(this).children('div').css('background-color'));
                    $('.colorfuente img').attr('src', 'images/dot.png');
                    $(this).children('img').attr('src', 'images/dot-active.png');
                });
                
                canvas = document.getElementById("cover");
                context = canvas.getContext("2d");
                img.onload = function(){
                    //incluyo la imagen en el canvas
                    borrado = context.getImageData(0, 0, 704, 260);
                    context.drawImage(img, 0, 0);
                }
                
                <?php if(isset($_POST['grafica'])) { ?>
                    img.src = '<?php echo $_POST['grafica']; ?>';
                    $('#cover').css('background-color', '<?php echo $_POST['colorfondo']; ?>');
                    $('input[name="texto"]').css('color', '<?php echo $_POST['colortexto']; ?>');
                    $('input[name="texto"]').css('font-family', '<?php echo $_POST['fuente']; ?>');
                    $('input[name="texto"]').css('font-size', '<?php echo $_POST['tamfuente']; ?>');
                    $('input[name="texto"]').css('text-align', '<?php echo $_POST['align']; ?>');
                    $('#tamanofuente').slider('value', <?php echo $_POST['tamfuente']; ?>);
                    $('input[name="texto"]').attr('value', '<?php echo $_POST['texto']; ?>');
                    $('input[name="grafica"]').attr('value', '<?php echo $_POST['grafica']; ?>');
                    $('input[name="colorfondo"]').attr('value', '<?php echo $_POST['colorfondo']; ?>');
                    $('input[name="colortexto"]').attr('value', '<?php echo $_POST['colortexto']; ?>');
                    $('input[name="fuente"]').attr('value', '<?php echo $_POST['fuente']; ?>');
                    $('input[name="tamfuente"]').attr('value', '<?php echo $_POST['tamfuente']; ?>');
                    $('input[name="align"]').attr('value', '<?php echo $_POST['align']; ?>');
                <?php } else { ?>
                    img.src = 'images/grap/ml-image-08.png';
                    $('input[name="grafica"]').attr('value', 'images/grap/ml-image-08.png');
                    $('input[name="colorfondo"]').attr('value', $('#cover').css('background-color'));
                    $('input[name="colortexto"]').attr('value', $('input[name="texto"]').css('color'));
                    $('input[name="fuente"]').attr('value', $('input[name="texto"]').css('font-family'));
                    $('input[name="tamfuente"]').attr('value', $('#tamanofuente').slider('value'));
                    $('input[name="align"]').attr('value', $('input[name="texto"]').css('text-align'));
                <?php } ?>
                
                $('.graphic').click(function() {
                    context.putImageData(borrado, 0, 0);
                    img.src = $(this).attr('src');
                    $('input[name="grafica"]').attr('value', $(this).attr('src'));
                });
            });
            
            function siguiente() {
                
                $.blockUI({
                    message: 'Generando Imagen...',
                    css: {
                        border: 'none',
                        padding: '15px', 
                        backgroundColor: '#000', 
                        '-webkit-border-radius': '10px', 
                        '-moz-border-radius': '10px', 
                        opacity: .5, 
                        color: '#fff',
                        'font-size': '30pt'
                    }
                }); 
                
                context.fillStyle = $('#cover').css('background-color');
                context.fillRect(0, 0, context.canvas.width, context.canvas.height);
                
                context.drawImage(img, 0, 0);
                
                    var texto = $('input[name="texto"]').attr('value');
                    var width = context.canvas.width;
                    var heigth = context.canvas.height;
                    var len = context.measureText(texto).width;

                    context.font = $('#texto input').css('font-size') + ' ' + $('#texto input').css('font-family');;
                    context.fillStyle = $('input[name="texto"]').css('color');
                    context.textAlign = "center";
                    
                    var align = $('input[name="texto"]').css('text-align');
                    
                    if (align == 'center') {
                        width = width/2;
                        context.textAlign = "center";
                    } else if (align == 'left') {
                        width = 95;
                        context.textAlign = "left";
                    } else {
                        width = width - 97;
                        context.textAlign = "right";
                    }

                    $('#texto').hide();
                    $('#align').hide();
                    context.fillText(texto,width,(heigth/2)+11);

                    $.post('guardar_imagen.php',{ img : canvas.toDataURL(), nombre: 'cover/<?php echo $nombre_imagen; ?>' }, function() {
                        $.unblockUI();
                        $('#nextstep').submit();
                    });
            }
        </script>
    </head>
    <body>
        <?php include_once("analyticstracking.php") ?>
        <div id="contenido">
            <p id="titulo">CRÉA TU TIMELINE COVER DE MYSTERYLAND</p>
            <div id="cover_content">
                <canvas id="cover" height="260" width="704">
                    LAMENTABLEMENRE TU NAVEGADOR NO ES COMPATIBLE, ACTUALIZA A LA ÃšLTIMA VERSIÃ“N O DESCARGA ALGÃšN ALTERNATIVO
                </canvas>
                <div id="border">
                    <img src="images/border.png" />
                </div>
                <div id="content_texttool">
                    <div id="texttool" >
                        <div id="align">
                            <img src="images/align-left.png" id="alignleft"/>
                            <img src="images/align-center.png" id="aligncenter"/>
                            <img src="images/align-rigth.png" id="alignright"/>
                            <img src="images/hand.png" />
                        </div>
                        <div id="texto">
                            <form action="paso_2.php" method="POST" id="nextstep">
                                <input type="text" name="texto" placeholder="ESCRIBE TU LÍNEA..."/>
                                <input type="hidden" name="imagen" value="<?php echo $nombre_imagen; ?>" />
                                <input type="hidden" name="grafica" />
                                <input type="hidden" name="colorfondo" />
                                <input type="hidden" name="colortexto" />
                                <input type="hidden" name="fuente" />
                                <input type="hidden" name="tamfuente" />
                                <input type="hidden" name="align" />
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div id="bottom">
                <div id="tools">
                    <div id="graphics">
                        <div id="graph_tab">
                            <table class="graph" cellpadding="0">
                                <tr>
                                    <td colspan="3">SELECCIONA LA GRÁFICA</td>
                                </tr>
                                <tr>
                                    <td><img class="graphic puntero" src="images/grap/ml-image-01.png" /></td>
                                    <td><img class="graphic puntero" src="images/grap/ml-image-02.png" /></td>
                                    <td><img class="graphic puntero" src="images/grap/ml-image-03.png" /></td>
                                </tr>
                                <tr>
                                    <td><img class="graphic puntero" src="images/grap/ml-image-04.png" /></td>
                                    <td><img class="graphic puntero" src="images/grap/ml-image-05.png" /></td>
                                    <td><img class="graphic puntero" src="images/grap/ml-image-06.png" /></td>
                                </tr>
                                <tr>
                                    <td><img class="graphic puntero" src="images/grap/ml-image-07.png" /></td>
                                    <td><img class="graphic puntero" src="images/grap/ml-image-08.png" /></td>
                                    <td><img class="graphic puntero" src="images/grap/ml-image-09.png" /></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div id="background">
                        <div id="back_cont">
                            <div>COLOR DE FONDO</div>
                            <div id="colores">
                                <div id="color_1" class="colorfondo puntero"></div>
                                <div id="color_2" class="colorfondo puntero"></div>
                                <div id="color_3" class="colorfondo puntero"></div>
                                <div id="color_4" class="colorfondo puntero"></div>
                            </div>
                        </div>
                    </div>
                    <div id="font">
                        <div id="font_cont">
                            <div>FUENTE</div>
                            <div id="tipo_fuente">
                                <div id="font1" class="puntero"><img src="images/dot-active.png" /> FUENTE UNO</div>
                                <div id="font2" class="puntero"><img src="images/dot.png" /> FUENTE DOS</div>
                            </div>
                            <div id="color_fuente">
                                <div id="colorfont1" class="colorfuente puntero" ><div></div><img src="images/dot-active.png" /></div>
                                <div id="colorfont2" class="colorfuente puntero" ><div></div><img src="images/dot.png" /></div>
                                <div id="colorfont3" class="colorfuente puntero" ><div></div><img src="images/dot.png" /></div>
                                <div id="colorfont4" class="colorfuente puntero" ><div></div><img src="images/dot.png" /></div>
                            </div>
                            <div id="tamano_fuente">
                                <img src="images/abc-min.png" id="minfont" style="cursor: pointer"/> <div class="tam_fuente"><div id="tamanofuente" style="position: absolute; margin-top: -10px;"></div></div><!--<input type="range" min="15" max="35" value="25" step="1" id="tamanofuente" />--> <img src="images/abc-max.png" id="maxfont" style="cursor: pointer"/>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="next">
                    <div id="next_content">
                        <div>HAPPY?</div>
                        <div id="siguiente" class="puntero" onclick="siguiente();">SIGUIENTE</div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
