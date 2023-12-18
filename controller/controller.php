<?php

    // Lista de juegos
    $games = [
        ["title" => "Apex Legends", "genre" => "Battle Royale", "popularity" => 8],
        ["title" => "FIFA 22", "genre" => "Sports", "popularity" => 7],
        ["title" => "Assassin's Creed Valhalla", "genre" => "Action RPG", "popularity" => 9],
        ["title" => "Cyberpunk 2077", "genre" => "Open World RPG", "popularity" => 8],
        ["title" => "Among Us", "genre" => "Party Game", "popularity" => 9],
        ["title" => "Red Dead Redemption 2", "genre" => "Action-Adventure", "popularity" => 8],
        ["title" => "Minecraft", "genre" => "Sandbox", "popularity" => 7],
        ["title" => "Valorant", "genre" => "FPS", "popularity" => 8],
        ["title" => "Rocket League", "genre" => "Sports", "popularity" => 6],
        ["title" => "The Witcher 3: Wild Hunt", "genre" => "Action RPG", "popularity" => 9],
        ["title" => "Fortnite", "genre" => "Battle Royale", "popularity" => 7],
        ["title" => "Overwatch", "genre" => "FPS", "popularity" => 8],
        ["title" => "Rainbow Six Siege", "genre" => "FPS", "popularity" => 7],
        ["title" => "World of Warcraft", "genre" => "MMORPG", "popularity" => 9],
    ];

    // Función para saludar al jugador
    function greetPlayer($name, $favoriteGame)
    {
        echo "<h1>Hola $name</h1><h3>Tu juego favorito es $favoriteGame</h3>";
    }

    // Función para mostrar una tarjeta de juego
    function displayCard($title, $genre, $popularity)
    {
        echo "<div class='card'><h2>$title</h2><p>Género: $genre</p><p>Popularity: $popularity</p></div>";
    }

    // Función para ordenar los juegos por género
    function sortGames(&$games, $genre)
    {
        // Verifica si el array de juegos es válido y no está vacío
        if (!is_array($games) || empty($games)) {
            echo "El array de juegos no es válido o está vacío.";
            return;
        }

        // Ordena los juegos por orden de inserción si el género es "clear"
        if ($genre === 'clear') {
            return;
        }

        foreach ($games as &$game) {
            // Asegúrate de que la clave proporcionada exista en cada juego
            if (!isset($game[$genre])) {
                $game[$genre] = ''; // o cualquier valor por defecto que desees
            }
        }

        usort($games, function ($a, $b) use ($genre) {
            // Realiza una comparación específica según la clave
            if ($genre === 'popularity') {
                // Ordena de mayor a menor para la popularidad
                return $b[$genre] - $a[$genre];
            } else {
                // Ordena alfabéticamente para el título o género
                return strcmp($a[$genre], $b[$genre]);
            }
        });
    }

    // Lógica del controlador
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        // Verifica si el campo "order" está en la solicitud POST
        if (isset($_POST['order-games']) && $_POST['order-games'] === 'order') {

            // Verifica si el campo "boton" está en la solicitud POST
            if (isset($_POST['boton'])) {
                // Recoge el valor del botón presionado
                $type = $_POST['boton'];    

                // Llama a la función sortGames pasando el array $games y el tipo de juego por referencia
                sortGames($games, $type);

                // Incluye nuevamente la vista para mostrar los juegos ordenados
                include('../view/view.php');
                
                // Termina la ejecución del controlador después de incluir la vista
                exit;

            } else {
                // Si no se ha presionado ningún botón, muestra un mensaje
                echo "No se ha presionado ningún botón.";
            }
        }
    }
?>