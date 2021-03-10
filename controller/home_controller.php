<?php
require_once "../model/functions.php";

$result = "";

$id = 0;

foreach (GetPost() as $p) {

    $id++;

    $result .= "<div class='card mb-5 w-25 h-25'>";
    $result .= "<div id='carousel_$id' data-bs-ride='carousel' data-bs-interval='false' class='carousel slide'>";
    $result .= "<div class='carousel-inner'>";

    $first = true;

    foreach (GetMediaByIdPost($p['idPost']) as $m) {

        $nomFichier = $m['nomFichierMedia'];
        $typeFichier = $m['typeMedia'];

        if ($first) {
            $result .= "<div class='carousel-item active w-100 h-100'>";
            $first = false;
        } else {
            $result .= "<div class='carousel-item'>";
        }

        switch ($typeFichier) {
            case 'audio':
                $result .= "<audio class='card-img-top' controls src='$nomFichier'>Your browser does not support the<code>audio</code> element.</audio>";
                break;
            case 'image':
                $result .= "<img class='card-img-top' src='$nomFichier' alt='$nomFichier'>";
                break;
            case 'video':
                $result .= "<video class='card-img-top' controls muted loop autoplay><source src='$nomFichier' type='video/mp4'><p>Votre navigateur ne prend pas en charge les vidéos HTML5.</p></video>";
            default:
                break;
        }

        $result .= "</div>";

        $first = false;
    }

    $idPost = $p['idPost'];

    $commentaire = $p['commentaire'];

    $result .= "</div>";

    $result .= "<a class='carousel-control-prev mt-5 h-75' type='button' data-bs-target='#carousel_$id' data-bs-slide='prev'>";
    $result .= "<span class='carousel-control-prev-icon' aria-hidden='true'></span>";
    $result .= "<span class='visually-hidden'>Previous</span>";
    $result .= "</a>";

    $result .= "<a class='carousel-control-next mt-5 h-75' type='button' data-bs-target='#carousel_$id' data-bs-slide='next'>";
    $result .= "<span class='carousel-control-next-icon' aria-hidden='true'></span>";
    $result .= "<span class='visually-hidden'>Next</span>";
    $result .= "</a>";
    $result .= "</div>";

    $result .= "<div class='card-body'>";
    $result .= "<div class='d-flex flex-row'>";
    $result .= "<h5 class='card-title p-2'>Commentaire</h5>";
    $result .= "<form action='../controller/delete_controller.php' method='post'>";
    $result .= "<input type='hidden' name='idPost' value='$idPost'>";
    $result .= "<p class='card-text p-2'><button type='submit' class='btn btn-outline-danger'><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='dark' class='bi bi-trash' viewBox='0 0 16 16'><path d='M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z'/><path fill-rule='evenodd' d='M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z'/></svg></button></p>";
    $result .= "</form>";
    $result .= "</div>";
    $result .= "<p class='card-text p-2'>$commentaire</p>";
    $result .= "</div>";
    $result .= "</div>";
}
