<?php
require_once "treatments/request.php"; 

$dosseier_public = "http://localhost/PHP/gestion_tache_emp/public/";
$path_json = "treatments/taches.json";

$motcle = $_GET['motcle'] ?? '';
$fstatut = $_GET['fstatut'] ?? '';
$fprio = $_GET['fprio'] ?? '';

$taches = getTaches($motcle, $fstatut, $fprio);

$aujourdhui = date('Y-m-d');
$totalTaches = count($taches);
$tachesTerminees = 0;
$tachesEnRetard = 0;

foreach ($taches as $t) {
    if ($t['statut'] === 'terminée') $tachesTerminees++;
    if ($t['statut'] !== 'terminée' && !empty($t['date_limite']) && $t['date_limite'] < $aujourdhui) {
        $tachesEnRetard++;
    }
}
$pourcentageTermine = ($totalTaches > 0) ? round(($tachesTerminees / $totalTaches) * 100) : 0;

$tache_a_modifier = null;
if (isset($_GET['modifier'])) {
    $tache_a_modifier = getTacheById($_GET['modifier']);
}

include_once "includes/header.php";
include_once "includes/navbar.php";
include_once "includes/sidebar.php";

$page = $_GET['page'] ?? "accueil";
if (file_exists("pages/$page.php")) {
    include_once "pages/$page.php";
} else {
    include_once "pages/erreur404.php";
}

include_once "includes/footer.php";