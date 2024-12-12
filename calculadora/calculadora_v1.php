<?php
// Calculadora em PHP

function somar(array $lista){
	$soma = 0;
	foreach($lista as $numero){
		$soma += $numero;
	}	
	return $soma;
}	
	
function subtrair(array $lista){
	$diferenca = $lista[0] * 2;
	foreach($lista as $numero){
		$diferenca -= $numero;
	}
	return $diferenca;
}	

function multiplicar(array $lista){
	$produto = 1;
	foreach($lista as $numero){
		$produto *= $numero;
	}
	return $produto;
}
	
function dividir(array $lista){
	$quociente = $lista[0] ** 2;
	foreach ($lista as $numero){
		$quociente = $quociente / $numero;
	}	
	return $quociente;
}	

$sair = False;
while (!$sair){	
	echo "\n******************* Calculadora em PHP *******************\n";
	echo "1. Soma\n";
	echo "2. Subtração\n";
	echo "3. Multiplicação\n";
	echo "4. Divisão\n";
	echo "0. Sair\n";
	$operacao = (int)readline("Escolha a operação:");
	if ($operacao == 0){
		$sair = True;
		continue;
	}
	$lista = [];
	$contador = 1;
	$maisnumeros = True;
	while ($maisnumeros){
		$numero = (int)readline("Numero $contador:");
		$lista[] = (float) $numero;
		$contador++;
		$letra = 'S';
		if ($contador > 2){
			$letra = readline('Mais um número? (S/N)');
		}
		if (strtoupper($letra) == 'N'){
			$maisnumeros = False;
		}
	}
	$numeros = '';
	foreach($lista as $numero){
		$numeros .= $numero . ',';
	}	
	$numeros = substr($numeros,0,-1);
	echo $numeros . "\n";
	$resultado = 0;
	if ($operacao == 1){
		$resultado = somar($lista);
	} else if ($operacao == 2){
		$resultado = subtrair($lista);
	} else if ($operacao == 3){
		$resultado = multiplicar($lista);
	} else if ($operacao == 4){
		if (in_array(0,$lista)){
			echo "Não pode dividir por zero\n";
		} else {	
			$resultado = dividir($lista);
		}	
	} else {
		echo "Operação inválida!\n";
	}
	echo ("O resultado é $resultado\n");
}
