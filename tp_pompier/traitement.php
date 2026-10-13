<?php
// On vérifie si les données ont bien été envoyées via le formulaire
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // 1. Récupération des données du formulaire HTML
    $matricule = $_POST['matricule'] ?? '';
    $nom = $_POST['nom'] ?? '';
    $grade = $_POST['grade'] ?? '';

    // 2. Sécurité : Vérification côté PHP (si un champ est vide, on arrête tout)
    if (empty($matricule) || empty($nom) || empty($grade)) {
        die("Erreur : Tous les champs obligatoires doivent être remplis !");
    }

    try {
        // 3. Connexion à MySQL
        $pdo = new PDO('mysql:host=localhost;dbname=DSC;charset=utf8', 'root', '');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // 4. Insertion sécurisée dans la base de données SQL avec une requête préparée
        $sql = "INSERT INTO Pompier (Matricule, NomPompier, IdGrade) VALUES (:mat, :nom, :grade)";
        $stmt = $pdo->prepare($sql);
        
        $stmt->execute([
            ':mat' => $matricule,
            ':nom' => $nom,
            ':grade' => $grade
        ]);

        // 5. Si tout s'est bien passé
        echo "OK ! Le pompier a bien été ajouté dans la base de données.";

    } catch (PDOException $e) {
        echo "Erreur SQL : " . $e->getMessage();
    }

} else {
    // Si quelqu'un essaie d'accéder à traitement.php directement dans l'URL sans passer par le formulaire
    header("Location: index.php");
    exit();
}
?>