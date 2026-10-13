<?php
try {
    $pdo = new PDO('mysql:host=localhost;dbname=DSC;charset=utf8', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $engins = $pdo->query("SELECT * FROM TypeEngin")->fetchAll(PDO::FETCH_ASSOC);
} catch (Exception $e) {
    $engins = [];
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Les véhicules de pompier</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <div class="bg-white py-5 mb-5 shadow-sm text-center">
        <div class="container">
            <h1 class="fw-bold">Les véhicules de pompier</h1>
            <p class="text-muted">Voici la liste des types de véhicules que l'on peut trouver dans une caserne de pompiers.</p>
        </div>
    </div>

    <div class="container">
        <div class="row row-cols-1 row-cols-md-3 g-4">
            <?php foreach ($engins as $e): ?>
                <div class="col">
                    <div class="card h-100 shadow-sm border-0">
                        <?php if (!empty($e['photo'])): ?>
                            <img src="uploads/<?= htmlspecialchars($e['photo']) ?>" class="card-img-top" style="height: 200px; object-fit: cover;" alt="Image engin">
                        <?php endif; ?>
                        <div class="card-body">
                            <h5 class="card-title fs-6 fw-bold"><?= htmlspecialchars($e['LblEngincol']) ?></h5>
                            <div class="d-flex gap-2 mt-3">
                                <a href="modifier_engin.php?id=<?= $e['idTypeEngin'] ?>" class="btn btn-outline-secondary btn-sm px-3">Modifier</a>
                                <a href="supprimer_engin.php?id=<?= $e['idTypeEngin'] ?>" class="btn btn-outline-secondary btn-sm px-3">Supprimer</a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        
        <div class="mt-5 text-center">
            <a href="ajouter_engin.php" class="btn btn-primary">Ajouter un type d'engin</a>
        </div>
    </div>

</body>
</html>