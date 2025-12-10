// arquivo: dizimo.js

const readline = require('readline');

const rl = readline.createInterface({
  input: process.stdin,
  output: process.stdout
});

rl.question('Informe o valor da renda: ', (rendaStr) => {
  const renda = parseFloat(rendaStr);

  if (isNaN(renda)) {
    console.log('Valor inválido. Digite um número.');
  } else {
    const imposto = renda * 0.10;
    console.log(`O dízimo (10%) é: R$ ${imposto.toFixed(2)}`);
  }

  rl.close();
});
