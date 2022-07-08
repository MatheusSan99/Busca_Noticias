<?php

function exibeNoticia(array $noticias)
{
    $pulaLinha = "\n \n";

    echo "Principais notícias de Tecnologia no G1 dia: " . date('d.m.y') . $pulaLinha;

    foreach ($noticias as $noticia) {
        echo $noticia . PHP_EOL;
    }
}
