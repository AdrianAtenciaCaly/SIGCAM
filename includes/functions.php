<?php
$errors = array();

/*--------------------------------------------------------------*/
/*Función para configurar la zona horaria a mostrar
/*--------------------------------------------------------------*/
function confZonaHoraria()
{
  date_default_timezone_set('America/Bogota');
}
date_default_timezone_set('America/Bogota');

function fechaC()
{
  $mes = array(
    "", "Enero",
    "Febrero",
    "Marzo",
    "Abril",
    "Mayo",
    "Junio",
    "Julio",
    "Agosto",
    "Septiembre",
    "Octubre",
    "Noviembre",
    "Diciembre"
  );
  return $mes[date('n')]   . "/" . date('d') . "/" . date('Y');
}
function validateSession()
{
  require_once('includes/load.php');
  if (!$session->isUserLoggedIn(true)) {
    redirect('index.php', false);
  }
}

/*--------------------------------------------------------------*/
/* Función para Eliminar escapes especiales
 /* caracteres en una cadena para usar en una instrucción SQL
 /*--------------------------------------------------------------*/
function real_escape($str)
{
  global $con;
  $escape = mysqli_real_escape_string($con, $str);
  return $escape;
}


/*--------------------------------------------------------------*/
/*Función para eliminar caracteres html
/*--------------------------------------------------------------*/
function removeJunk($str)
{
  $str = nl2br($str);
  $str = htmlspecialchars(strip_tags($str, ENT_QUOTES));
  return $str;
}
/*--------------------------------------------------------------*/
/* Función para el primer caracter en mayúscula
/*--------------------------------------------------------------*/
function first_character($str)
{
  $val = str_replace('-', " ", $str);
  $val = ucfirst($val);
  return $val;
}
/*--------------------------------------------------------------*/
/* La función para verificar los campos de entrada no está vacía
/*--------------------------------------------------------------*/
function validate_fields($var)
{
  global $errors;
  foreach ($var as $field) {
    $val = removeJunk($_POST[$field]);
    if (isset($val) && $val == '') {
      $errors = $field . " No puede estar en blanco.";
      return $errors;
    }
  }
}
/*--------------------------------------------------------------*/
/*Función para mostrar mensaje de sesión
    Ex echo displayt_msg ($ mensaje);
/*--------------------------------------------------------------*/
function displayMSG($msg = '')
{
  $output = array();
  if (!empty($msg)) {
    foreach ($msg as $key => $value) {
      $output  = "<div class=\"alert alert-{$key}\">";
      $output .= "<a href=\"#\" class=\"close\" data-dismiss=\"alert\">&times;</a>";
      $output .= removeJunk(first_character($value));
      $output .= "</div>";
    }
    return $output;
  } else {
    return "";
  }
}
/*--------------------------------------------------------------*/
/* Función para redirigir
/*--------------------------------------------------------------*/
function redirect($url, $permanent = false)
{
  if (headers_sent() === false) {
    header('Location: ' . $url, true, ($permanent === true) ? 301 : 302);
  }

  exit();
}
/*--------------------------------------------------------------*/
/* Function for find out total saleing price, buying price and profit
/*
function total_price($totals)
{
  $sum = 0;
  $sub = 0;
  foreach ($totals as $total) {
    $sum += $total['total_saleing_price'];
    $sub += $total['total_buying_price'];
    $profit = $sum - $sub;
  }
  return array($sum, $profit);
}
*/
/*--------------------------------------------------------------*/
/* Función para fecha y hora legible
/*--------------------------------------------------------------*/
function read_date($str)
{
  if ($str)
    return date('d/m/Y g:i:s a', strtotime($str));
  else
    return null;
}
/*--------------------------------------------------------------*/
/*Función para lectura legible fecha hora
/*--------------------------------------------------------------*/
function make_date()
{
  return strftime("%Y-%m-%d %H:%M:%S", time());
}
/*--------------------------------------------------------------*/
/* Función para fecha y hora legible
/*--------------------------------------------------------------*/
function countId()
{
  static $count = 1;
  return $count++;
}
/*--------------------------------------------------------------*/
/* Función para crear una cadena aleatoria
/*--------------------------------------------------------------*/
function randString($length = 5)
{
  $str = '';
  $cha = "0123456789abcdefghijklmnopqrstuvwxyz";

  for ($x = 0; $x < $length; $x++)
    $str .= $cha[mt_rand(0, strlen($cha))];
  return $str;
}
