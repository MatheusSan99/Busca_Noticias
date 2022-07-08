<?php
require_once 'vendor/autoload.php';

use Matheus\BuscadorDeNoticias\Buscador;
use GuzzleHttp\Client;
use Symfony\Component\DomCrawler\Crawler;

$client = new Client(['verify' => false]);
$crawler = new Crawler();

$buscador = new Buscador($client, $crawler);


try {
    $noticias = $buscador->buscar('https://g1.globo.com/tecnologia/');
    exibeNoticia($noticias);
} catch (Throwable $erro) {
    echo 'Desculpe, ocorreu algum erro! Informe ao administrador sobre o código do erro a seguir:' . PHP_EOL;
    echo "Codigo do erro: " . $erro->getCode();
}
