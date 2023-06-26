<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>App Salón</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;700;900&display=swap" rel="stylesheet"> 
    <link rel="stylesheet" href="/build/css/app.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
</head>
<body>
    <div class="layout__contenedor">
        <div class="layout__imagen <?php  echo 'layout__'.$imagen ?>"></div>
        <div class="layout__app">
            <?php echo $contenido; ?>
        </div>
    </div>


   
   <?php
        echo $script ?? '';
   ?>
   
</body>
</html>