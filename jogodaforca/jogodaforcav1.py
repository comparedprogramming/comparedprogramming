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
    
def game():
    limpa_tela()

    frases = obter_frases()
    
    frase = random.choice(frases)

    letras_descobertas = ['_' for letra in frase]

    chances = 6

    letras_erradas = []

    while chances > 0:

        print(" ".join(letras_descobertas))
        print("\nChances restantes:", chances)
        print("Letras erradas:", " ".join(letras_erradas))

        tentativa = input("\nDigite uma letra: ").lower()

        if tentativa in frase.lower():
            index = 0
            for letra in frase.lower():
                if tentativa == letra:
                    letras_descobertas[index] = letra
                index += 1
        else:
            chances -= 1
            letras_erradas.append(tentativa)

        if "_" not in letras_descobertas:
            print("\nVocê venceu, o nome do filme era:", frase)
            break
        limpa_tela()

    if "_" in letras_descobertas:
        print("\nVocê perdeu, o nome do filme era:", frase)

if __name__ == "__main__":
    while (True):
        game()
        letra = input("Deseja continuar (S/N)")
        if letra.upper() == 'N':
            print("Até a próxima!")
            break

