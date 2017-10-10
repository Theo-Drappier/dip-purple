<!DOCTYPE html>
<html>
    <?php include('../views/base/head.php'); ?>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="login"><b>Gaspi'GO</b></a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body bg-color">
      <!--<img class="profile-img-card" src="//ssl.gstatic.com/accounts/ui/avatar_2x.png" />-->
    <p class="login-box-msg">Connectez vous pour commencer à chasser les Watts</p>
    <?php if($_SESSION['error'] == 500) { ?>
        <p style="color: red;">Erreur de login</p>
    <?php } ?>
    <?php if($deco) { ?>
        <p style="color: red;">Vous avez été déconnecté(e)</p>
    <?php } ?>
    <form action="connection" method="post">
      <div class="form-group has-feedback">
        <input type="email" name="mail" class="form-control" placeholder="Email">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" name="password" class="form-control" placeholder="Mot de passe">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <!-- /.col -->
          <button type="submit" class="btn btn-primary btn-lg center-block">Connexion</button>
        <!-- /.col -->
      </div>
    </form>
  </div>
  <!-- /.login-box-body -->
</div>
<!-- jQuery 3 -->
<?php include('../views/base/script.php'); ?>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' // optional
    });
  });
</script>
</body>
</html>
