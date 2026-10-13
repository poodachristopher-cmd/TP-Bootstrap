<?php
$id = $_GET['id'] ?? '';
try {
    $pdo = new PDO('mysql:host=localhost;dbname=DSC;charset=utf8', 'root', '');
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $stmt = $pdo->prepare("DELETE FROM TypeEngin WHERE idTypeEngin = ?");
        $stmt->execute([$id]);
        header('Location: liste_engins.php');
        exit();
    }

    $stmt = $pdo->prepare("SELECT * FROM TypeEngin WHERE idTypeEngin = ?");
    $stmt->execute([$id]);
    $engin = $stmt->fetch(PDO::FETCH_ASSOC);
} catch (Exception $e) {
    die("Erreur : " . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Suppression d'un type Engin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <div class="bg-white py-5 mb-5 shadow-sm text-center">
        <div class="container">
            <h1 class="fw-bold">Suppression d'un type Engin</h1>
            <p class="text-danger fw-bold">Attention la suppression est définitive !!!</p>
        </div>
    </div>

    <div class="container text-center" style="max-width: 500px;">
        <?php if ($engin): ?>
            <div class="card shadow-sm border-0 p-3 mb-4 bg-white">
                <?php if (!empty($engin['photo'])): ?>
                    <img src="uploads/<?= htmlspecialchars($engin['photo']) ?>" class="card-img-top mb-3" style="height: 250px; object-fit: cover;" alt="Engin">
                <?php endif; ?>
                <h5><?= htmlspecialchars($engin['LblEngincol']) ?></h5>
            </div>

            <form action="" method="POST">
                <button type="submit" class="btn btn-danger px-4">Supprimer</button>
                <a href="liste_engins.php" class="btn btn-secondary px-4">Annuler</a>
            </form>
        <?php else: ?>
            <p>Engin introuvable.</p>
            <a href="liste_engins.php" class="btn btn-primary">Retour</a>
        <?php endif; ?>
    </div>

</body>
</html>