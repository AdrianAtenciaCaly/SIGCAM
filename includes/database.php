<?php
require_once(LIB_PATH_INC . DS . "config.php");

class MySqli_DB
{

  private $con;
  public $query_id;

  function __construct()
  {
    $this->db_connect();
  }

  /*--------------------------------------------------------------*/
  /* Función para conexión de base de datos abierta
/*--------------------------------------------------------------*/
  public function db_connect()
  {
    $this->con = mysqli_connect(DB_HOST, DB_USER, DB_PASS);
    if (!$this->con) {
      echo "
      <!DOCTYPE html>
<html lang=&quot;es&quot;>

<head>
  <meta charset='UTF-8'>
  <meta name='viewport' content='width=device-width, initial-scale=1.0'>
  <meta http-equiv='X-UA-Compatible' content='ie=edge'>
  <link rel='icon' href='img/assets/favicon.ico'>
  <style>
    ::-moz-selection {
      background: #b3d4fc;
      text-shadow: none;
    }

    ::selection {
      background: #b3d4fc;
      text-shadow: none;
    }


    html {
      padding: 30px 10px;
      font-size: 16px;
      line-height: 1.4;
      color: #737373;
      background: #f0f0f0;
      -webkit-text-size-adjust: 100%;
      -ms-text-size-adjust: 100%;
    }

    html,
    input {
      font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
    }


    body {
      max-width: 700px;
      _width: 700px;
      padding: 30px 20px 50px;
      border: 1px solid #b3b3b3;
      border-radius: 4px;
      margin: 0 auto;
      box-shadow: 0 1px 10px #a7a7a7, inset 0 1px 0 #fff;
      background: #fcfcfc;
    }

    h1 {
      margin: 0 10px;
      font-size: 50px;
      text-align: center;
    }

    h1 span {
      color: #bbb;
    }

    h2 {
      color: #D35780;
      margin: 0 10px;
      font-size: 40px;
      text-align: center;
    }

    h2 span {
      color: #bbb;
      font-size: 80px;
    }

    h3 {
      margin: 1.5em 0 0.5em;
    }

    p {
      margin: 1em 0;
    }

    ul {
      padding: 0 0 0 40px;
      margin: 1em 0;
    }

    .container {
      max-width: 380px;
      _width: 480px;
      margin: 0 auto;
    }

    input::-moz-focus-inner {
      padding: 0;
      border: 0;
    }
  </style>
</head>

<body>
  <div class=&quot;container&quot;>
    <h2><span>Error de conexíon </span></h2>
    <h2>NO SE PUDO ESTABLECER CONEXIÓN CON LA BASE DE DATOS</h2>
    <p>¡Vaya! Algo salió mal.<br /><br />Trata de volver a cargar esta página o no dudes en contactar con nosotros si el
      problema persiste.</p>
  </div>
</body>

</html>
      
      ";
      die(" Database connection failed:" . mysqli_connect_error());
    } else {
      $select_db = $this->con->select_db(DB_NAME);
      if (!$select_db) {
        die("Failed to Select Database" . mysqli_connect_error());
        redirect('admin.php', false);
      }
    }
  }
  /*--------------------------------------------------------------*/
  /* Función para cerrar la conexión de la base de datos
/*--------------------------------------------------------------*/

  public function db_disconnect()
  {
    if (isset($this->con)) {
      mysqli_close($this->con);
      unset($this->con);
    }
  }
  /*--------------------------------------------------------------*/
  /* Función para consulta mysqli
/*--------------------------------------------------------------*/
  public function query($sql)
  {

    if (trim($sql != "")) {
      $this->query_id = $this->con->query($sql);
    }
    if (!$this->query_id)
      // only for Develope mode
      die("Error en esta consulta :<pre> " . $sql . "</pre>");
    // For production mode
    //  die("Error on Query");

    return $this->query_id;
  }

  /*--------------------------------------------------------------*/
  /* Función para el asistente de consultas
/*--------------------------------------------------------------*/
  public function fetch_array($statement)
  {
    return mysqli_fetch_array($statement);
  }
  public function fetch_object($statement)
  {
    return mysqli_fetch_object($statement);
  }
  public function fetch_assoc($statement)
  {
    return mysqli_fetch_assoc($statement);
  }
  public function num_rows($statement)
  {
    return mysqli_num_rows($statement);
  }
  public function insert_id()
  {
    return mysqli_insert_id($this->con);
  }
  public function affected_rows()
  {
    return mysqli_affected_rows($this->con);
  }
  /*--------------------------------------------------------------*/
  /* Función para Eliminar escapes especiales
  /*   caracteres en una cadena para usar en una instrucción SQL
 /*--------------------------------------------------------------*/
  public function escape($str)
  {
    return $this->con->real_escape_string($str);
  }
  /*--------------------------------------------------------------*/
  /* Función para bucle while
/*--------------------------------------------------------------*/
  public function while_loop($loop)
  {
    global $db;
    $results = array();
    while ($result = $this->fetch_array($loop)) {
      $results[] = $result;
    }
    return $results;
  }
}

$db = new MySqli_DB();
