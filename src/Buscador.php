<?php

namespace Andre\BuscadorDeCursos;

use GuzzleHttp\ClientInterface;
use Symfony\Component\DomCrawler\Crawler;

class Buscador
{
  /**
  //  * @var ClientInterface
  //  * @var Crawler
   */

    public function __construct(
        private ClientInterface $httpClient,
        private Crawler $crawler
    ) {
    }

    public function buscar(string $url): array
    {
        $resposta = $this->httpClient->request('GET', $url);
        $html = $resposta->getBody();
        $this->crawler->addHtmlContent($html);
        $elementosCursos = $this->crawler->filter('span.card-curso__nome');
        $cursos = [];
        foreach ($elementosCursos as $elemento) {
            $cursos[] = $elemento->textContent;
        }

        return $cursos;
    }
}
