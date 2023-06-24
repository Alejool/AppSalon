<?php

function formatearHora($hora) {
  $horaFormateada = '';

  $soloHora = explode(':', $hora)[0]; // Extraer solo la hora
  $soloMinutos = explode(':', $hora)[1]; // Extraer solo los minutos

  // Convertir la hora en formato de 12 horas
  if ($soloHora > 0 && $soloHora < 12) {
      $horaFormateada = $hora . ' a.m.';
  } elseif ($soloHora == 12) {
      $horaFormateada = $hora . ' p.m.';
  } else {
      $horaFormateada = ($soloHora - 12) . ':' . $soloMinutos . ' p.m.';
  }

  return $horaFormateada;
}


function formatPriceToCOP($price) {
    // Aplicar el formato de separador de miles y decimales
    $formattedPrice = number_format($price, 0, ',', '.');

    // Agregar el símbolo de la moneda
    $formattedPrice = '$' . $formattedPrice;

    return $formattedPrice;
}


function hallarTotal($precio) {
  static $sumaTotal = 0; // Variable estática para almacenar la suma total

  $sumaTotal += $precio; // Sumar el precio al total acumulado

  return $sumaTotal;
  
}


function esUltimo(string $actual, string $siguiente): bool{

  if ($actual!==$siguiente){
    return true;
  }

  return false;

}
