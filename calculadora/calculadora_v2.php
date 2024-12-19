<?php
// Calculadora em PHP

enum Operacoes: int{
    case add = 1;
    case sub = 2;
    case mul = 3;
    case div = 4;
}

function reduce(int $operacao, $numeros): float {
    switch($operacao){
        case Operacoes::add->value:
            $resultado = 0;
            break;
        case Operacoes::sub->value:
            $resultado = $numeros[0] * 2;
            break;
        case Operacoes::mul->value:
            $resultado = 1;
            break;
        case Operacoes::div->value:
            $resultado = $numeros[0] ** 2;
    }    
    foreach($numeros as $numero){
        switch($operacao){
            case Operacoes::add->value:
                $resultado += $numero;
                break;
            case Operacoes::sub->value:
                $resultado -= $numero;
                break;
            case Operacoes::mul->value:
                $resultado *= $numero;
                break;
            case Operacoes::div->value:
                $resultado /= $numero;
        }    
    }
    return $resultado;
}

function obter_operacao(): int {
    echo "******************* Calculadora em PHP *******************\n";
    echo "1. Soma\n";
    echo "2. Subtração\n";
    echo "3. Multiplicação\n";
    echo "4. Divisão\n";
    echo "0. Sair\n";
    return (int) readline("Escolha a operação: ");
}

function obter_numeros(): array {
    $lista = [];
    $contador = 1;
    while (true){
        $numero = (int) readline("Numero $contador: ");
        $lista[] = $numero;
        $contador += 1;
        if ($contador > 2){
            $letra = strtoupper(readline("\nMais um número? (S/N): "));
            if ($letra == "N"){
                break;
            }
        }
    }
    return $lista;
}

function calcular($operacao, $numeros): float {
    if ($operacao == 4 && in_array(0,$numeros)){
        echo "\nNão pode dividir por zero\n";
        return 0;
    }
    return reduce($operacao, $numeros);
}

function main(){
    $sair = False;
    while (!$sair){
        $operacao = obter_operacao();
        if ($operacao == 0){
            $sair = True;
            continue;
        }
        if ($operacao < 0 or $operacao > 4){
            echo "\nOperação inválida!\n";
            continue;
        }
        $numeros = obter_numeros();
        echo "\nNúmeros utilizados: " . implode(',',$numeros);
        $resultado = calcular($operacao, $numeros);
        echo "\nO resultado é $resultado\n";
    }
}

main();