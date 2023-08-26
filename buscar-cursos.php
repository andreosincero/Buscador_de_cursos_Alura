#!/usr/bin/env php
<?php

//! Composer guarda as dependências e dependências transitivas na pasta vendor do projeto
//! O nome e versão da dependências fica salvo no arquivo composer.json
//! O comando require adiciona automaticamente a dependência no composer.json
//! O comando composer install automaticamente baixa todas as dependências do composer.lock (ou do composer.json, caso o .lock não exista ainda)
//! O arquivo composer.lock define todas as versões exatas instaladas
//! O composer já gera um arquivo autoload.php para facilitar o carregamento das dependências, basta usar require vendor/autoload.php

// Através do flag --dev definimos que uma dependência não faz parte do ambiente de produção
// Caso desejarmos baixar as dependências de "produção" apenas podemos usar o flag no-dev
// Arquivos executáveis fornecidos por componentes instalados pelo composer ficam na pasta vendor/bin
// Conhecemos três ferramentas do mundo PHP:
// phpunit para rodar testes;
// phpcs para verificar padrões de código;
// phan para executar uma análise estática da sintaxe do nosso código.

require_once 'vendor/autoload.php';
// require_once 'src/Buscador.php';

use Andre\BuscadorDeCursos\Buscador;
use GuzzleHttp\Client;
use Symfony\Component\DomCrawler\Crawler;

$client = new Client([
  'base_uri' => 'https://www.alura.com.br/',
  'verify' => false
]);
$crawler = new Crawler();

$buscador = new Buscador($client, $crawler);
$cursos = $buscador->buscar('/cursos-online-programacao/php');

// $html = $resposta->getBody();
// $crawler->addHtmlContent($html);
// $elementosCursos = $crawler->filter('span.card-curso__nome');
// $cursos = [];

foreach ($cursos as $curso) {
    // $cursos[] = $elemento->textContent;
    // echo $elemento->textContent . PHP_EOL;
    echo $curso . PHP_EOL;
}