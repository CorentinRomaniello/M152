<?php
require_once "../model/functions.php";

$result = "";

$id = 0;

foreach (GetPost() as $p) {

    $id++;

    $result .= "<div class='card mb-5' style='width: 25%;'>";
    $result .= "<div id='carousel_$id' class='carousel slide' data-bs-ride='carousel'>";
    $result .= "<div class='carousel-inner'>";

    $first = true;

    foreach (GetMediaByIdPost($p['idPost']) as $m) {

        $nomFichier = $m['nomFichierMedia'];

        if ($first) {
            $result .= "<div class='carousel-item active'>";
            $first = false;
        } else {
            $result .= "<div class='carousel-item'>";
        }

        $result .= "<img class='d-block w-100' src='$nomFichier' alt='$nomFichier'>";
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
    $result .= "<h5 class='card-title'>Card title</h5>";
    $result .= "<p class='card-text'>$commentaire</p>";
    $result .= "</div>";
    $result .= "</div>";
}
