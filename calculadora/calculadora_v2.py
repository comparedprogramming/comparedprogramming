# Calculadora em Python
from functools import reduce
from operator import add, sub, mul, truediv


def obter_operacao():
    print("******************* Calculadora em Python *******************")
    print("1. Soma")
    print("2. Subtração")
    print("3. Multiplicação")
    print("4. Divisão")
    print("0. Sair")
    return int(input("Escolha a operação: "))


def obter_numeros():
    lista = []
    contador = 1
    while True:
        numero = int(input(f"Numero {contador}: "))
        lista.append(numero)
        contador += 1
        if contador > 2:
            letra = input("\nMais um número? (S/N): ").upper()
            if letra == "N":
                break
    return lista


def calcular(operacao, numeros):
    operacoes = {1: add, 2: sub, 3: mul, 4: truediv}
    if operacao == 4 and 0 in numeros:
        print("\nNão pode dividir por zero\n")
        return 0
    return reduce(operacoes[operacao], numeros)


def main():
    sair = False
    while not sair:
        operacao = obter_operacao()
        if operacao == 0:
            sair = True
            continue
        if operacao < 0 or operacao > 4:
            print("\nOperação inválida!\n")
            continue
        numeros = obter_numeros()
        print(f"\nNúmeros utilizados: {', '.join(map(str, numeros))}")
        resultado = calcular(operacao, numeros)
        print(f"\nO resultado é {resultado}\n")


if __name__ == "__main__":
    main()
