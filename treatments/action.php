<?php
require_once "db.php"; 
$json = "taches.json";

$action = $_POST['action'] ?? $_GET['action'] ?? '';

if ($action == 'ajouter') {
    $titre = $_POST['titre'];
    $description = $_POST['description'];
    $priorite = $_POST['priorite'];
    $datel = $_POST['datel'];
    $responsable = $_POST['responsable'];
    $datec = date('Y-m-d');

    $sql = "INSERT INTO tache (titre, description, priorite, statut, date_de_creation, date_limite, responsable) 
            VALUES (?, ?, ?, 'à faire', ?, ?, ?)";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([$titre, $description, $priorite,$datec, $datel, $responsable]);
}

if ($action == 'modifier') {
    $id = $_POST['id'];
    $titre = $_POST['titre'];
    $description = $_POST['description'];
    $priorite = $_POST['priorite'];
    $datel = $_POST['datel'];
    $responsable = $_POST['responsable'];

    $sql = "UPDATE tache SET titre=?, description=?, priorite=?, date_limite=?, responsable=? 
            WHERE id=? AND statut != 'terminée'";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([$titre, $description, $priorite, $datel, $responsable, $id]);
}

if ($action == 'supprimer') {
    $stmt = $pdo->prepare("DELETE FROM tache WHERE id = ?");
    $stmt->execute([$_GET['id']]);
}

if ($action == 'statut') {
    $id = $_GET['id'];

    $req = $pdo->prepare("SELECT statut FROM tache WHERE id = ?");
    $req->execute([$id]);
    $actuel = $req->fetchColumn();
    
    $suivant = ($actuel == 'à faire') ? 'en cours' : 'terminée';
    
    $maj = $pdo->prepare("UPDATE tache SET statut = ? WHERE id = ?");
    $maj->execute([$suivant, $id]);
}

$stmt = $pdo->query("SELECT * FROM tache");
$AllTaches = $stmt->fetchAll(PDO::FETCH_ASSOC);

file_put_contents($json, json_encode($AllTaches, JSON_PRETTY_PRINT));

$retour = ($action == 'supprimer') ? 'indexTache' : 'accueil';
header("Location: ../index.php?page=$retour");
exit();