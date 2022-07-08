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
        $resposta = $this->httpClient->request('GET', $url);
        $html = $resposta->getBody();

        $this->crawler->addHtmlContent($html);
        $noticiasDoDia = $this->crawler->filter('a.feed-post-link');
        $arrayDeNoticias = [];

        foreach ($noticiasDoDia as $noticias) {
            $arrayDeNoticias[] = $noticias->textContent;
        }
        return $arrayDeNoticias;
    }
}
