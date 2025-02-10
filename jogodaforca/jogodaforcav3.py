import requests
import warnings
from lxml import html
import random
from os import system, name

class Enforcado:

    def __init__(self):
        self.tabuleiro = []
        self.palavra = ""
        self.lista_letras_frases = []
        
    def limpar_tela(self):
        if name == 'nt':
            _ = system('cls')
        else:
            _ = system('clear')
        print("\nBem-vindo(a) ao jogo da forca com o tema filmes!")
        print("Adivinhe o nome do filme abaixo:\n")            
        
    def mostrar_enforcado(self,chances):
        board = ['''

>>>>>>>>>>Enforcado<<<<<<<<<<

+---+
|   |
    |
    |
    |
    |
=========''', '''

+---+
|   |
O   |
    |
    |
    |
=========''', '''

+---+
|   |
O   |
|   |
    |
    |
=========''', '''

 +---+
 |   |
 O   |
/|   |
     |
     |
=========''', '''

 +---+
 |   |
 O   |
/|\  |
     |
     |
=========''', '''

 +---+
 |   |
 O   |
/|\  |
/    |
     |
=========''', '''

 +---+
 |   |
 O   |
/|\  |
/ \  |
     |
=========''']

        return board[chances]
   
    def obter_frases(self):
        with warnings.catch_warnings():
            warnings.simplefilter("ignore")
            response = requests.get('https://www.adorocinema.com/filmes-todos/',verify=False)
        try:
            content = response.content
            tree = html.fromstring(content)
            movielist = tree.xpath('//h2[@class="meta-title"]/a')
            return [element.text for element in movielist]
        except:
            return ['A volta dos que não foram','Poeira em alto mar','As tranças do vovô careca']   

    def adivinhar_letra(self):
        chances = 6

        letras_tentativas = []

        while chances > 0:

            self.mostrar_letra_no_board(6 - chances)

            tentativa = input("\nDigite uma letra: ")

            if tentativa in letras_tentativas:
                print("Você já tentou essa letra. Escolha outra!")
                continue

            letras_tentativas.append(tentativa)

            if tentativa.capitalize() in self.lista_letras_frases:

                print("Você acertou a letra!")

                for indice in range(len(self.lista_letras_frases)):

                    if self.lista_letras_frases[indice].capitalize() == tentativa.capitalize():
                        self.tabuleiro[indice] = tentativa

                if self.venceu():
                    break
            else:
                print("Ops. Essa letra não está no nome do filme!")
                chances -= 1
	
    def venceu(self):
        if "_" not in self.tabuleiro:
            print("\nVocê venceu! O nome do filme era: {}".format(self.palavra))
            return True
        return False
        
    def mostrar_letra_no_board(self,chances):
        print(self.mostrar_enforcado(chances))
        print("Nome do filme: ", self.tabuleiro)
        print("\n")
		
    def imprimir_board(self):
        self.limpar_tela()

        frases = self.obter_frases()

        self.palavra = random.choice(frases)

        self.lista_letras_frases = [letra.capitalize() for letra in self.palavra]

        self.tabuleiro = ["_"] * len(self.palavra)

        self.adivinhar_letra()

        if "_" in self.tabuleiro:
            print("\nVocê perdeu! O nome do filme era: {}.".format(self.palavra))           
         
if __name__ == "__main__":
    enforcado = Enforcado()
    enforcado.imprimir_board()
