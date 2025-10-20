<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Hello world</h1>
    <h2>Current date and time is: 
        <?php 
            echo (new DateTime())->format('Y-m-d H:i:s');
        ?>
    </h2>
</body>
</html>
