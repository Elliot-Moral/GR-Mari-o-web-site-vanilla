<?php
session_start();

$usuarios = isset($_SESSION['usuarios']) ? $_SESSION['usuarios'] : [];
$data = [
    ["id" => 1, "title" => "Artículo 1", "content" => "Contenido del artículo 1."],
    ["id" => 2, "title" => "Artículo 2", "content" => "Contenido del artículo 2."],
];

switch ($_SERVER['REQUEST_METHOD']) {
    case 'GET':
        echo json_encode($data);
        break;
    case 'POST':
        $nuevo_usuario = json_decode(file_get_contents('php://input'), true);
        $usuarios[] = $nuevo_usuario;
        $_SESSION['usuarios'] = $usuarios;
        echo json_encode(['mensaje' => 'Usuario creado', 'usuario' => $nuevo_usuario]);
        break;
    case 'DELETE':
        $id = json_decode(file_get_contents('php://input'), true)['id'];
        if (isset($usuarios[$id])) {
            unset($usuarios[$id]);
            $_SESSION['usuarios'] = $usuarios;
            echo json_encode(['mensaje' => 'Usuario eliminado']);
        } else {
            echo json_encode(['mensaje' => 'Usuario no encontrado']);
        }
        break;
    default:
        echo json_encode(['mensaje' => 'Método no permitido']);
        break;
}
?>
