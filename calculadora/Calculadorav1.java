// Calculadora em Java

import java.util.ArrayList;
import java.util.List;
import java.util.Scanner;

class Calculadorav1 {

	public float somar(List<Float> lista){
		float soma = 0;
		for(float numero:lista){
			soma += numero;
		}	
		return soma;
	}	
	
	public float subtrair(List<Float> lista){
	float diferenca = lista.get(0) * 2;
	for(float numero:lista){
		diferenca -= numero;
	}
	return diferenca;
}	

	public float multiplicar(List<Float> lista){
		float produto = 1;
		for(float numero:lista){
			produto *= numero;
		}
		return produto;
	}
	
	public float dividir(List <Float> lista){
		float quociente = (float) Math.pow(lista.get(0), 2);
		for(float numero:lista){
			quociente = quociente / numero;
		}	
		return quociente;
	}
	
	public static void main(String[] args) {
		Calculadorav1 calc = new Calculadorav1();
		Scanner keyboard = new Scanner(System.in);
		Float numero;
		int operacao;
		boolean maisnumeros;
		String numeros;
		Float resultado;
		boolean sair = false;
		while (!sair){	
			System.out.println("\n******************* Calculadora em Java *******************\n");
			System.out.println("1. Soma\n");
			System.out.println("2. Subtração\n");
			System.out.println("3. Multiplicação\n");
			System.out.println("4. Divisão\n");
			System.out.println("0. Sair\n");
			System.out.println("Escolha a operação:");
			operacao = keyboard.nextInt();
			if (operacao == 0){
				sair = true;
				continue;
			}
			List<Float> lista = new ArrayList<Float>();
			int contador = 1;
			maisnumeros = true;
			while (maisnumeros){
				System.out.println("Número " + Integer.toString(contador) +  ":" );
				numero = keyboard.nextFloat();
				lista.add(numero);
				contador++;
				char letra = 'S';
				String resposta = "";
				if (contador > 2){
					System.out.println("Mais um número? (S/N)");
					resposta = keyboard.nextLine();
					resposta = keyboard.nextLine();
					resposta = (resposta.length() == 0 ? "N" : resposta);
					letra = resposta.charAt(0);
				}
				if (letra == 'N' || letra == 'n'){
					maisnumeros = false;
				}
			}
			numeros = "";
			for(Float numeroDaLista: lista){
				numeros = numeros + Float.toString(numeroDaLista) + ',';
			}	
			numeros = numeros.substring(0,numeros.length()-1);
			System.out.println(numeros + "\n");
			resultado = (float) 0;
			if (operacao == 1){
				resultado = calc.somar(lista);
			} else if (operacao == 2){
				resultado = calc.subtrair(lista);
			} else if (operacao == 3){
				resultado = calc.multiplicar(lista);
			} else if (operacao == 4){
				Float zero = (float) 0;				
				if (lista.contains(zero)){
					System.out.println("Não pode dividir por zero\n");
				} else {	
					resultado = calc.dividir(lista);
				}	
			} else {
				System.out.println("Operação inválida!\n");
			}
			System.out.println("O resultado é " + Float.toString(resultado)  + "\n");
		}
	}
}