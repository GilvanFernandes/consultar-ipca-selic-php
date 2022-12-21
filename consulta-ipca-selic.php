<?php

// Sua chave de autenticação
$apiKey = 'SUA_CHAVE_DE_AUTENTICACAO';

// Inclui a biblioteca cURL
if (!function_exists('curl_init')) {
  throw new Exception('cURL is not installed');
}

// Inicializa a sessão cURL
$ch = curl_init();

// Configura a URL da API e adiciona a chave de autenticação como cabeçalho da solicitação
curl_setopt($ch, CURLOPT_URL, 'https://api.bcb.gov.br/dados/serie/bcdata.sgs.4390/dados?formato=json');
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Bearer ' . $apiKey));

// Define a função de callback para processar a resposta
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

// Executa a solicitação
$response = curl_exec($ch);

// Converte a resposta em um objeto PHP
$data = json_decode($response);

// Verifica se houve erro na conversão
if (json_last_error() !== JSON_ERROR_NONE) {
  throw new Exception('Error parsing JSON: ' . json_last_error_msg());
}

// Imprime os valores do IPCA e da Selic
echo 'Valor do IPCA: ' . $data->valor . PHP_EOL;
echo 'Valor da Selic: ' . $data->taxa . PHP_EOL;

// Fecha a sessão cURL
curl_close($ch);
