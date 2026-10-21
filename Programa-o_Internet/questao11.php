<?php
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

$numeros = [2, 5, 2, 8, 5, 2, 10, 8, 5, 5];

$contagens = [];


foreach ($numeros as $numero) {
  if (isset($contagens[$numero])) {
    $contagens[$numero]++;
  } else {
    $contagens[$numero] = 1;
  }
}

foreach ($contagens as $numero => $count) {
    echo $numero . " Aparece " . $count . " vezes\n";
}
