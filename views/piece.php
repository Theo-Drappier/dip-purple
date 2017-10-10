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
          <li>
            <a href="">
              <i class="fa fa-dashboard"></i> <span>Accueil</span>
            </a>
          </li>
          <li class="active treeview">
            <a href="#">
              <i class="fa fa-bolt"></i> <span>Consommation Pièces</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <?php for($i = 0; $i < sizeof($pieces); $i++) { ?>
                <?php if($pieces[$i]['id'] == $args['idPiece']) { ?>
                    <li class="active"><a href="piece/<?php echo $pieces[$i]['id'] ?>"><i class="<?php echo $iconesPieces[$i]; ?>"></i><?php echo $pieces[$i]['libelle']; ?></a></li>
                <?php }else{ ?>
                    <li><a href="piece/<?php echo $pieces[$i]['id'] ?>"><i class="<?php echo $iconesPieces[$i]; ?>"></i><?php echo $pieces[$i]['libelle']; ?></a></li>
                <?php } ?>
              <?php } ?>
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
                <center>
                    <h1 style="color: #3c8dbc; font-weight: bold;">Consommation quotidienne de la pièce : <?php echo $consoPiece; ?> kW</h1>
                </center><br><br>
                <!-- start for -->
                <?php for($i = 0; $i < sizeof($appareils); $i++) { ?>
                    <div class="col-md-4 col-xs-12">
                        <div class="box box-success">
                            <div class="box-header">
                                <div class="row">
                                    <div class="col-md-2 col-xs-2">
                                        <i class="<?php
                                        $icone= $services["dao.icone"]->findOneById($appareils[$i]->id_ico);
                                        echo($icone->icone);
                                        ?> fa-2x" aria-hidden="true"></i>
                                    </div>
                                    <div class="col-md-6 col-xs-6">
                                        <h2 class="box-title"><?php echo $appareils[$i]->libelle ?></h2>
                                    </div>
                                    <div class="col-md-4 col-xs-4">
                                        <h3 style="color: green; font-weight: bold;"><?php echo $consoAppareils[$i] .' kW' ?></h3>
                                    </div>
                                </div>
                            </div>
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-md-4 col-xs-4">
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
                                    <div class="col-md-offset-4 col-md-4 col-xs-offset-4 col-xs-4">
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
