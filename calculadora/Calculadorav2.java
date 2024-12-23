// Calculadora em Java

import java.util.ArrayList;
import java.util.List;
import java.util.Scanner;

public class Calculadorav2 {
    public static final int ADD = 1;
    public static final int SUB = 2;
    public static final int MUL = 3;
    public static final int DIV = 4;
    private Scanner keyboard;

    public Calculadorav2()
    {
        keyboard = new Scanner(System.in);
    }

    List<String> floatToStrList(List<Float> oldList)
    {
        List<String> newList = new ArrayList<String>();
        for(Float numero: oldList){
            newList.add(Float.toString(numero));
        }
        return newList;
    }

    float reduce(int operacao, List<Float> numeros) {
        float resultado = 0;
        switch(operacao){
            case ADD:
                resultado = 0;
                break;
            case SUB:
                resultado = numeros.get(0) * 2;
                break;
            case MUL:
                resultado = 1;
                break;
            case DIV:
                resultado = (float) Math.pow(numeros.get(0),2);
        }    
        for(Float numero: numeros){
            switch(operacao){
                case ADD:
                    resultado += numero;
                    break;
                case SUB:
                    resultado -= numero;
                    break;
                case MUL:
                    resultado *= numero;
                    break;
                case DIV:
                    resultado /= numero;
            }    
        }
        return resultado;
    }
    
    int obter_operacao() {
        System.out.println("******************* Calculadora em PHP *******************");
        System.out.println("1. Soma");
        System.out.println("2. Subtração");
        System.out.println("3. Multiplicação");
        System.out.println("4. Divisão");
        System.out.println("0. Sair");
        System.out.println("Escolha a operação:");
        int operacao = keyboard.nextInt();
        return operacao;
    }
    
    List<Float> obter_numeros() {
        List<Float> lista = new ArrayList<Float>();
        int contador = 1;
        float numero;
        String letra;
        while (true){
            System.out.println("Numero " + Integer.toString(contador) + " : ");
            numero = keyboard.nextFloat();
            lista.add(numero);
            contador += 1;
            if (contador > 2){
                System.out.println("Mais um número? (S/N): ");
                letra = keyboard.nextLine();
                letra = keyboard.nextLine();
                if (letra.equalsIgnoreCase("N")){
                    break;
                }
            }
        }
        return lista;
    }
    
    float calcular(int operacao, List<Float> numeros) {
        if (operacao == 4 && numeros.contains((float)0)){
            System.out.println("Não pode dividir por zero");
            return 0;
        }
        return reduce(operacao, numeros);
    }
    
    public static void main(String args[]){
        boolean sair = false;
        int operacao;
        List<Float> numeros;
        Calculadorav2 calc = new Calculadorav2();
        while (!sair){
            operacao = calc.obter_operacao();
            if (operacao == 0){
                sair = true;
                continue;
            }
            if (operacao < 0 || operacao > 4){
                System.out.println("Operação inválida!");
                continue;
            }
            numeros = calc.obter_numeros();
            System.out.println("Números utilizados: " + String.join(",",calc.floatToStrList(numeros)));
            float resultado = calc.calcular(operacao, numeros);
            System.out.println("O resultado é " + Float.toString(resultado));
        }
        calc.keyboard.close();
    }
}

