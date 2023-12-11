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
    <div class="container-input-busca">
        <label>Nome do Personagem</label>
        <input type="text" id="nomePersonagem" oninput="filtrarPersonagens()">
    </div>
    <div class="container-table">
        <table class="table" id="characterTable">
            <thead>
                <tr>
                    <th class="border-1">Personagem</th>
                    <th class="border-2">Séries</th>
                    <th class="apenas-mobile">Eventos</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    function api() {

                        $publicKey = '';
                        $privateKey = '';

                        $timestamp = time();
                        $hash = md5($timestamp . $privateKey . $publicKey);

                        // Monta a URL da API com os parâmetros necessários
                        $apiUrl = "https://gateway.marvel.com:443/v1/public/characters?ts=$timestamp&limit=18&apikey=$publicKey&hash=$hash";

                        // Faz a requisição à API
                        $response = file_get_contents($apiUrl);

                        // Decodifica a resposta JSON
                        $data = json_decode($response);

                        // Verifica se a decodificação foi bem-sucedida
                        if ($data === NULL) {
                            die('Erro ao decodificar JSON da API');
                        }

                        // Imprime os nomes dos produtos na tabela
                        foreach ($data->data->results as $character) {
                            echo '<tr onclick="redirectToDetails(' . $character->id . ')">';

                                // Célula da Imagem e Nome
                                echo '<td class="td-img-nome">';
                                    echo '<img class="img-heroi" src="' . $character->thumbnail->path . '.' . $character->thumbnail->extension . '" alt="' . $character->name . '">';
                                    echo '<span class="nome-heroi">' . $character->name . '</span>';
                                echo '</td>';


                                // Célula das Séries
                                echo '<td class="espaco-extra">';
    
                                    // Verifica se há eventos disponíveis para o personagem
                                    if (isset($character->series) && isset($character->series->items)) {
                                        $series = $character->series->items;

                                        // Limita o número de eventos exibidos a 3
                                        $series = array_slice($series, 0, 3);

                                        // Verifica se há eventos após o corte
                                        if (!empty($series)) {
                                            // Imprime cada nome de evento em uma nova linha
                                            foreach ($series as $serie) {
                                                echo $serie->name . '<br>';
                                            }
                                        } else {
                                            echo 'Nenhuma série disponível';
                                        }
                                    } else {
                                        echo 'Nenhuma série disponível';
                                    }

                                echo '</td>';


                                // Célula dos Eventos
                                echo '<td class="espaco-extra">';
    
                                    // Verifica se há eventos disponíveis para o personagem
                                    if (isset($character->events) && isset($character->events->items)) {
                                        $events = $character->events->items;

                                        // Limita o número de eventos exibidos a 3
                                        $events = array_slice($events, 0, 3);

                                        // Verifica se há eventos após o corte
                                        if (!empty($events)) {
                                            // Imprime cada nome de evento em uma nova linha
                                            foreach ($events as $event) {
                                                echo $event->name . '<br>';
                                            }
                                        } else {
                                            echo 'Nenhum evento disponível';
                                        }
                                    } else {
                                        echo 'Nenhum evento disponível';
                                    }

                                echo '</td>';
                            echo '</tr>';
                        }
                    }

                    // Chama a função para exibir os dados na tabela
                    api();
                    
                    ?>
            </tbody>
        </table>
    </div>
    <div class="container-paginacao">
        
    </div>

    <!-- Seu conteúdo HTML aqui -->
    <script src="script.js"></script>
</body>
</html>