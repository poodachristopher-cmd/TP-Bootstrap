<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = trim($_POST['idTypeEngin'] ?? '');
    $libelle = trim($_POST['libelle'] ?? '');
    $nomImage = '';

    if (isset($_FILES['photo']) && $_FILES['photo']['error'] === 0) {
        $nomImage = time() . '_' . basename($_FILES['photo']['name']);
        move_uploaded_file($_FILES['photo']['tmp_name'], 'uploads/' . $nomImage);
    }

    try {
        $pdo = new PDO('mysql:host=localhost;dbname=DSC;charset=utf8', 'root', '');
        $stmt = $pdo->prepare("INSERT INTO TypeEngin (idTypeEngin, LblEngincol, photo) VALUES (?, ?, ?)");
        $stmt->execute([$id, $libelle, $nomImage]);
        header('Location: liste_engins.php');
        exit();
    } catch (Exception $e) {
        $erreur = "Erreur : " . $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajout d'un type Engin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <div class="bg-white py-5 mb-5 shadow-sm text-center">
        <div class="container">
            <h1 class="fw-bold">Ajout d'un type Engin</h1>
            <p class="text-muted">Formulaire pour ajouter un type engin</p>
        </div>
    </div>

    <div class="container" style="max-width: 600px;">
        <?php if(isset($erreur)) echo "<div class='alert alert-danger'>$erreur</div>"; ?>
        
        <form action="" method="POST" enctype="multipart/form-data" class="bg-white p-4 rounded shadow-sm">
            <div class="mb-3">
                <label class="form-label">idTypeEngin</label>
                <input type="text" class="form-control" name="idTypeEngin" placeholder="Ex : EPA" required>
            </div>
            
            <div class="mb-3">
                <label class="form-label">Photo</label>
                <input type="file" class="form-control" name="photo">
            </div>
            
            <div class="mb-3">
                <label class="form-label">Libellé de l'engin</label>
                <input type="text" class="form-control" name="libelle" required>
            </div>
            
            <button type="submit" class="btn btn-primary">Ajouter</button>
            <a href="liste_engins.php" class="btn btn-secondary">Retour</a>
        </form>
    </div>

</body>
</html>