<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuario de ejemplo</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 2rem; }
        .card { padding: 1.5rem; border: 1px solid #ccc; border-radius: 8px; max-width: 420px; }
        .card h1 { margin-top: 0; }
    </style>
</head>
<body>
    <div class="card">
        <h1>Datos del usuario</h1>
        <p><strong>ID:</strong> <?= htmlspecialchars($user->getId(), ENT_QUOTES, 'UTF-8') ?></p>
        <p><strong>Nombre:</strong> <?= htmlspecialchars($user->getName(), ENT_QUOTES, 'UTF-8') ?></p>
        <p><strong>Email:</strong> <?= htmlspecialchars($user->getEmail(), ENT_QUOTES, 'UTF-8') ?></p>
    </div>
</body>
</html>
