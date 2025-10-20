<?php
try {
    $dbConnection = new mysqli(
        'localhost',
        'root',
        '',
        'iab',
        3306
    );
} catch (Exception $e) {
    die('Connection failed: ' . $e->getMessage());
}

try {
    $stmt = $dbConnection->prepare('SELECT id, name FROM roles order by name');
    $stmt->execute();
    $result = $stmt->get_result();
    $roles = $result->fetch_all(MYSQLI_ASSOC);
} catch (Exception $e) {
    die('sql failed: ' . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h2>User roles</h2>
    <div> 
        <?php 
        foreach ($roles as $role) {
            echo '<p>' . $role['id'] . ' : ' . $role['name'] . '</p>';
        }
        ?>
    </div>
</body>
</html>
