<?php
// 1. On se connecte à la base de données MySQL
try {
    $pdo = new PDO('mysql:host=localhost;dbname=DSC;charset=utf8', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $e) {
    die('Erreur de connexion : ' . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajout Pompier</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container my-5">
    <h2 class="mb-4">Ajout Pompier</h2>
    
    <!-- ATTENTION ICI : target vers traitement.php et méthode POST -->
    <form action="traitement.php" method="POST">
        
        <div class="mb-3">
            <label for="matricule" class="form-label">Matricule</label>
            <input type="number" class="form-control" id="matricule" name="matricule" required>
        </div>

        <div class="mb-3">
            <label for="nom" class="form-label">Nom</label>
            <input type="text" class="form-control" id="nom" name="nom" required>
        </div>

        <!-- Exemple : Liste déroulante des grades alimentée dynamiquement par le SQL -->
        <div class="mb-3">
            <label for="grade" class="form-label">Grade</label>
            <select class="form-select" id="grade" name="grade" required>
                <option selected disabled value="">Choisir un grade...</option>
                <?php
                $req = $pdo->query("SELECT idGrade, LblGrade FROM Grade");
                while ($row = $req->fetch()) {
                    echo "<option value='" . $row['idGrade'] . "'>" . $row['LblGrade'] . "</option>";
                }
                ?>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Valider</button>
    </form>
</body>
</html>