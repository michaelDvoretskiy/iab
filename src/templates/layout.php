<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Handmade project</title>
    <link rel="stylesheet" href="/styles.css">
</head>
<body>
    <?php if ($params['showMenu'] ?? true) : ?>
        <?php include __DIR__ . '/menu.php'; ?>
    <?php endif; ?>
    <?php if ($params['showHead'] ?? true) : ?>
        <h1>This is my handmade project</h1>
    <?php endif; ?>
    <?php include $template; ?>
</body>
</html>