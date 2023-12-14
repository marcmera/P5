<?php

// Incluye el archivo con la lógica del controlador
require_once '../controller/controller.php';

// Verifica si se ha enviado una solicitud POST y establece el botón activo
$activeButton = isset($_POST['boton']) ? $_POST['boton'] : '';
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="author" content="Marc Mera">
    <meta name="description" content="Lista de Videojuegos">
    <meta name="keywords" content="videojuegos, juegos, lista de juegos">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Videojuegos</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
</head>

<body class="bg-gray-100">

    <div class="container mx-auto p-4">
        <h1 class="text-8xl font-bold p-16 text-center">Videojuegos</h1>

        <!-- Formulario para ordenar los juegos -->
        <form action="../controller/controller.php" method="post" class="mb-4 flex space-x-2 items-center">
            <input type="hidden" name="order-games" value="order">
            <label class="text-2xl font-bold">Order by: </label>
            <button type="submit" name="boton" value="popularity"
                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded <?php echo ($activeButton === 'popularity') ? 'bg-blue-700' : 'bg-blue-500'; ?>">Popularidad</button>
            <button type="submit" name="boton" value="genre"
                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded <?php echo ($activeButton === 'genre') ? 'bg-blue-700' : 'bg-blue-500'; ?>">Género</button>
            <button type="submit" name="boton" value="title"
                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded <?php echo ($activeButton === 'title') ? 'bg-blue-700' : 'bg-blue-500'; ?>">Título</button>
        </form>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            <?php
            // Mostrar los juegos ordenados
            foreach ($games as $game) {
                echo '<div class="bg-white p-4 rounded shadow-md">';
                echo '<h2 class="text-xl font-bold mb-2">'. $game["title"] . '</h2>';
                echo '<p class="text-gray-600 font-bold">Género: <span class="font-normal">' . $game["genre"] . '</span> </p>';
                echo '<p class="text-gray-600 font-bold">Popularidad: <span class="font-normal">' . $game["popularity"] . '</span> </p>';
                echo '</div>';
            }
            ?>
        </div>
    </div>
</body>

</html>
