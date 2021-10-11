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
              <li class="breadcrumb-item active">Manage All Category</li>
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

          <!-- Left side Start -->
          <div class="col-lg-6">
            <!-- Add new category start-->
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">Add new Category</h3>

                    <div class="card-tools">
                      <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                        <i class="fas fa-minus"></i>
                      </button>
                      <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                        <i class="fas fa-times"></i>
                      </button>
                    </div>
                  </div>
                  <div class="card-body" style="display: block;">

                  <form action="" method="POST">
                    <div class="form-group">
                      <label>Name</label>
                      <input type="text" name="name" class="form-control" autocomplete="off" required="required"> 
                    </div>
                    <div class="form-group">
                      <label>Description</label>
                      <textarea name="decs" class="form-control"></textarea> 
                    </div>
                    <div class="form-group">
                      <label>Primary Category</label>
                      <select class="form-control" name="is_parent">
                        <option value="0">Please Select the Primary Category</option>
                          <?php
                            $query = "SELECT * FROM category WHERE is_parent = '0' ";
                            $primary_category = mysqli_query($db, $query);
                            while($row = mysqli_fetch_assoc($primary_category)){
                              $cat_id   = $row['cat_id'];
                              $cat_name = $row['cat_name'];
                              ?>
                              <option value="<?php echo $cat_id;?>"><?php echo $cat_name;?></option>
                              <?php }
                            ?>
                      </select>
                    </div>
                    <div class="form-group">
                      <label>Status</label>
                      <select class="form-control" name="status">
                        <option value="1">Plase Select the category status</option>
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
                      </select>
                    </div>
                    <div class="form-group">
                      <input type="submit" name="addCategory" id="toasttest" class="btn btn-block btn-primary btn-flat" value="Add New Category">
                    </div>
                  </form>

                  <?php
                    if(isset($_POST['addCategory'])){
                      $name       = $_POST['name'];
                      $decs       = $_POST['decs'];
                      $is_parent  = $_POST['is_parent'];
                      $status     = $_POST['status'];

                      $sql = "INSERT INTO category (cat_name, cat_decs, is_parent, cat_status) VALUES('$name', '$decs', '$is_parent', '$status')";

                      $catSuccess = mysqli_query($db, $sql);

                      if($catSuccess){
                        header("Location: category.php");
                      }
                      else{
                        die("mySql connection field." . mysqli_error($db));
                      }

                    }
                  ?>

                  </div>
                  <!-- /.card-body -->
                </div>
            <!-- Add new category end -->
          </div>
          <!-- Left side End-->

          <!-- right side Start -->
          <div class="col-lg-6">
            
            <!-- Edit form Start -->
            <?php
              if(isset( $_GET['edit'] )){
                $editID = $_GET['edit'];

                $sql = "SELECT * FROM category WHERE cat_id = '$editID' ";
                $editCat = mysqli_query($db, $sql);
           
                while ($row = mysqli_fetch_assoc($editCat)) {
                  $cat_id     = $row['cat_id'];
                  $cat_name   = $row['cat_name'];
                  $cat_decs   = $row['cat_decs'];
                  $is_parent  = $row['is_parent'];
                  $cat_status = $row['cat_status'];
                  ?> 

                    <div class="card">
                      <div class="card-header">
                        <h3 class="card-title">Update Category Information</h3>

                        <div class="card-tools">
                          <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                            <i class="fas fa-minus"></i>
                          </button>
                          <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                            <i class="fas fa-times"></i>
                          </button>
                        </div>
                      </div>
                      <div class="card-body" style="display: block;">

                      <form action="" method="POST">
                        <div class="form-group">
                          <label>Name</label>
                          <input type="text" name="name" class="form-control" value="<?php echo $cat_name; ?>" autocomplete="off" required="required"> 
                        </div>
                        <div class="form-group">
                          <label>Description</label>
                          <textarea name="decs" class="form-control"><?php echo $cat_decs; ?></textarea> 
                        </div>
                        <div class="form-group">
                          <label>Primary Category</label>
                          <select class="form-control" name="is_parent">
                            <option value="0">Please Select the Primary Category</option>
                              <?php
                                $query = "SELECT * FROM category WHERE is_parent = '0'";
                                $primary_category = mysqli_query($db, $query);
                                while($row = mysqli_fetch_assoc($primary_category)){
                                  $category_id  = $row['cat_id'];
                                  $cat_name     = $row['cat_name'];
                                  ?>
                                  <option value="<?php echo $category_id;?>"<?php if($category_id == $is_parent){ echo 'Selected';}?>><?php echo $cat_name;?></option>
                                  <?php }
                                ?>
                          </select>
                        </div>
                        <div class="form-group">
                          <label>Status</label>
                          <select class="form-control" name="status">
                            <option value="1">Plase Select the category status</option>
                            <option value="1" <?php if($cat_status  == 1) { echo 'selected';} ?>> Active</option>
                            <option value="0" <?php if($cat_status  == 0) { echo 'selected';} ?>> Inactive</option>
                          </select>
                        </div>
                        <div class="form-group">
                          <input type="hidden" name="editID" value="<?php echo $cat_id ?>">
                          <input type="submit" name="updateCategory" class="btn btn-block btn-primary btn-flat" value="Update Category">
                        </div>
                      </form>

                        <?php
                          if(isset($_POST['updateCategory'])){
                            $name       = $_POST['name'];
                            $decs       = $_POST['decs'];
                            $is_parent  = $_POST['is_parent'];
                            $status     = $_POST['status'];
                            $editID     = $_POST['editID'];

                            $sql = "UPDATE category SET cat_name ='$name', cat_decs='$decs', is_parent='$is_parent', cat_status='$status' WHERE cat_id = '$editID' ";
                            
                            $editSuccess = mysqli_query($db, $sql);

                            if($editSuccess){
                              header("Location: category.php");
                            }
                            else{
                              die("mySql connection field." . mysqli_error($db));
                            }

                          }
                        ?>

                      </div>
                      <!-- /.card-body -->
                    </div>

               <?php }

              }
            ?>
            <!-- Edit form End -->

            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Manage All Category</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <div class="card-body p-0" style="display: block;">
                <table id="datatable" class="table table-striped projects">
                    <thead>
                        <tr>
                            <th style="width: 10%">
                                #SL.
                            </th>
                            <th style="width: 20%">
                                Category Name
                            </th>
                            <th style="width: 20%">
                                Primary Category
                            </th>
                            <th style="width: 20%">
                                Status
                            </th>
                            
                            <th style="width: 30%">
                                Action
                            </th>
      
                        </tr>
                    </thead>
                    <tbody>

                        <?php
                          $sql = "SELECT * FROM Category";
                          $allCat = mysqli_query($db, $sql);
                          $i = 0;

                          while ($row = mysqli_fetch_assoc($allCat)) {
                            $cat_id     = $row['cat_id'];
                            $cat_name   = $row['cat_name'];
                            $cat_decs   = $row['cat_decs'];
                            $is_parent   = $row['is_parent'];
                            $cat_status  = $row['cat_status'];
                            $i++;
                            ?>

                            <tr>
                                <td><?php echo $i; ?></td>
                                <td><?php echo $cat_name; ?></td>
                                <td>
                                  <?php
                                    if($is_parent == 0){ ?>
                                      <div class="badge badge-primary">Primary Category</div>
                                  <?php  }
                                    else{
                                      $query = "SELECT * FROM category WHERE cat_id = '$is_parent'";
                                      $primary_cat = mysqli_query($db, $query);

                                      while($row = mysqli_fetch_assoc($primary_cat)){
                                        $p_cat_id = $row['cat_id'];
                                        $cat_name = $row['cat_name'];
                                      } ?>
                                      <div class="badge badge-info"><?php echo $cat_name;?></div>
                                    <?php }
                                  ?>
                                </td>
                                <td>
                                  <?php
                                    if($cat_status == 0){ ?>
                                      <span class="badge badge-danger">Inactive</span>
                                    <?php }
                                    else if($cat_status == 1){ ?>
                                      <span class="badge badge-success">Active</span>
                                    <?php }
                                  ?>
                                </td>

                                <td class="project-actions">
                                  <!--   <a class="btn btn-primary btn-sm" href="#">
                                        <i class="fas fa-folder">
                                        </i>
                                        View
                                    </a>
                                  -->  
                                  <a class="btn btn-info btn-sm" href="category.php?edit=<?php echo $cat_id; ?>">
                                        <i class="fas fa-pencil-alt">
                                        </i>
                                        Edit
                                    </a>
                                    <a class="btn btn-danger btn-sm" href="#" data-toggle="modal" data-target="#delete<?php echo $cat_id; ?>">
                                        <i class="fas fa-trash">
                                        </i>
                                        Delete
                                    </a>
                                </td>
                            </tr>
                            <!-- Delete Modal -->
                            <div class="modal fade" id="delete<?php echo $cat_id?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                              <div class="modal-dialog">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Do you Confirm to delete this Category?</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>
                                  <div class="modal-body text-center">
                                    <form action="" method="POST">
                                      <button type="button" class="btn btn-success" data-dismiss="modal">Cancel</button>
                                      <input type="hidden" name="deleteID" id="toasttest" value="<?php echo $cat_id; ?>">
                                      <button type="submit" name="deleteCat" class="btn btn-danger">Confirm</button>
                                    </form>
                                    
                                  </div>
                                </div>
                              </div>
                            </div>


                        <?php  }
                        ?> 

                    </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>

          </div>
          <!-- right side End -->

          <?php
            if(isset($_POST['deleteCat'])){
              $deleteID = $_POST['deleteID'];

              $sql = "DELETE FROM category WHERE cat_id = $deleteID";
              $deleteSuccess = mysqli_query($db, $sql);

              if($deleteSuccess){
                header("Location: category.php");
              }
              else{
                die("mySql connection feild" . mysqli_error($db));
              }

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