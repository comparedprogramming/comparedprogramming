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

function mostra_enforcado($chances)
{
    $base =  <<<BLOCO
    --------
    |      |
BLOCO;

    $estagios = [  # estágio 6 (final)
<<<BLOCO
    |      O
    |    ==|==
    |      |
    |     / \\
    -
BLOCO,
# estágio 5
<<<BLOCO
    |      O
    |    ==|==
    |      |
    |     / 
    -
BLOCO,
# estágio 4
<<<BLOCO
    |      O
    |    ==|==
    |      |
    |
    -
BLOCO,
# estágio 3
<<<BLOCO
    |      O
    |    ==|
    |      |
    |
    -
BLOCO,
# estágio 2
<<<BLOCO
    |      O
    |      |
    |      |
    |
    -
BLOCO,
# estágio 1
<<<BLOCO
    |      O
    |
    |
    |
    -
BLOCO,
# estágio 0
<<<BLOCO
    |
    |
    |
    |
    -
BLOCO
    ];
    return $base . "\n" . $estagios[$chances];
}

function game()
{
    limpa_tela();
    
    $frases = obter_frases();
    
    $frase = trim($frases[array_rand($frases,1)]);
    
    $lista_letras_frases = mb_str_split($frase);
    
    $tabuleiro = array_fill(0,count($lista_letras_frases),'_');
    
    $chances = 6;
    
    $letras_tentativas = [];
    
    while ($chances > 0){
        echo mostra_enforcado($chances) . "\n";
        echo 'Nome do filme: ' . implode(' ', $tabuleiro) . "\n";
        echo "\n";
        
        $tentativa = strtolower(readline("Digite uma letra: "));
        
        if (in_array($tentativa,$letras_tentativas)){
            echo "Você já tentou essa letra. Escolha outra!\n";
            continue;
        }
        
        $letras_tentativas[] = $tentativa;
        
        limpa_tela();
        if (str_contains(strtolower($frase),$tentativa)){
            
            echo "Você acertou a letra!\n";
            
            for ($indice = 0; $indice < count($lista_letras_frases); $indice++){
                if (strtolower($lista_letras_frases[$indice]) == $tentativa){
                    $tabuleiro[$indice] = $tentativa;
                }
            }
            if (!in_array('_',$tabuleiro)){
                echo "\nVocê venceu! O nome do filme era: $frase\n";
                break;
            }
        } else {
            echo "Ops. Essa letra não está no nome do filme!\n";
            $chances -= 1;
        }
    }
    
    if (in_array("_", $tabuleiro)){
        echo mostra_enforcado(0) . "\n";
        echo 'Suas tentativas: ' . implode($tabuleiro) . "\n";
        echo "\nVocê perdeu! O nome do filme era: $frase\n";
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