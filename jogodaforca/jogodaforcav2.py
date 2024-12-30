import random
import requests
import warnings
from lxml import html
from os import system, name

def obter_frases():
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

def limpa_tela():
    system('cls' if name == 'nt' else 'clear')
    print("\nBem-vindo(a) ao jogo da forca com o tema filmes!")
    print("Adivinhe o nome do filme abaixo:\n")

def mostra_enforcado(chances):
    base =  """
                   --------
                   |      |"""

    estagios = [  # estágio 6 (final)
                """
                   |      O
                   |    ==|==
                   |      |
                   |     / \\
                   -
                """,
                # estágio 5
                """
                   |      O
                   |    ==|==
                   |      |
                   |     / 
                   -
                """,
                # estágio 4
                """
                   |      O
                   |    ==|==
                   |      |
                   |      
                   -
                """,
                # estágio 3
                """
                   |      O
                   |    ==|
                   |      |
                   |     
                   -
                """,
                # estágio 2
                """
                   |      O
                   |      |
                   |      |
                   |     
                   -
                """,
                # estágio 1
                """
                   |      O
                   |    
                   |      
                   |     
                   -
                """,
                # estágio 0
                """
                   |      
                   |    
                   |      
                   |     
                   -
                """
    ]
    return base + estagios[chances]

# Função do jogo
def game():

    limpa_tela()
    
    frases = obter_frases()
    
    frase = random.choice(frases)
    
    lista_letras_frases = [letra for letra in frase]
    
    tabuleiro = ["_"] * len(frase)
    
    chances = 6
    
    letras_tentativas = []
    
    while chances > 0:
        
        print(mostra_enforcado(chances))
        print("Nome do filme: ", tabuleiro)
        print("\n")
        
        tentativa = input("\nDigite uma letra: ").lower()
        
        if tentativa in letras_tentativas:
            print("Você já tentou essa letra. Escolha outra!")
            continue
        
        letras_tentativas.append(tentativa)
        
        if tentativa in frase.lower():
            
            print("Você acertou a letra!")
            
            for indice in range(len(lista_letras_frases)):

                if lista_letras_frases[indice].lower() == tentativa:
                    tabuleiro[indice] = tentativa
            
            if "_" not in tabuleiro:
                print("\nVocê venceu! O nome do filme era: {}".format(frase))
                break
        else:
            print("Ops. Essa letra não está no nome do filme!")
            chances -= 1
        limpa_tela()
    
    if "_" in tabuleiro:
        print(mostra_enforcado(0))
        print("Suas tentativas: ", tabuleiro)
        print("\nVocê perdeu! O nome do filme era: {}.".format(frase))

if __name__ == "__main__":
    while (True):
        game()
        letra = input("Deseja continuar (S/N)")
        if letra.upper() == 'N':
            print("Até a próxima!")
            break