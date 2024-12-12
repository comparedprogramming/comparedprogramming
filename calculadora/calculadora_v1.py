# Calculadora em Python

def somar(lista):
	soma = 0
	for numero in lista:
		soma = soma + numero
	return soma	
	
def subtrair(lista):
	diferenca = lista[0] * 2
	for numero in lista:
		diferenca = diferenca - numero
	return diferenca

def multiplicar(lista):
	produto = 1
	for numero in lista:
		produto = produto * numero
	return produto
	
def dividir(lista):
	quociente = lista[0] ** 2
	for numero in lista:
		quociente = quociente / numero
	return quociente	

sair = False
while not sair:	
	print("\n******************* Calculadora em Python *******************")
	print("1. Soma")
	print("2. Subtração")
	print("3. Multiplicação")
	print("4. Divisão")
	print("0. Sair")
	operacao = int(input("Escolha a operação:"))
	if operacao == 0:
		sair = True
		continue
	lista = []
	contador = 1
	maisnumeros = True
	while (maisnumeros):
		numero = int(input("Numero " + str(contador) + ":"))
		lista.append(numero)
		contador = contador + 1
		letra = "S"
		if (contador > 2):
			letra = input("Mais um número? (S/N)")
		if letra.upper() == "N":
			maisnumeros = False
	numeros = ""
	for numero in lista:
		numeros = str(numero) + ","
	numeros = numeros[:-1]
	print(numeros)	
	resultado = 0
	if operacao == 1:
		resultado = somar(lista)
	elif operacao == 2:
		resultado = subtrair(lista)
	elif operacao == 3:
		resultado = multiplicar(lista)
	elif operacao == 4:
		if 0 in lista:
			print("Não pode dividir por zero")
		else:	
			resultado = dividir(lista)
	else:
		print("Operação inválida!")
	print("O resultado é " + str(resultado))		


