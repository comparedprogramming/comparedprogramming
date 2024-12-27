<?php
error_reporting(E_ERROR | E_PARSE);

function obter_frases()
{
    @$response = file_get_contents('https://www.adorocinema.com/filmes-todos/');
    try {
        $doc = new DOMDocument();
        $doc->loadHTML($response);
        $xpath = new DOMXpath($doc);
        $elements = $xpath->query('//h2[@class="meta-title"]/a');
        $movielist = [];
        foreach($elements as $element)
        {
            $movielist[] = $element->nodeValue;
        }
        return $movielist;
        
    } catch (Exception $e) {
        return ['A volta dos que não foram','Poeira em alto mar','As tranças do vovô careca'];
    }
}

function limpa_tela()
{
    system(str_contains(PHP_OS,'NT') ? 'cls' :'clear');
    echo "\nBem-vindo(a) ao jogo da forca com o tema filmes!\n";
    echo "\nAdivinhe o nome do filme abaixo:\n";
}
    
function game()
{
    limpa_tela();

    $frases = obter_frases();
    
    $frase = $frases[array_rand($frases,1)];

    $letras_descobertas = array_fill(0,strlen($frase),'_');

    $chances = 6;

    $letras_erradas = [];

    while ($chances > 0) {
        echo implode(' ', $letras_descobertas) . "\n";
        echo "\nChances restantes: " . $chances;
        echo "\nLetras erradas: " . implode(' ',$letras_erradas) . "\n";

        $tentativa = strtolower(readline("Digite uma letra: "));

        if (str_contains(strtolower($frase),$tentativa)){
            for($index = 0;$index<strlen($frase);$index++) {
                $letra = strtolower($frase[$index]);
                if ($tentativa == $letra){
                    $letras_descobertas[$index] = $letra;
                }
            }
        } else {
            $chances -= 1;
            $letras_erradas[] = $tentativa;
        }

        if (array_search('_', $letras_descobertas) === false){
            echo "\nVocê venceu, o nome do filme era:" . $frase . "\n";
            break;
        }
        limpa_tela();
    }

    if (array_search('_', $letras_descobertas) !== false){
        echo "\nVocê perdeu, o nome do filme era:" . $frase . "\n";
    }
}

while (True){
    game();
    $letra = readline("Deseja continuar (S/N)");
    if (strtoupper($letra) == 'N')
    {
        echo "Até a próxima!\n";
        break;
    }
}