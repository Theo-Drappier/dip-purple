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
    <div class="content-wrapper">
        <section class="content-header">
            <h1>Classement</h1>
        </section>

        <section class="content">
            <div class="box">
                <table class="table table-bordered">
                    <thead>
                        <th>Nom</th>
                        <th>Points</th>
                    </thead>
                    <tbody>
                    <!-- start for -->
                        <?php for($i = 0; $i < sizeof($arrayBestHunters); $i++) { ?>
                            <tr>
                                <td>
                                    <?php
                                    $user = $services['dao.users']->findOneById($arrayBestHunters[$i]);
                                    $pointUser = $arrayBestHuntersPoints[$user->id];
                                    echo $user->prenom;
                                    ?>
                                </td>
                                <td>
                                    <?php echo $pointUser; ?>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                    <!-- end for -->
                </table>
            </div>
        </section>
    </div>
    <!-- FOOTER PAGE -->
    <?php include('../views/base/footer.php'); ?>
</div>
</body>
<!-- SCRIPT PAGE -->
<?php include('../views/base/script.php'); ?>
