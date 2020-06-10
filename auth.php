<?php include_once('includes/load.php'); ?>
<?php
$req_fields = array('username', 'password');
validate_fields($req_fields);
$username = removeJunk($_POST['username']);
$password = removeJunk($_POST['password']);

if (empty($errors)) {
  $user_id = authenticate($username, $password);
  if ($user_id) {

    $session->login($user_id);

    updateLastLogIn($user_id);
    $session->msg("s", "Bienvenido a SIGCAM.");
    redirect('admin', false);
  } else {
    $session->msg("d", "Nombre de usuario y/o contraseña incorrecto.");
    redirect('index', false);
  }
} else {
  $session->msg("d", $errors);
  redirect('index', false);
}

?>
