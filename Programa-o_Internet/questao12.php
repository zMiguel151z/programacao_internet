<?php 

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