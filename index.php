<?php
    require_once('config/config.php');

    $url = !empty($_GET['url']) ? $_GET['url'] : 'home';
    $arr_url = explode("/", $url);

    $controlador = !empty($arr_url[0]) ? $arr_url[0] : 'home';
    $controlador_path = "controllers/$controlador.php";

    // Verifica si el archivo del controlador existe.
    if (file_exists($controlador_path)) {
        require_once($controlador_path);

        // Verifica si la clase del controlador existe.
        if (class_exists($controlador)) {
            $controlador = new $controlador();
            $controlador->index();
        } else {
            // Controlador no encontrado, muestra error 404.
            http_response_code(404);
            require_once('views/404.php'); // Asegúrate de que la vista 404 existe.
        }
    } else {
        // Archivo del controlador no encontrado, muestra error 404.
        http_response_code(404);
        require_once('views/404.php'); // Asegúrate de que la vista 404 existe.
    }
?>
