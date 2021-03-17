<?php
require_once "../controller/post_controller.php";

$idPost = filter_input(INPUT_POST, 'idPost', FILTER_VALIDATE_INT);

$post = GetPostById($idPost);

$idMedia = "";

foreach (GetMediaByIdPost($idPost) as $media)
    $idMedia .= $media['idMedia'] . ';';

$idMedia = rtrim($idMedia, ';');

$commentaire = $post[0]['commentaire'];

$result = "";

$result .= "<div class='p-2 card w-75 h-50 bg-secondary'>";
$result .= "<form action='../view/update.php' method='POST' enctype='multipart/form-data'>";
$result .= "<table class='table table-borderless'>";
$result .= "<tr>";
$result .= "<td>";
$result .= "<label class='text-light' for='descriptionPost'>Description</label>";
$result .= "<textarea required class='form-control' name='descriptionPost' id='descriptionPost' rows='3'>$commentaire</textarea>";
$result .= "</td>";
$result .= "</tr>";
$result .= "<tr>";
$result .= "<td>";
$result .= "<label class='text-light' for='filePost'>File(s)</label>";
$result .= "<input required type='file' class='form-control' accept='audio/*,video/*,image/*' name='filePost[]' id='filePost' multiple>";
$result .= "</td>";
$result .= "</tr>";
$result .= "<tr>";
$result .= "<td>";
$result .= "<input type='hidden' name='idPost' value='$idPost'>";
$result .= "<input type='hidden' name='update' value='1'>";
$result .= "<input type='hidden' name='idMedia' value='$idMedia'>";
$result .= "<input type='submit' name='action' class='btn btn-dark btn-outline-light'>";
$result .= "</td>";
$result .= "</tr>";
$result .= "</table>";
$result .= "</form>";
$result .= "</div>";
