<?php include('../views/base/head.php'); ?>

<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
    <?php include('../views/base/header.php'); ?>
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
    <div class="content-wrapper">
        <section class="content-header">
            <h1>Détails <?php echo $piece->libelle; ?></h1>
        </section>

        <section class="content">
            <div class="row">
                <!-- start for -->
                <?php for($i = 0; $i < sizeof($appareils); $i++) { ?>
                    <div class="col-md-4">
                        <div class="box box-success">
                            <div class="box-header">
                                <div class="row">
                                    <div class="col-md-2">
                                        <i class="fa fa-battery-full fa-2x" aria-hidden="true"></i>
                                    </div>
                                    <div class="col-md-9">
                                        <h3 class="box-title"><?php echo $appareils[$i]->libelle ?></h3>
                                    </div>
                                </div>
                            </div>
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        Etat :
                                        <?php
                                        if(is_null($etats[$i])) {
                                            echo "Eteint";
                                        }
                                        else {
                                            echo $etats[$i]->libelle;
                                        }
                                        ?>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-offset-4 col-md-4">
                                        <a href="<?php echo "appareil/".$homepieces[$i]->id; ?>">
                                            <button class="btn btn-block btn-primary">Modifier</button>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
                <!-- end for -->
            </div>
        </section>
    </div>
    <!-- FOOTER PAGE -->
    <?php include('../views/base/footer.php'); ?>
</div>
</body>
<!-- SCRIPT PAGE -->
<?php include('../views/base/script.php'); ?>