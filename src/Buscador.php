<?php

namespace Matheus\BuscadorDeNoticias;

use GuzzleHttp\Client;
use Symfony\Component\DomCrawler\Crawler;

class Buscador
{
    private $httpClient;
    private $crawler;

    public function __construct(Client $httpClient, Crawler $crawler)
    {
        $this->httpClient = $httpClient;
        $this->crawler = $crawler;
    }

    public function buscar(string $url): array
    {
        //fazer a requisição a url
        $resposta = $this->httpClient->request('GET', $url);
        //exibir o corpo da pagina em html
        $html = $resposta->getBody();

        $this->crawler->addHtmlContent($html);
        //filtrar os dados a partir do crowler para pegar as noticias
        $noticiasDoDia = $this->crawler->filter('a.feed-post-link');
        $arrayDeNoticias = [];

        foreach ($noticiasDoDia as $noticias) {
            $arrayDeNoticias[] = $noticias->textContent;
        }
        return $arrayDeNoticias;
    }
}
