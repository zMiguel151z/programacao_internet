<?php
// Questão 20 — Sistema de votação
// Considere os candidatos e os votos abaixo. Os números 10, 20 e 30 correspondem aos
// candidatos cadastrados. Qualquer outro número deve ser considerado voto nulo.
// Desenvolva um programa que percorra os votos e determine os resultados da eleição.
// $candidatos = [
// ["numero" => 10, "nome" => "Ana", "votos" => 0],
// ["numero" => 20, "nome" => "Carlos", "votos" => 0],
// ["numero" => 30, "nome" => "Maria", "votos" => 0]
// ];
// $votos = [10, 20, 10, 30, 30, 30, 20, 10, 50, 30, 20, 30, 50, 10];

// Lista de Exercícios – PHP

// ● quantidade de votos de cada candidato;
// ● quantidade de votos nulos;
// ● total de votos válidos;
// ● total geral de votos;
// ● percentual de votos de cada candidato considerando apenas os votos válidos;
// ● candidato vencedor.
// Desafio: O código deve encontrar o vencedor automaticamente, sem criar um if específico para
// Ana, Carlos ou Maria.

echo "QUESTAO 20\n";

$candidatos = [
    ["numero" => 10, "nome" => "Ana", "votos" => 0],
    ["numero" => 20, "nome" => "Carlos", "votos" => 0],
    ["numero" => 30, "nome" => "Maria", "votos" => 0]
];
$votos = [10, 20, 10, 30, 30, 30, 20, 10, 50, 30, 20, 30, 50, 10];

for ($contador = 0; $contador < count($votos); $contador++) {
    if ($votos[$contador] == 10) {
        $candidatos[0]['votos']++;
    } elseif ($votos[$contador] == 20) {
        $candidatos[1]['votos']++;
    } elseif ($votos[$contador] == 30) {
        $candidatos[2]['votos']++;
    }
}

$frequencia = array_count_values($votos);

$mais_Fr = array_search(max($frequencia), $frequencia);
$total = 0;
$nulos = 0;

for ($i = 0; $i <= 2; $i++) {
    echo "candidatos : " . $candidatos[$i]["nome"] . " votos : " . $candidatos[$i]["votos"];
    echo "\n";
}

for ($i = 0; $i <= 2; $i++) {

    $total += $candidatos[$i]["votos"];
}
echo "total de votos válidos :" . $total . "\n";

echo "total geral de votos: " . count($votos) . "\n";

for ($contador = 0; $contador < count($votos); $contador++) {
    if ($votos[$contador] != 10 && $votos[$contador] != 20 && $votos[$contador] != 30) {
        $nulos++;
    }
}

echo "total de votos nulos: " . $nulos;
echo "\n";

for ($i = 0; $i <= 2; $i++) {
    $porcentagem = ($candidatos[$i]["votos"] / $total) * 100;
    echo "candidatos : " . $candidatos[$i]["nome"] . "  " . $porcentagem . "%";
    echo "\n";
}

for ($i = 0; $i <= 2; $i++) {
    if ($candidatos[$i]["numero"] == $mais_Fr) {
        echo "vencedor :" . $candidatos[$i]["nome"] . "\n";
    }
}

echo "\n";
echo "\n";
echo "\n";

echo "QUESTAO 19\n";

// Questão 19 — Carrinho de compras
// Crie uma classe Produto contendo nome, preco e quantidade. Depois, crie um vetor contendo pelo
// menos 5 produtos diferentes.
// Calcule o subtotal de cada produto (preço x quantidade), o valor total da compra e aplique as
// regras de desconto abaixo.
// Até R$ 200 -> sem desconto
// De R$ 200,01 até R$ 500 -> 5% de desconto
// De R$ 500,01 até R$ 1000 -> 10% de desconto
// Acima de R$ 1000 -> 15% de desconto
// ● exiba cada produto, quantidade, preço unitário e subtotal;
// ● exiba o valor da compra sem desconto;
// ● exiba o percentual de desconto;
// ● exiba o valor economizado;
// ● exiba o valor final da compra.
// Desafio: Informe qual produto representa o maior gasto dentro do carrinho.


class Produtos
{
    public string $nome;
    public float $preco;
    public int $quantidade;

    public function __construct(string $nome, float $preco, int $quantidade)
    {
        $this->nome = $nome;
        $this->preco = $preco;
        $this->quantidade = $quantidade;
    }
}

$carrinho = [
    new Produtos("arroz", 7, 5),
    new Produtos("cuscuz", 2, 8),
    new Produtos("miojo", 4, 6),
    new Produtos("cola", 25, 25),
    new Produtos("lapis", 20, 16)
];

$valor_Total = 0;
$mais_caro = null;
$valor_Caro = 0;
$desconto = 0;


for ($contador = 0; $contador < count($carrinho); $contador++) {

    $valor = ($carrinho[$contador]->preco) * ($carrinho[$contador]->quantidade);
    echo "Nome: " . $carrinho[$contador]->nome;
    echo ": Quantidade: " . $carrinho[$contador]->quantidade;
    echo ": Preço: " . $carrinho[$contador]->preco;
    echo ": total: " . $valor . "\n";
}

for ($contador = 0; $contador < count($carrinho); $contador++) {

    $valor = ($carrinho[$contador]->preco) * ($carrinho[$contador]->quantidade);

    if ($valor > $valor_Caro) {
        $mais_caro = $carrinho[$contador];
        $valor_Caro = $valor;
    }

    $valor_Total += ($carrinho[$contador]->preco) * ($carrinho[$contador]->quantidade);
}

echo "valor total sem Desconto:" . $valor_Total . "\n";

if ($valor_Total > 200 && $valor_Total < 501) {
    $desconto = ($valor_Total * 5) / 100;
    echo "percentual de desconto: 5%\n";
} elseif ($valor_Total > 500 && $valor_Total < 1001) {
    $desconto = ($valor_Total * 10) / 100;
    echo "percentual de desconto: 10%\n";
} elseif ($valor_Total > 1000) {
    $desconto = ($valor_Total * 15) / 100;
    echo "percentual de desconto: 15%\n";
} else {
    echo "sem desconto para essa comprar" . "\n";;
}

echo "valor economizado:" . $desconto . "\n";
echo "valor final:" . ($valor_Total - $desconto) . "\n";


echo "Produto mais caro:" . $mais_caro->nome . "\n";;



echo "\n";
echo "\n";
echo "\n";


echo "QUESTAO 18\n";

// Questão 18 — Objetos: funcionários
// Crie uma classe Funcionario contendo os atributos nome, salario e cargo.
// Depois, crie pelo menos 5 objetos e armazene-os em um vetor.
// Percorra o vetor, exiba os dados, calcule a média salarial, descubra o maior e o menor salário e
// conte quantos funcionários recebem acima da média.
// Em seguida, aplique os aumentos abaixo e exiba o salário antigo e o novo salário de cada
// funcionário.
// Salário abaixo de R$ 2.000 -> aumento de 15%
// Salário entre R$ 2.000 e R$ 5.000 -> aumento de 10%
// Salário acima de R$ 5.000 -> aumento de 5%

function Aumentos(float $salario)
{
    if ($salario < 2000) {
        return $salario * 1.15;
    } elseif ($salario >= 2000 && $salario <= 5000) {
        return $salario * 1.10;
    } elseif ($salario > 5000) {
        return $salario * 1.05;
    }
}

class Funcionario
{
    public string $nome;
    public float $salario;
    public string $cargo;

    public function __construct(string $nome, float $salario, string $cargo)
    {
        $this->nome = $nome;
        $this->salario = $salario;
        $this->cargo = $cargo;
    }
}

$soma_salarios = 0;
$maior_salario = null;
$menor_salario = null;
$maiores_salarios = 0;


$funcionarios = [
    new Funcionario("Ana Silva", 3500.00, "Analista"),
    new Funcionario("Bruno Costa", 2200.50, "Auxiliar"),
    new Funcionario("Carla Souza", 5800.00, "Gerente"),
    new Funcionario("Diego Lima", 1800.00, "Estagiário"),
    new Funcionario("Elaine Reis", 4200.75, "Coordenadora"),
];

for ($contador = 0; $contador < count($funcionarios); $contador++) {
    $salario = 0;
    echo "Nome: " . $funcionarios[$contador]->nome;
    echo " | Cargo: " . $funcionarios[$contador]->cargo;
    echo " | Salário Antigo: R$" . $funcionarios[$contador]->salario;
    echo " | Salário com Aumento: R$" . round(Aumentos($funcionarios[$contador]->salario), 2) . "\n";

    $soma_salarios += $funcionarios[$contador]->salario;
    $salario = $funcionarios[$contador]->salario;



    if ($maior_salario == null || $salario > $maior_salario) {
        $maior_salario = $salario;
    }
    if ($menor_salario == null || $salario < $menor_salario) {
        $menor_salario = $salario;
    }
}

for ($contador = 0; $contador < count($funcionarios); $contador++) {
    $salario = $funcionarios[$contador]->salario;
    if ($salario > ($soma_salarios / count($funcionarios))) {
        $maiores_salarios++;
    }
}

echo "Média salarial : " . round($soma_salarios / count($funcionarios), 2) . "\n";
echo "Maior Salario " . $maior_salario;
echo "\n";
echo "Menor Salario " . $menor_salario;
echo "\n";
echo "Funcionários que recebem acima da média : " . $maiores_salarios;




echo "\n";
echo "\n";
echo "\n";

echo "QUESTAO 17\n";



// Questão 17 — Campeonato
// Considere os times abaixo. Vitória vale 3 pontos, empate vale 1 ponto e derrota vale 0 pontos.
// Calcule a pontuação de cada time e descubra as informações solicitadas.
// $times = [
// ["nome" => "Time A", "vitorias" => 5, "empates" => 2, "derrotas" => 1],
// ["nome" => "Time B", "vitorias" => 4, "empates" => 4, "derrotas" => 0],
// ["nome" => "Time C", "vitorias" => 6, "empates" => 0, "derrotas" => 2],
// ["nome" => "Time D", "vitorias" => 3, "empates" => 3, "derrotas" => 2]
// ];
// ● qual time possui mais pontos;
// ● qual possui menos pontos;
// ● qual possui mais vitórias;
// ● quantos pontos existem somando todos os times.

// Desafio: Em caso de empate na pontuação, utilize o número de vitórias como critério de
// desempate.

$times = [
    ["nome" => "Time A", "vitorias" => 5, "empates" => 2, "derrotas" => 1],
    ["nome" => "Time B", "vitorias" => 4, "empates" => 4, "derrotas" => 0],
    ["nome" => "Time C", "vitorias" => 6, "empates" => 0, "derrotas" => 2],
    ["nome" => "Time D", "vitorias" => 3, "empates" => 3, "derrotas" => 2]
];

$dados = [];

foreach ($times as $time) {
    $pontos = ($time["vitorias"] * 3) + $time["empates"];
    $dados[] = [
        "nome" => $time["nome"],
        "pontos" => $pontos,
        "vitorias" => $time["vitorias"]
    ];
}

$vencedor = null;
$perdedor = null;
$maisVitorias = null;
$total_pontos = 0;

foreach ($dados as $time) {

    if (
        $vencedor === null ||
        $time["pontos"] > $vencedor["pontos"] ||
        ($time["pontos"] == $vencedor["pontos"] && $time["vitorias"] > $vencedor["vitorias"])
    ) {
        $vencedor = $time;
    }


    if ($perdedor === null || $time["pontos"] < $perdedor["pontos"]) {
        $perdedor = $time;
    }


    if ($maisVitorias === null || $time["vitorias"] > $maisVitorias["vitorias"]) {
        $maisVitorias = $time;
    }

    $total_pontos += $time["pontos"];

    echo "Nome:" . $time["nome"];
    echo " | Pontos:" . $time["pontos"];
    echo "\n";
}

echo "Time com mais pontos: " . $vencedor["nome"] . " (" . $vencedor["pontos"] . " pts, " . $vencedor["vitorias"] . " vitórias)\n";
echo "Time com menos pontos: " . $perdedor["nome"] . " (" . $perdedor["pontos"] . " pts)\n";
echo "Time com mais vitórias: " . $maisVitorias["nome"] . " (" . $maisVitorias["vitorias"] . " vitórias)\n";
echo "Total de pontos somando todos os times: " . $total_pontos . "\n";





echo "\n";
echo "\n";
echo "\n";

echo "QUESTAO 16\n";


// Questão 16 — Controle de estoque
// Considere o vetor de produtos abaixo. Percorra os produtos e realize as operações solicitadas.
// $produtos = [
// ["nome" => "Teclado", "preco" => 120, "quantidade" => 5],
// ["nome" => "Mouse", "preco" => 60, "quantidade" => 0],
// ["nome" => "Monitor", "preco" => 900, "quantidade" => 3],
// ["nome" => "Cabo HDMI", "preco" => 35, "quantidade" => 10],
// ["nome" => "Headset", "preco" => 250, "quantidade" => 2]
// ];
// ● exiba somente os produtos disponíveis;
// ● informe quais produtos estão sem estoque;
// ● calcule o valor total de cada produto em estoque (preço x quantidade);
// ● calcule o valor total de todo o estoque;
// ● informe qual produto representa o maior valor financeiro no estoque.

$produtos = [
    ["nome" => "Teclado", "preco" => 120, "quantidade" => 5],
    ["nome" => "Mouse", "preco" => 60, "quantidade" => 0],
    ["nome" => "Monitor", "preco" => 900, "quantidade" => 3],
    ["nome" => "Cabo HDMI", "preco" => 35, "quantidade" => 10],
    ["nome" => "Headset", "preco" => 250, "quantidade" => 2]
];


$valor_Total = 0;
$produto_caro = null;
$valor = 0;


echo "-----------Estoque---------\n";
echo "-----------produtos---------\n";
foreach ($produtos as $indice => $produto) {

    if ($produto["quantidade"] > 0) {
        echo "Nome: " . $produto["nome"] . "\n";
        echo " | Preco: " . $produto["preco"] . "\n";
        echo " | Quantidade: " . $produto["quantidade"] . "\n";
    }

    if ($produto["quantidade"] === 0) {
        echo "-----------produto sem estoque---------\n";
        echo "Nome: " . $produto["nome"] . "\n";
        echo " | Quantidade: " . $produto["quantidade"] . "\n";
        echo "---------------------------------------\n";
    }
    
    elseif ($produto["quantidade"] > 0) {
        $valor_Total += ($produto["quantidade"] * $produto["preco"]);
    }

    elseif ($produto_caro === null || ($produto_caro["quantidade"] * $produto_caro["preco"]) < ($produto["quantidade"] * $produto["preco"])) {
        $produto_caro = $produto;
    }

    else{
        echo "\n deu errado \n";
    }
}


echo "\nvalor total de cada produto em estoque : " . $valor_Total;

echo "\nProduto mais caro: " . $produto_caro["nome"] . "\n";
echo "----------------------------------------\n";

echo "\n";
echo "\n";
echo "\n";




echo "QUESTAO 15\n";



// Questão 15 — Sistema de alunos
// Considere o vetor de alunos abaixo. Para cada aluno, calcule sua média, exiba nome e média e
// classifique-o como Aprovado (média >= 6) ou Reprovado (média < 6).
// Ao final, informe o aluno com maior média, o aluno com menor média e a média geral da turma.
// $alunos = [
// ["nome" => "Ana", "nota1" => 8.0, "nota2" => 7.0],
// ["nome" => "Carlos", "nota1" => 5.0, "nota2" => 4.5],
// ["nome" => "Maria", "nota1" => 9.0, "nota2" => 9.5],
// ["nome" => "João", "nota1" => 6.0, "nota2" => 5.0],
// ["nome" => "Pedro", "nota1" => 3.0, "nota2" => 7.0]
// ];


$alunos = [
    ["nome" => "Ana", "nota1" => 8.0, "nota2" => 7.0],
    ["nome" => "Carlos", "nota1" => 5.0, "nota2" => 4.5],
    ["nome" => "Maria", "nota1" => 9.0, "nota2" => 9.5],
    ["nome" => "João", "nota1" => 6.0, "nota2" => 5.0],
    ["nome" => "Pedro", "nota1" => 3.0, "nota2" => 7.0]
];

$media_Total = 0;
$media_Maior = null;
$media_Menor = null;

foreach ($alunos as $aluno) {
    $media = ($aluno["nota1"] + $aluno["nota2"]) / 2;
    echo "Nome: " . $aluno["nome"];
    echo " | Media: " . $media;

    $media_Total += $media;

    if ($media >= 6) {
        echo " | Status:Aprovado\n";
    } else {
        echo " | Status:Reprovado\n";
    }

    echo "\n";

    if ($media_Maior === null || $media_Maior < $media) {
        $media_Maior = $media;
    }
    if ($media_Menor === null || $media_Menor > $media) {
        $media_Menor = $media;
    }
}

echo "Media total:" . $media_Total / count($alunos) . "\n";
echo "Maior media:" . $media_Maior . "\n";
echo "Menor media:" . $media_Menor . "\n";



echo "\n";
echo "\n";
echo "\n";



echo "QUESTAO 14\n";


// Questão 14 — Frequência de números
// Considere o vetor abaixo. Crie um programa que informe quantas vezes cada número aparece.
// Evite imprimir o mesmo número mais de uma vez.
// $numeros = [2, 5, 2, 8, 5, 2, 10, 8, 5, 5];
// 2 aparece 3 vezes
// 5 aparece 4 vezes
// 8 aparece 2 vezes
// 10 aparece 1 vez


$numeros = [2, 5, 2, 8, 5, 2, 10, 8, 5, 5];

$contagens = [];


foreach ($numeros as $numero) {
    $repetido = false;

    foreach ($contagens as $contagem) {
        if ($numero === $contagem) {
            $repetido = true;
            break;
        }
    }

    if ($repetido) {
        continue;
    }

    $count = 0;

    foreach ($numeros as $numero2) {
        if ($numero === $numero2) {
            $count++;
        }
    }

    echo $numero . " Aparece " . $count . " vezes\n";

    $contagens[] = $numero;
}

echo "\n";
echo "\n";
echo "\n";

echo "QUESTAO 13\n";

// Questão 13 — Segundo maior número
// Considere o vetor abaixo. Desenvolva um algoritmo que encontre o segundo maior número do
// vetor.
// $numeros = [15, 8, 35, 42, 11, 27, 39];
// Maior número: 42
// Segundo maior: 39
// Desafio: Não utilize sort(), rsort() ou funções semelhantes.

$numeros = [50, 8, 35, 42, 11, 27, 39];

$maior = null;
$segundo_maior = 0;


foreach ($numeros as $numero) {
    if ($maior === null || $maior < $numero) {
        $maior = $numero;
    }

    if ($segundo_maior === null || $segundo_maior < $numero && $numero < $maior) {
        $segundo_maior = $numero;
    }
}

echo "Segundo maior:" . $segundo_maior;
echo "\n";
echo "Maior:" . $maior;



echo "\n";
echo "\n";
echo "\n";

echo "QUESTAO 12\n";

// Questão 12 — Estatísticas de uma turma
// Considere o vetor abaixo. Percorra-o e calcule:
// $notas = [7.5, 4.0, 8.5, 6.0, 9.0, 3.5, 10.0, 5.5];
// ● a média da turma;
// ● quantos alunos possuem nota maior ou igual a 6;
// ● quantos alunos possuem nota menor que 6;
// ● a maior nota;
// ● a menor nota.
// Desafio: Não utilize funções prontas para encontrar o maior e o menor valor.

$notas = [7.5, 4.0, 8.5, 6.0, 9.0, 3.5, 10.0, 5.5];

$media_Total = 0;

$aprovados = 0;
$reprovados = 0;
$media_Maior = null;
$media_Menor = null;

foreach ($notas as $nota) {


    $media_Total += $nota;

    if ($nota >= 6) {
        $aprovados++;
    } else {
        $reprovados++;
    }

    if ($media_Maior === null || $media_Maior < $nota) {
        $media_Maior = $nota;
    }
    if ($media_Menor === null || $media_Menor > $nota) {
        $media_Menor = $nota;
    }
}

echo "Media total:" . $media_Total / count($notas) . "\n";
echo "Maior media:" . $media_Maior . "\n";
echo "Menor media:" . $media_Menor . "\n";




echo "\n";
echo "\n";
echo "\n";

echo "QUESTAO 11\n";

// Parte 2 — Vetores, Objetos e Problemas de Lógica
// As questões de 11 a 20 combinam estruturas condicionais e de repetição com arrays/vetores,
// arrays associativos e objetos. Nesta parte será necessário pensar com mais cuidado sobre a
// organização da solução.
// Questão 11 — Maior e menor valor de um vetor
// Considere o vetor abaixo. Percorra-o e descubra:
// $numeros = [45, 12, 89, 3, 67, 21, 100, 8, 55];
// ● o maior número;
// ● o menor número;
// ● a posição do maior número;
// ● a posição do menor número.
// Desafio: Não utilize max(), min() ou funções equivalentes.


$numeros = [45, 12, 89, 3, 67, 21, 100, 8, 55];

$indice_Maior = null;
$indice_Menor = null;



foreach ($numeros as $indice => $numero) {

    if ($indice_Maior === null || $numeros[$indice_Maior] < $numero) {
        $indice_Maior = $indice;
    }
    if ($indice_Menor === null || $numeros[$indice_Menor] > $numero) {
        $indice_Menor = $indice;
    }
}


echo " ● o maior número: " . $numeros[$indice_Maior];
echo "\n";
echo  "● o menor número: " . $numeros[$indice_Menor];
echo "\n";
echo  "● a posição do maior número: " . $indice_Maior;
echo "\n";
echo  "● a posição do menor número: " . $indice_Menor;


echo "\n";
echo "\n";
echo "\n";

echo "QUESTAO 10\n";

// Questão 10 — Sequência de Fibonacci
// Utilizando variáveis e uma estrutura for, exiba os 15 primeiros números da sequência de
// Fibonacci.
// Os próximos números devem ser calculados pelo programa, e não escritos manualmente.
// 0 1 1 2 3 5 8 13 21 34 ...

$a = 1;
$b = 1;
$c = 0;

echo $a . " , " . $b . " , ";

for ($contador = 0; $contador < 13; $contador++) {

    $c = $a + $b;
    $a = $b;
    $b = $c;

    echo $c . " , ";
}








echo "\n";
echo "\n";
echo "\n";

echo "QUESTAO 9\n";

// Questão 9 — Número primo
// Crie uma variável $numero. Desenvolva um programa que determine se o número é primo ou não.
// Um número primo é aquele que possui exatamente dois divisores: 1 e ele mesmo.
// Utilize uma estrutura de repetição e uma estrutura condicional.
// 7 é primo.
// 12 não é primo.

$numero = 7;

$and_primo = false;

for ($contador = $numero - 1; $contador > 1; $contador--) {

    if ($numero % $contador == 0 && $contador != 1) {
        $and_primo = false;
        break;
    }

    if ($numero % $contador == 0 && $contador == 1) {
        $and_primo = true;
    }
}

if ($and_primo) {
    echo $numero . " : é primo;";
} else {
    echo  $numero . " : não é primo;";
}





echo "\n";
echo "\n";
echo "\n";

echo "QUESTAO 8\n";

// Questão 8 — Fatorial
// Crie uma variável $numero contendo um número inteiro positivo.
// Utilizando for, calcule o fatorial desse número. Não utilize funções prontas para realizar o cálculo.
// 5! = 5 x 4 x 3 x 2 x 1 = 120

$numero = 5;
$fatorial = 1;

for ($contador = $numero; $contador != 0; $contador--) {
    $fatorial = $fatorial * $contador;
}

echo $numero . "!" . " = " . $fatorial;

echo "\n";
echo "\n";
echo "\n";


echo "QUESTAO 7\n";

// Questão 7 — Contagem regressiva
// Utilizando while, faça uma contagem regressiva de 20 até 0.
// Quando chegar a zero, exiba "Contagem encerrada!".
// Além disso, sempre que o número atual for múltiplo de 5, exiba ao lado "Múltiplo de 5".

$numero = 20;

while ($numero != 0) {
    echo $numero . "\n";
    $numero--;
}
echo "Contagem encerrada!";



echo "\n";
echo "\n";
echo "\n";

echo "QUESTAO 6\n";

// Questão 6 — Maior entre três números
// Crie três variáveis com valores numéricos. Utilizando apenas estruturas condicionais, descubra e
// exiba qual é o maior dos três números.
// Não utilize funções prontas como max().
$a = 15;
$b = 32;
$c = 51;


if ($a > $b && $a > $c) {
    echo "o maior e :" . $a;
} elseif ($b > $a && $b > $c) {
    echo "o maior e :" . $b;
} elseif ($c > $b && $c > $a) {
    echo "o maior e :" . $c;
}







echo "\n";
echo "\n";
echo "\n";

echo "QUESTAO 5\n";

// Questão 5 — Múltiplos
// Crie uma variável $numero. Utilizando if e else, informe:
// ● se o número é múltiplo de 3;
// ● se o número é múltiplo de 5;
// ● se é múltiplo de 3 e 5 ao mesmo tempo;
// ● ou se não é múltiplo de nenhum dos dois.


$numero = 4;

if ($numero % 3 === 0 && $numero % 5 === 0) {
    echo $numero . " é múltiplo de 3 e 5";
} elseif ($numero % 3 === 0) {
    echo $numero . " é múltiplo de 3";
} elseif ($numero % 5 === 0) {
    echo $numero . " é múltiplo de 5";
} else {
    echo $numero . " não é múltiplo de nenhum dos dois.";
}





echo "\n";
echo "\n";
echo "\n";

echo "QUESTAO 4\n";

// Questão 4 — Soma dos números
// Utilizando while, calcule e exiba a soma de todos os números de 1 até 100.
// O programa deve apresentar apenas o resultado final.
// Soma total: 5050

$numero = 1;
$soma = 0;

while ($numero <= 100) {
    $soma += $numero;
    $numero++;
}

echo "Soma total: " . $soma;


echo "\n";
echo "\n";
echo "\n";

echo "QUESTAO 3\n";

// Questão 3 — Tabuada
// Crie uma variável $numero e atribua um valor inteiro a ela.
// Utilizando for, exiba a tabuada desse número de 1 até 10.
// 5 x 1 = 5
// 5 x 2 = 10
// ...
// 5 x 10 = 50


function Tabuada(int $numero)
{
    for ($contador = 1; $contador <= 10; $contador++) {
        echo $numero . " X " . $contador . " = " . ($numero * $contador) . "\n";
    }
}

Tabuada(5);

echo "\n";
echo "\n";
echo "\n";

echo "QUESTAO 2\n";

// Questão 2 — Pares e ímpares
// Utilizando for, percorra os números de 1 até 30.
// Para cada número, exiba se ele é par ou ímpar.
// 1 - Ímpar
// 2 - Par
// 3 - Ímpar


for ($contador = 1; $contador <= 50; $contador++) {
    if ($contador % 2 === 0) {
        echo $contador . " - Par \n";
    } else {
        echo $contador . " - Impar \n";
    }
}



echo "\n";
echo "\n";
echo "\n";

echo "QUESTAO 1\n";

// Questão 1 — Contagem crescente
// Utilizando uma estrutura de repetição while, exiba todos os números de 1 até 50.
// Ao final, exiba também a mensagem: "Fim da contagem."

for ($contador = 1; $contador <= 50; $contador++) {
    echo $contador . "\n";
}
echo "Fim da contagem.";

echo "\n";
echo "\n";
echo "\n";
