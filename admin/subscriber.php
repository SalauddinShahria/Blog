<?php include "inc/header.php" ?>

  <!-- Navbar -->
<?php include "inc/topbar.php" ?>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
<?php include "inc/menu.php" ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
              <li class="breadcrumb-item active">Users Template</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">

          <?php
            if($_SESSION['role'] == 1 OR 2){ ?>
                <div class="col-lg-12">          
                  <div class="card">
                    <div class="card-header">
                      <h3 class="card-title">Show All Subscribers</h3>
                    </div>
                    <div class="card-body" style="display: block;">
                      <table id="datatable" class="table table-striped table-bordered table-hover table-dark">
                        <thead>
                          <tr>
                            <th scope="col" class="text-center">Sl.</th>
                            <th scope="col" class="text-center">Email</th>
                            <th scope="col" class="text-center">Subscirbtion Date</th>
                          </tr>
                        </thead>
                        <tbody>

                          <?php
                            $sql = "SELECT * FROM subscribtion_list ORDER BY sub_id DESC ";
                            $subRead = mysqli_query($db, $sql);
                            $i = 0;

                            while ($row = mysqli_fetch_assoc($subRead)) {
                              $sub_id = $row['sub_id'];
                              $sub_email = $row['sub_email'];
                              $sub_date = $row['sub_date'];
                              $i++
                              ?>

                            <tr>
                              <td><?php echo  $i;?></td>
                              <td><?php echo  $sub_email;?></td>
                              <td class="text-center"><?php echo  $sub_date;?></td>
                              <td>
                            </tr>
                            <?php }  

                        ?>
                        </tbody>
                      </table>
                    </div>
                  </div>
      <?php }
            else{
              echo "<div class='alert alert-warning'>Sorry!!! you have no access in this page.</div>";
            }


          ?>
        </div>
        
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->


  <!-- Control Sidebar -->
<?php include "inc/sidebar.php" ?>
  <!-- /.control-sidebar -->

</div>
<!-- ./wrapper -->

<?php include "inc/footer.php" ?>


<!-- jQuery -->
<?php include "inc/script.php" ?>



<!-- <div class="card">
  <div class="card-header">

    <h3 class="card-title">Add new Category</h3>

  </div>
  <div class="card-body" style="display: block;">
  </div>   
</div> -->
