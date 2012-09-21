<?php
 
if (array_key_exists('img',$_REQUEST)) {
    echo $_REQUEST['img'];
 
    // convierte la imagen recibida en base64
    // Eliminamos los 22 primeros caracteres, que 
    // contienen el substring "data:image/png;base64,"
    $imgData = base64_decode(substr($_REQUEST['img'],22));
 
    // Path en donde se va a guardar la imagen
    $file = 'upload/' . $_POST['nombre'];
 
    // borrar primero la imagen si existía previamente
    if (file_exists($file)) { unlink($file); }
 
        // guarda en el fichero la imagen contenida en $imgData
        $fp = fopen($file, 'w');
        fwrite($fp, $imgData);
        fclose($fp);
}
?>