<?php
error_reporting(E_ERROR | E_PARSE);

class Enforcado {
    private array $tabuleiro;
    private string $palavra;
    private array $lista_letras_frases;

    public function __construct()
    {
        $this->tabuleiro = [];
        $this->palavra = "";
        $this->lista_letras_frases = [];
    }
        
    public function limpar_tela()
    {
        system(str_contains(PHP_OS,'NT') ? 'cls' :'clear');
        echo "\nBem-vindo(a) ao jogo da forca com o tema filmes!\n";
        echo "Adivinhe o nome do filme abaixo:\n";
    }                    
        
    public function mostrar_enforcado($chances)
    {
        $board = [
<<<BLOCO
=========Enforcado==========

+---+
|   |
    |
    |
    |
    |
=========
BLOCO,
<<<BLOCO

+---+
|   |
O   |
    |
    |
    |
=========
BLOCO,
<<<BLOCO

+---+
|   |
O   |
|   |
    |
    |
=========
BLOCO,
<<<BLOCO

 +---+
 |   |
 O   |
/|   |
     |
     |
=========
BLOCO,
<<<BLOCO

 +---+
 |   |
 O   |
/|\  |
     |
     |
=========
BLOCO,
<<<BLOCO

 +---+
 |   |
 O   |
/|\  |
/    |
     |
=========
BLOCO,
<<<BLOCO

 +---+
 |   |
 O   |
/|\  |
/ \  |
     |
=========
BLOCO
        ];
        return $board[$chances];
    }
   
    public function obter_frases()
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
    
    public function adivinhar_letra()
    {
        $chances = 6;

        $letras_tentativas = [];

        while ($chances > 0){

            $this->mostrar_letra_no_board(6 - $chances);

            echo "\nDigite uma letra: ";
            $tentativa = readline();

            if (in_array($tentativa, $letras_tentativas)){
                echo "Você já tentou essa letra. Escolha outra!";
                continue;
            }

            $letras_tentativas[] = $tentativa;

            if (in_array(strtoupper($tentativa), $this->lista_letras_frases)) {

                echo "\nVocê acertou a letra!\n";

                foreach($this->lista_letras_frases as $indice => $letra){

                    if (strtoupper($letra) == strtoupper($tentativa)){
                        $this->tabuleiro[$indice] = $tentativa;
                    }
                }

                if ($this->venceu()) {
                    break;
                }
            } else {
                echo "\nOps. Essa letra não está no nome do filme!\n";
                $chances -= 1;
            }
        }
    }
	
    public function venceu()
    {
        if (!in_array("_",$this->tabuleiro))
        {
            echo "\nVocê venceu! O nome do filme era: {$this->palavra}\n";
            return true;
        }
        return false;
    }
        
    public function mostrar_letra_no_board($chances)
    {
        echo $this->mostrar_enforcado($chances);
        echo "\nNome do filme: " . implode(' ',$this->tabuleiro) . "\n";
    }
		
    public function imprimir_board()
    {
        $this->limpar_tela();

        $frases = $this->obter_frases();

        $this->palavra = $frases[array_rand($frases,1)];

        for($i=0;$i<strlen($this->palavra);$i++){
            $this->lista_letras_frases[] = strtoupper($this->palavra[$i]);
        }

        $this->tabuleiro = array_fill(0,strlen($this->palavra),"_");

        $this->adivinhar_letra();

        if (in_array("_", $this->tabuleiro)){
            echo "\nVocê perdeu! O nome do filme era: {$this->palavra}\n";
        }
    }
}

$enforcado = new Enforcado();
$enforcado->imprimir_board();
