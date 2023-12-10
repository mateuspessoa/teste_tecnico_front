<?php

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Minha Aplicação Marvel</title>
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">

    <!-- Inclua a biblioteca jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
</head>
<body>
    <div class="container-menu">
        <h1><span class="border-bus">BUS</span>CA MARVEL <span class="text-thin">TESTE FRONT-END</span></h1>
        <h1 class="text-name-cadidato">MATEUS PESSOA</h1>
    </div>
    <?php
            function api() {
                $characterId = isset($_GET['id']) ? $_GET['id'] : null;
                $publicKey = '8f0030ef39410d0b6588ca3480857350';
                $privateKey = '8919fc6d26a53ac7f4b88e9a36c1dc43b6db27b5';

                $timestamp = time();
                $hash = md5($timestamp . $privateKey . $publicKey);

                // Monta a URL da API com os parâmetros necessários
                $apiUrl = "https://gateway.marvel.com:443/v1/public/characters/$characterId?ts=$timestamp&limit=25&apikey=$publicKey&hash=$hash";

                // Faz a requisição à API
                $response = file_get_contents($apiUrl);

                // Decodifica a resposta JSON
                $data = json_decode($response);

                // Verifica se a decodificação foi bem-sucedida
                if ($data === NULL) {
                    die('Erro ao decodificar JSON da API');
                }

                foreach($data->data->results as $character) {
                    echo '<div class="container-img-nome-detalhe">';
                        echo '<img src="' . $character->thumbnail->path . '.' . $character->thumbnail->extension . '" alt="' . $character->name . '">';
                        echo '<span>' . $character->name . '</span>';
                    echo '</div>';

                    echo '<div class="container-detalhes">';
                        echo '<div class="esquerda">';
                            echo '<div class="container-serie">';
                                echo '<h1>Todas as Séries</h1>';
                                echo '<div class="container-list-series">';
                                    // Verifica se há séries disponíveis
                                    if (isset($character->series) && isset($character->series->items)) {
                                        foreach ($character->series->items as $serie) {
                                            echo '<h2>' . $serie->name . '</h2>';
                                        }
                                    } else {
                                        echo '<p>Nenhuma série disponível.</p>';
                                    }
                                echo '</div>';

                            echo '</div>';
                            echo '<div class="container-serie">';
                                echo '<h1>Todas os Eventos</h1>';
                                echo '<div class="container-list-series">';
                                    // Verifica se há séries disponíveis
                                    if (isset($character->events) && isset($character->events->items)) {
                                        foreach ($character->events->items as $event) {
                                            echo '<h2>' . $event->name . '</h2>';
                                        }
                                    } else {
                                        echo '<p>Nenhuma série disponível.</p>';
                                    }
                                echo '</div>';
                            echo '</div>';
                            echo '<div class="container-serie">';
                                echo '<h1>Todas as Histórias</h1>';
                                echo '<div class="container-list-series">';
                                    // Verifica se há séries disponíveis
                                    if (isset($character->stories) && isset($character->stories->items)) {
                                        foreach ($character->stories->items as $storie) {
                                            echo '<h2>' . $storie->name . '</h2>';
                                        }
                                    } else {
                                        echo '<p>Nenhuma série disponível.</p>';
                                    }
                                echo '</div>';

                            echo '</div>';
                            echo '<div class="container-serie">';
                                echo '<h1>Histórias em Quadrinhos</h1>';
                                echo '<div class="container-list-series">';
                                    // Verifica se há séries disponíveis
                                    if (isset($character->comics) && isset($character->comics->items)) {
                                        foreach ($character->comics->items as $comic) {
                                            echo '<h2>' . $comic->name . '</h2>';
                                        }
                                    } else {
                                        echo '<p>Nenhuma série disponível.</p>';
                                    }
                                echo '</div>';
                            echo '</div>';
                        echo '</div>';
                        
                }
            }
            api();
        ?>

    <!-- Seu conteúdo HTML aqui -->
    <script src="script.js"></script>
</body>
</html>