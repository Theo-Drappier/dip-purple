<!DOCTYPE html>
<html>

    <!-- HEAD PAGE -->
    <?php include('base/head.php'); ?>

<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <!-- HEADER PAGE -->
  <?php include('base/header.php'); ?>

  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">NAVIGATION</li>
        <li class="active">
          <a href="">
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
            <?php for($i = 0; $i < sizeof($pieces); $i++) { ?>
              <li><a href="piece/<?php echo $pieces[$i]['id'] ?>"><i class="<?php echo $iconesPieces[$i]; ?>"></i><?php echo $pieces[$i]['libelle']; ?></a></li>
            <?php } ?>
          </ul>
        </li>
        <li>
            <a href="classement">
                <i class="fa fa-table"></i> <span>Classement</span>
            </a>
        </li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        PAGE D'ACCUEIL
        <small>Control panel</small>
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
          <center>
              <h1 style="color: #3c8dbc; font-weight: bold;">CONSOMMATION DU JOUR DE LA FAMILLE : <?php echo $consoTotale/1000 ?> kW</h1><br /><br />
              <h2>
                  Le meilleur chasseur de la famille <?php echo $_SESSION['famille']->nom_fam; ?> est <?php echo $bestHunter->prenom; ?><br /><br />
              </h2>
          </center>
      </div>
      <div class="row">
          <?php for($i = 0; $i < sizeof($pieces); $i++) { ?>
             <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <?php if(($consoPieces[$i]/1000) >= 10){ ?>
                    <div class="small-box bg-red">
                <?php }elseif(($consoPieces[$i]/1000) < 20 && ($consoPieces[$i]/1000) >= 5){ ?>
                    <div class="small-box bg-yellow">
                <?php }else{ ?>
                    <div class="small-box bg-green">
                <?php } ?>
                  <div class="inner">
                      <h3 id="kw-pieces-accueil" style="font-weight: bold;"><?php echo ($consoPieces[$i]/1000); ?> kW</h3>
                    <h4><?php echo $pieces[$i]['libelle']; ?></h4>
                  </div>
                  <div class="icon">
                    <!--<i class="ion ion-bag"></i>-->
                      <i class="<?php echo $iconesPieces[$i]; ?>"></i>
                  </div>
                  <a href="piece/<?php echo $pieces[$i]['id'] ?>" class="small-box-footer">Plus d'infos <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
          <?php } ?>
        <!-- ./col -->
      </div>

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

    <!-- FOOTER PAGE -->
    <?php include('base/footer.php'); ?>
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

    <!-- SCRIPT PAGE -->
    <?php include('base/script.php'); ?>

</body>
</html>
