<?php

// Obtém as horas inicial e final do período de trabalho do usuário
$horaInicial = strtotime($_POST['hora_inicial']);
$horaFinal = strtotime($_POST['hora_final']);


// Calcula o número de minutos trabalhados no período
$tempoTrabalhado = ($horaFinal - $horaInicial) / 60;

// Verifica se a duração do período é inferior a 24 horas
if ($tempoTrabalhado <= 1440) {

  // Obtém a hora atual para verificar se o trabalho ocorreu em um dia ou em dois dias
  $horaAtual = time();

  // Se a hora final do período for anterior à hora inicial, o trabalho ocorreu em dois dias
  if ($horaFinal < $horaInicial) {
    $horaFinal += 86400;
  }

  // Inicializa os totalizadores de horas diurnas e noturnas
  $horasDiurnas = 0;
  $horasNoturnas = 0;

  // Loop para percorrer todas as horas trabalhadas no período
  for ($i = $horaInicial; $i < $horaFinal; $i += 60) {

    // Verifica se a hora atual está dentro do período noturno
    if (date('H:i', $i) >= '22:00' || date('H:i', $i) < '05:00') {
      $horasNoturnas += 1/60;
    } else {
      $horasDiurnas += 1/60;
    }
  }

  // Exibe os totalizadores de horas diurnas e noturnas
  $horasDiurnas = round($horasDiurnas * 60);
  $horasNoturnas = round($horasNoturnas * 60);
  echo "Horas diurnas: " . intval($horasDiurnas / 60) . ":" . sprintf("%02d", ($horasDiurnas % 60)). "<br>";
  echo "Horas noturnas: " . intval($horasNoturnas / 60) . ":" . sprintf("%02d", ($horasNoturnas % 60)) . "<br>"; 

} else {
  // Caso o período informado seja superior a 24 horas, exibe uma mensagem de erro
  echo "A duração do período deve ser inferior a 24 horas.";
}










