<?php
require_once('includes/load.php');
/**
 * función para buscar todas las filas de la tabla de base de datos por nombre de tabla
 *
 * @return   
 * @param string $table tabla a buscar 
 */
function find_all($table)
{
  global $db;
  if (tableExists($table)) {
    return find_by_sql("SELECT * FROM " . $db->escape($table));
  }
}

/**
 * Función para realizar consultas
 *
 * @return   result_set   resultado de la consulta 
 * @param string $sql a ejecutar
 */
function find_by_sql($sql)
{
  global $db;
  $result = $db->query($sql);
  $result_set = $db->while_loop($result);
  return $result_set;
}

/**
 * Función para buscar datos de la tabla por id
 *
 * @return   result   resultado de la consulta 
 * @param string $table  la tabla a buscar, $id id a buscar
 */
function find_by_id($table, $id)
{
  global $db;
  $id = (int) $id;
  if (tableExists($table)) {
    $sql = $db->query("SELECT * FROM {$db->escape($table)} WHERE id='{$db->escape($id)}'");
    if ($result = $db->fetch_assoc($sql))
      return $result;
    else
      return null;
  }
}

/**
 * Función para buscar datos de la tabla por id de usuario 
 *
 * @return   result   resultado de la consulta
 * @param string $table  la tabla a buscar, $id id a buscar
 */
function find_by_id_user($table, $id)
{
  global $db;
  $id = (int) $id;
  if (tableExists($table)) {
    $sql = $db->query("SELECT * FROM {$db->escape($table)} WHERE id='{$db->escape($id)}'");
    if ($result = $db->fetch_assoc($sql))
      return $result;
    else
      return null;
  }
}
/**
 * Función para buscar datos de la tabla por id de caja 
 *
 * @return   result   resultado de la consulta
 * @param string $table  la tabla a buscar, $id id a buscar
 */
function find_by_id_box($table, $id)
{
  global $db;
  $id = (int) $id;
  if (tableExists($table)) {
    $sql = $db->query("SELECT * FROM {$db->escape($table)} WHERE idbox='{$db->escape($id)}'");
    if ($result = $db->fetch_assoc($sql))
      return $result;
    else
      return null;
  }
}

/**
 * Función para buscar datos de la tabla por id de caja 
 *
 * @return   boolean true si se elimina o false si no se encuentra la id
 * @param string $table  la tabla a buscar, $id id a buscar
 */
function delete_by_id($table, $id)
{
  global $db;
  if (tableExists($table)) {
    $sql = "DELETE FROM " . $db->escape($table);
    $sql .= " WHERE idbox=" . $db->escape($id);
    $sql .= " LIMIT 1";
    $db->query($sql);
    return ($db->affected_rows() === 1) ? true : false;
  }
}

/**
 * Función para buscar el saldo inicial en caja
 *
 * @return result 
 * @param string $table  la tabla a buscar
 */
function initialBalance($table)
{
  global $db;
  if (tableExists($table)) {
    $sql    = "SELECT * FROM " . $db->escape($table);
    $result = $db->query($sql);
    return ($db->fetch_assoc($result));
  }
}
/**
 * Función para buscar  los ultimos movimiento de egresos en caja por dia 
 * @return result 
 * @param string $table  la tabla a ingresar datos
 */
function lastMovementsEgresos($table)
{
  $date =  date("m/d/Y");
  global $db;
  $sql  = " SELECT * FROM $table WHERE  opcion = 'EGRESO' and fecha= '$date'  ORDER BY  idbox DESC";
  return find_by_sql($sql);
}
/**
 * Función para buscar  los ultimos movimiento de ingresos en caja por dia 
 * @return result 
 * @param string $table  la tabla a ingresar datos
 */
function lastMovementsIngresos($table)
{
  $date =  date("m/d/Y");
  global $db;
  $sql  = " SELECT * FROM $table WHERE  opcion = 'INGRESO' and fecha= '$date'  ORDER BY  idbox DESC";
  return find_by_sql($sql);
}
/**
 * Función para buscar  el total   por movientos (EGRESO)
 * @return result 
 * @param string $table  la tabla a ingresar datos, $date fecha a buscar
 */
function getTotalEgresos($table, $date)
{

  global $db;
  if (tableExists($table)) {
    $sql = "SELECT sum(valor) AS total FROM $table WHERE fecha = '$date' and opcion = 'EGRESO'";
    $result = $db->query($sql);
    return ($db->fetch_assoc($result));
  }
}
/**
 * Función para buscar  el total  por movientos (INGRESOS)
 * @return result 
 * @param string $table  la tabla a ingresar datos, $date fecha a buscar
 */
function getTotalIngresos($table, $date)
{

  global $db;
  if (tableExists($table)) {
    $sql = "SELECT sum(valor) AS total FROM $table WHERE fecha = '$date' and opcion = 'INGRESO'";
    $result = $db->query($sql);
    return ($db->fetch_assoc($result));
  }
}
/**
 * Función para obtener el saldo en caja
 * @return $total el total de saldo en caja
 */
function checkCashBalance()
{
  $totalEgresosall = getTotalEgresosAll('box');
  $totalIngresosall = getTotalIngresoAll('box');
  $initialBalance = initialBalance('initial_balance');
  $total3 =   $totalEgresosall['total'];
  $total1 =   $initialBalance['balance'];
  $total2 =  $totalIngresosall['total'];
  $total = ($total1 + $total2 - $total3);
  return $total;
}
/**
 * Función para obtener el total de ingresos en caja
 * @return result 
 * @param string $table  la tabla a buscar. 
 */
function getTotalEgresosAll($table)
{
  global $db;
  if (tableExists($table)) {
    $sql = "SELECT sum(valor) AS total FROM $table WHERE  opcion = 'EGRESO'";
    $result = $db->query($sql);
    return ($db->fetch_assoc($result));
  }
}
/**
 * Función para obtener el total de ingresos en caja
 * @return result 
 * @param string $table  la tabla a buscar. 
 */
function getTotalIngresoAll($table)
{
  global $db;
  if (tableExists($table)) {
    $sql = "SELECT sum(valor)AS total FROM $table WHERE   opcion = 'INGRESO'";
    $result = $db->query($sql);
    return ($db->fetch_assoc($result));
  }
}
/**
 * Función para determinar si la tabla existe 
 * @return boolean true si existe o false si no
 * @param string $table  la tabla a buscar. 
 */
function tableExists($table)
{
  global $db;
  $table_exit = $db->query('SHOW TABLES FROM ' . DB_NAME . ' LIKE "' . $db->escape($table) . '"');
  if ($table_exit) {
    if ($db->num_rows($table_exit) > 0)
      return true;
    else
      return false;
  }
}
/**
 * Función para validar inicio de session
 * @return $user  si es valido o falso si no 
 * @param string $username , $password 
 */
function authenticate($username = '', $password = '')
{
  global $db;
  $username = $db->escape($username);
  $password = $db->escape($password);
  // $sql  = sprintf("SELECT id,username,password,user_level FROM users WHERE username ='%s' LIMIT 1", $username);
  $sql  = sprintf("SELECT id,iduser,password FROM users WHERE iduser ='%s' LIMIT 1", $username);
  $result = $db->query($sql);
  $result = $db->query($sql);
  if ($db->num_rows($result)) {
    $user = $db->fetch_assoc($result);
    $password_request = sha1($password);
    if ($password_request === $user['password']) {
      return $user['id'];
    }
  }
  return false;
}

/**
 * Función para validar si el usuario es administrado o secretaria
 *  @return result 
 * @param string $require_level
 */
function page_require_tipo($require_level)
{
  global $session;
  global $db;
  $sql = "SELECT tipo FROM users WHERE   tipo = '$require_level'";
  $result = $db->query($sql);
  return ($db->fetch_assoc($result));
}
/**
 * Función para econtrar  el usuario de inicio de sesión actual por ID de sesión
 *  @return current_user 
 * 
 */
function current_user()
{
  static $current_user;
  global $db;
  if (!$current_user) {
    if (isset($_SESSION['user_id'])) :
      $user_id = intval($_SESSION['user_id']);
      $current_user = find_by_id('users', $user_id);
    endif;
  }
  return $current_user;
}

/**
 * Función para actualizar la fecha y hora de inicio de session.
 *  @return boolean true o false 
 * @param string $user_id
 */

function updateLastLogIn($user_id)
{
  global $db;
  $date = make_date();
  $sql = "UPDATE users SET last_login='{$date}' WHERE id ='{$user_id}' LIMIT 1";
  $result = $db->query($sql);
  return ($result && $db->affected_rows() === 1 ? true : false);
}
/**
 * Función para obtener todo los datos de la caja
 *  @return $result
 * 
 */
function findAllBox()
{
  global $db;
  $sql  = " SELECT idbox,fecha,concepto,doc_identidad,recibo_caja,opcion,valor,detalles FROM box ORDER BY  idbox DESC";
  return find_by_sql($sql);
}
/**
 * Función para obtener todo los datos de la caja por id 
 *  @return $result
 * @param $table, $idbox
 */
function findAllBoxidbox($table, $idbox)
{
  global $db;
  if (tableExists($table)) {
    $sql  = "SELECT idbox,fecha,concepto,doc_identidad,recibo_caja,opcion,valor,detalles FROM $table WHERE idbox = '$idbox'";

    return find_by_sql($sql);
  }
}

/**
 * Función para obtener todo los datos de la caja por fecha
 *  @return $result
 * @param $table, $date
 */
function findAllBoxDate($table, $date)
{
  global $db;
  if (tableExists($table)) {
    $sql  = "SELECT * FROM $table WHERE fecha = '$date' ORDER BY  idbox DESC";
    return find_by_sql($sql);
  }
}
/**
 * Función para obtener todo los datos de la caja por mes y año
 *  @return $result
 * @param $table, $month, $year
 */
function findAllBoxMonthlyyear($table, $month, $year)
{
  global $db;
  if (tableExists($table)) {
    $sql  = "SELECT * FROM $table WHERE mes = '$month' and año = '$year' ORDER BY  idbox DESC";
    return find_by_sql($sql);
  }
}
/**
 * Función para obtener todo los datos de la caja por año
 *  @return $result
 * @param $table,  $year
 */
function findAllBoxYear($table, $year)
{
  global $db;
  if (tableExists($table)) {
    $sql  = "SELECT * FROM $table WHERE  año = '$year' ORDER BY  idbox DESC";
    return find_by_sql($sql);
  }
}
/**
 * Función para obtener la fecha y hora del ultimo movimiento de actualizacion en caja
 *  @return $result
 */
function getLastUpadateInitialBalance($table)
{
  global $db;
  if (tableExists($table)) {
    $sql  = "SELECT lastUpdate FROM $table ";
    return find_by_sql($sql);
  }
}
