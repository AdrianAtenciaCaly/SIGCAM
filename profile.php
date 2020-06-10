<?php
$page_title = 'Mi perfil';
require_once('includes/load.php');
if (!$session->isUserLoggedIn(true)) {
  redirect('index', false);
}
?>
<?php
$user_id = (int) $_GET['id'];
if (empty($user_id)) :
  redirect('home.php', false);
else :
  $user_p = find_by_id('users', $user_id);
endif;
?>
<?php include_once('layouts/header.php'); ?>
<div class="row">
  <div class="col-md-12">
    <div class="panel profile">
      <div class="jumbotron text-center bg-red">
        <img class="img-circle img-size-2" src="uploads/users/<?php echo $user_p['image']; ?>" alt="">
        <h3><?php echo first_character($user_p['name']); ?></h3>
      </div>
      <?php if ($user_p['id'] === $user['id']) : ?>
        <ul class="nav nav-pills nav-stacked">
          <li><a href="edit_account.php"> <i class="glyphicon glyphicon-edit"></i> Editar perfil</a></li>
        </ul>
      <?php endif; ?>
    </div>
  </div>
</div>
<div class="col-md-12">
  <div class="panel panel-default">
    <div class="panel-heading clearfix">
      <span class="glyphicon glyphicon-edit"></span>
      <span>DATOS DE CUENTA</span>
    </div>
    <div class="panel-body">
      <form method="post" action="edit_account.php?id=<?php echo (int) $user['id']; ?>" class="clearfix">
        <div class="form-group">
          <label for="name" class="control-label">Nombres</label>
          <input type="name" class="form-control" name="name" disabled value="<?php echo removejunk(ucwords($user['name'])); ?> ">
        </div>
        <div class="form-group">
          <label for="username" class="control-label">Usuario</label>
          <input type="text" class="form-control" name="username" disabled value="<?php echo removejunk(ucwords($user['iduser'])); ?>">
        </div>
        <div class="form-group">
          <label for="username" class="control-label">Tipo</label>
          <input type="text" class="form-control" name="tipo" disabled value="<?php echo removejunk(ucwords($user['tipo'])); ?>">
        </div>

      </form>
    </div>
  </div>
</div>

<?php include_once('layouts/footer.php'); ?>