
# Consulta IPCA e Selic com Banco Central do Brasil

Para consultar os valores do IPCA (Índice Nacional de Preços ao Consumidor Amplo) e da Selic (taxa básica de juros da economia brasileira) através de um script em PHP, você pode utilizar a API (Application Programming Interface, ou Interface de Programação de Aplicativos) do Banco Central do Brasil. A API fornece acesso aos dados oficiais e atualizados desses índices, além de outras informações econômicas.

Para começar, é preciso ter em mente que a API do Banco Central do Brasil é restrita e precisa ser acessada com uma chave de autenticação. Você pode obter essa chave de autenticação no site do Banco Central, na seção "Ferramentas > API BCB > Solicitação de chave de autenticação": https://www.bcb.gov.br/api/explorer/swagger-ui.html#!/Solicita%C3%A7%C3%A3o%20de%20chave%20de%20autentica%C3%A7%C3%A3o/post_1

Com a chave de autenticação em mãos, você pode começar a escrever o seu script em PHP. Primeiro, você precisará incluir a biblioteca cURL (Client URL Library, ou Biblioteca de URLs de Cliente) para realizar as chamadas HTTP à API do Banco Central. Em seguida, você pode usar a função curl_exec() para enviar uma solicitação GET à API e obter os dados de resposta em formato JSON.

Aqui está um exemplo de como o seu script poderia ficar:
## Funcionalidades

- Valor de IPCA (Índice Nacional de Preços ao Consumidor Amplo)
- Valor da Selic (taxa básica de juros da economia brasileira)



## Entendendo o Script

Clone o projeto
```bash
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

```

## Feedback

Se você tiver algum feedback, por favor nos deixe saber por meio do instagram https://www.instagram.com/ogilvanfernandes/


## Autor

- [@GilvanFernandes](https://www.github.com/GilvanFernandes)


## Referência

 - [Banco Central do Brasil](https://www.bcb.gov.br/)

## Contribuindo

Contribuições são sempre bem-vindas!

- Faça um fork do projeto
- Após a modificação faça um pull request ao projeto