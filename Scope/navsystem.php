<?php
switch ($page) {
    case 'filmes':
        include "filmes.php";
        break;
    case 'about':
        include "about.php";
        break;
    case 'likes':
        include "likes.php";
        break;
    case 'perfil':
        include "perfil.php";
        break;
    case 'editar':
        include "editar.php";
        break;
    case 'eliminar':
        include "eliminar.php";
        break;
    default:
        include "home.php";
        break;
}
?>