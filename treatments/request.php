<?php
require_once "db.php";

function getTaches($motcle = '', $fstatut = '', $fprio = '') {
    global $pdo;
    
    $sql = "SELECT * FROM tache WHERE 1=1";

    if ($motcle != '' && $fstatut != '' && $fprio != '') {
        $sql = "SELECT * FROM tache WHERE (titre LIKE '%$motcle%') AND statut = '$fstatut'";
    } elseif ($motcle != '') {
        $sql = "SELECT * FROM tache WHERE titre LIKE '%$motcle%'";
    } elseif ($fstatut != '') {
        $sql = "SELECT * FROM tache WHERE statut = '$fstatut'";
    }elseif ($fprio != '') {
        $sql = "SELECT * FROM tache WHERE priorite = '$fprio'";
    }

    $requete = $pdo->query($sql);
    return $requete->fetchAll(PDO::FETCH_ASSOC);
}

function getTacheById($id) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT * FROM tache WHERE id = ?");
    $stmt->execute([$id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}
?>