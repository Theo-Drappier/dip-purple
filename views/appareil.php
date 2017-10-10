<!DOCTYPE html>
<html>

    <!-- HEAD PAGE -->
    <?php include('../views/base/head.php'); ?>

<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <!-- HEADER PAGE -->
  <?php include('../views/base/header.php'); ?>

  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">NAVIGATION</li>
        <li class="active">
          <a href="#">
            <i class="fa fa-dashboard"></i> <span>Accueil</span>
          </a>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-bolt"></i> <span>Consommation Pièces</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class=""><a href="index.php"><i class="fa fa-coffee"></i> Salon</a></li>
            <li><a href="index.php"><i class="fa fa-bed"></i> Chambres</a></li>
            <li><a href="index.php"><i class="fa fa-cutlery"></i> Cuisine</a></li>
            <li><a href="index.php"><i class="fa fa-bath"></i> Salle de bain</a></li>
            <li><a href="index.php"><i class="fa fa-desktop"></i> Bureau</a></li>
            <li><a href="index.php"><i class="fa fa-tint"></i> Toilettes</a></li>
            <li><a href="index.php"><i class="fa fa-car"></i> Garage</a></li>
          </ul>
        </li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h2>
        <?php echo $appareil->libelle ; ?>
        <small><?php echo $piece->libelle ; ?></small>
      </h2>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Accueil</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
          <?php
          if(isset($action))
          {
              $idB =$action['id_bareme'];
          }
          else
          {
              $idB = 5 ;
          }
          ?>
      </div>

      <div class="row">
        <div class="col-lg-6 col-xs-12">
          <!-- small box -->

          <div class="small-box bg-green">

            <div class="inner">
              <h3><?php echo($appareil->libelle); ?></h3>

              <H2><?php echo($consoAppareil); ?> kW consommé aujourd'hui</H2>
            </div>
            <div class="icon">
              <i class="<?php echo($icone->icone) ?>"></i>
            </div>
            <div class="inner">
                <form action="appareil/insert" method="post">
                    <div class="row">
                        <div class="col-md-offset-1 col-md-7">
                            <!-- Turn on the divice -->
                            <INPUT type= "radio" name="statuApp" value=3 <?php if( $idB== 3) { echo 'checked="checked"'; } ?> >
                            <label>Allumer</label> <br/>

                            <!-- Only if standby mode is possible -->
                            <?php if($appareil->veille == 1){ ?>
                                <INPUT type= "radio" name="statuApp" value=4 <?php if($idB == 4) { echo 'checked="checked"'; } ?> >
                                <label>Mise en veille</label> <br/>
                            <?php } ?>

                            <!-- Turn offthe divice -->
                            <INPUT type= "radio" name="statuApp" value=5 <?php if($idB== 5) { echo 'checked="checked"'; } ?> >
                            <label>Eteindre</label> <br/>
                        </div>
                        <div class="col-md-4">
                            <input type="hidden"  name="id_hp" value="<?php echo $homepiece->id; ?>" />
                            <input type="hidden"  name="id_piece" value="<?php echo $homepiece->id_piece; ?>" />
                            <input type="submit" class="btn btn-warning btn-block" value="Valider" />
                        </div>
                    </div>
                </form>
            </div>

            <!--<a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>-->
          </div>
        </div>

      </div>

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

    <!-- FOOTER PAGE -->
    <?php include('../views/base/footer.php'); ?>
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

    <!-- SCRIPT PAGE -->
    <?php include('../views/base/script.php'); ?>

</body>
</html>
