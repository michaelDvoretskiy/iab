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
        foreach ($params['roles'] as $role) {
            echo '<p>' . $role['id'] . ' : ' . $role['name'] . '</p>';
        }
        ?>
    </div>
</body>
</html>
