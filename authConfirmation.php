<?php include_once('includes/load.php'); ?>
<?php
$req_fields = array('usuario', 'password');
validate_fields($req_fields);
$username = removeJunk($_POST['usuario']);
$password = removeJunk($_POST['password']);
$saldonuevo = removeJunk($_POST['saldoNuevo']);
$id =  $initialBalance['idinitial_balance'];

if (empty($errors)) {
  $user_id = authenticate($username, $password);
  if ($user_id) {
    if (isset($_POST['update'])) {
      $req_fields = array('saldoNuevo');
      $date = make_date();
      validate_fields($req_fields);
      if (empty($errors)) {
        $saldo = removejunk($db->escape($_POST['saldoNuevo']));
        $sql = "UPDATE initial_balance SET  balance ='{$saldo}', lastUpdate= '$date' WHERE idinitial_balance='{$id}'";
        $result = $db->query($sql);
        if ($result && $db->affected_rows() === 1) {
          $session->msg('s', "Cuenta actualizada. ");
          redirect('editSaldo.php', false);
        } else {
          $session->msg('d', ' Lo siento, actualización falló.');
          redirect('editSaldo.php', false);
        }
      } else {
        $session->msg("d", $errors);
        redirect('editSaldo.php', false);
      }
    }

    $session->msg("s", "Saldo atualizado");
    redirect('editSaldo.php', false);
  } else {
    $session->msg("d", "Nombre de usuario y/o contraseña incorrecto.");
    redirect('editSaldo.php', false);
  }
} else {
  $session->msg("d", $errors);
  redirect('editSaldo.php', false);
}

?>