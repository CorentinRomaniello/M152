<?php
require_once "../model/functions.php";

$result = "";

$id = 0;

foreach (GetPost() as $p) {

    $id++;

    $result .= "<div class='card mb-5 w-25 h-25'>";
    $result .= "<div id='carousel_$id' class='carousel slide'>";
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



    $commentaire = $p['commentaire'];

    $result .= "</div>";

    $result .= "<button class='carousel-control-prev' type='button' data-bs-target='#carousel_$id' data-bs-slide='prev'>";
    $result .= "<span class='carousel-control-prev-icon' aria-hidden='true'></span>";
    $result .= "<span class='visually-hidden'>Previous</span>";
    $result .= "</button>";

    $result .= "<button class='carousel-control-next' type='button' data-bs-target='#carousel_$id' data-bs-slide='next'>";
    $result .= "<span class='carousel-control-next-icon' aria-hidden='true'></span>";
    $result .= "<span class='visually-hidden'>Next</span>";
    $result .= "</button>";
    $result .= "</div>";

    $result .= "<div class='card-body'>";
    $result .= "<h5 class='card-title'>Commentaire</h5>";
    $result .= "<p class='card-text'>$commentaire</p>";
    $result .= "</div>";
    $result .= "</div>";
}
