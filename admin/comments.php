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
              <li class="breadcrumb-item active">Comment Template</li>
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

                   <?php

                            $do = isset($_GET['do']) ? $_GET['do'] : 'Manage'; 

                            if($do== 'Manage'){ ?>
                              
                              <div class="card">
                                <div class="card-header">
                                  <h3 class="card-title">Manage All Comments</h3>
                                </div>
                                <div class="card-body" style="display: block;">
                                  <table id="datatable" class="table table-striped table-bordered table-dark table-hover">
                                    <thead>
                                      <tr>
                                        <th scope="col" class="text-center" style="width: 5px;">Sl.</th>
                                        <th scope="col" class="text-center" style="width: 10px;">Post title</th>
                                        <th scope="col" class="text-center" style="width: 10px;">Full Name</th>
                                        <th scope="col" class="text-center" style="width: 10px;">Email ID</th>
                                        <th scope="col" class="text-center" style="width: 10px;">Comments</th>
                                        <th scope="col" class="text-center" style="width: 5px;">Status</th>
                                        <th scope="col" class="text-center" style="width: 5px;">Join Date</th>
                                        <th scope="col" class="text-center" style="width: 45px;">Action</th>
                                      </tr>
                                    </thead>
                                    <tbody>

                                      <?php
                                        $sql = "SELECT * FROM comments WHERE cmt_status = 1 OR cmt_status = 2 ORDER BY cmt_id DESC";
                                        $allComments = mysqli_query($db, $sql);
                                        $i = 0;

                                        while($row = mysqli_fetch_assoc($allComments)){
                                          $cmt_id             = $row['cmt_id'];
                                          $cmt_desc           = $row['cmt_desc']; 
                                          $cmt_post_id        = $row['cmt_post_id']; 
                                          $cmt_author         = $row['cmt_author']; 
                                          $cmt_author_email   = $row['cmt_author_email']; 
                                          $cmt_status         = $row['cmt_status']; 
                                          $cmt_date           = $row['cmt_date'];
                                          $i++
                                        ?>

                                        <tr>
                                          <td><?php echo  $i;?></td>
                                          <td>
                                            <?php

                                              $sql = "SELECT * FROM post WHERE post_id = '$cmt_post_id;'";
                                              $postTitle = mysqli_query($db, $sql);

                                              while ($row = mysqli_fetch_assoc($postTitle)) {
                                                $post_id = $row['post_id'];
                                                $title = $row['title'];

                                                echo $title;
                                              }
                                            ?>
                                              
                                          </td>
                                          <td><?php echo  $cmt_author;?></td>
                                          <td><?php echo  $cmt_author_email;?></td>
                                          <td><?php echo  $cmt_desc;?></td>
                                          <td>
                                            <?php
                                              if($cmt_status == 1){ ?>
                                                <span class="badge badge-success">Published</span>
                                              <?php }
                                              else if($cmt_status == 2){ ?>
                                                <span class="badge badge-warning">Draft</span>
                                              <?php }
                                              else if($cmt_status == 3){ ?>
                                                <span class="badge badge-danger">Suspended</span>
                                              <?php }
                                            ?>
                                          </td>
                                          <td><?php echo  $cmt_date;?></td>
                                          <td class="project-actions">
                                            <!-- <a class="btn btn-primary btn-sm mr-2" href="#">
                                              <i class="fas fa-eye"></i>
                                            </a> -->
                                            <a class="btn btn-info btn-sm mr-2" href="comments.php?do=Edit&edit=<?php echo $cmt_id; ?>">
                                                <i class="fas fa-pencil-alt"></i>
                                              Edit
                                            </a>
                                            <a class="btn btn-danger btn-sm" href="" data-toggle="modal" data-target="#delete<?php echo $cmt_id;?>">
                                            Delete
                                            </a>
                                          </td>
                                        </tr>


                                      <!-- Modal -->
                                      <div class="modal fade" id="delete<?php echo $cmt_id;?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                          <div class="modal-content">
                                            <div class="modal-header">
                                              <h5 class="modal-title" id="staticBackdropLabel">Do you Confirm to Delete this Comment?</h5>
                                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                              </button>
                                            </div>
                                            <div class="modal-body">
                                              <div class="delete-option text-center" >
                                                <ul>
                                                  <li><a href="comments.php?do=Delete&delete=<?php echo $cmt_id;?>" id="toasttest" class="btn btn-danger">Delete</a></li>
                                                  <li><button type="button" class="btn btn-primary" data-dismiss="modal">Cancle</button></li>
                                                </ul>
                                              </div>
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                      <?php  }
                                      ?>

                                    </tbody>
                                  </table>
                                </div>   
                              </div>

                          <?php }
                            else if ($do == 'Edit'){ 
                              if(isset($_GET['edit'])){
                                $editCmtID = $_GET['edit'];

                                $sql = "SELECT * FROM comments WHERE cmt_id = $editCmtID";

                                $editCommentStatus = mysqli_query($db, $sql); 

                                while($row = mysqli_fetch_assoc($editCommentStatus)){
                                  $cmt_id       = $row['cmt_id'];
                                  $cmt_status   = $row['cmt_status']; 
                                ?>

                                      <div class="col-lg-12">
                                        <div class="card">
                                          <div class="card-header">

                                            <h3 class="card-title">Draft Or Published Comment</h3>

                                          </div>
                                          <div class="card-body" style="display: block;">
                                            <div class="row">
                                              <div class="col-lg-4 text-center">
                                                <p class="badge-success">Comment Status</p>
                                                <p>যদি কোন কমেন্ট বাজে, হিংসাত্মক বা অপ্রয়োজনীও হয় তাহলে ড্রাফট করুন। পুনরায় পাবলিশ করতে চাইলে পাবলিশড করুন।</p>
                                              </div>
                                              <div class="col-lg-8 text-center">
                                                <form action="comments.php?do=Update" method="POST">
                                                  <div class="form-group">
                                                    <label>Status</label>
                                                    <select name="cmt_status" class="form-control" value="<?php echo $cmt_id;?>" >
                                                      <option>Please Select Comment Status</option>
                                                      <option value="1" <?php if($cmt_status == 1){ echo "Selected";};?> >Published</option>
                                                      <option value="2" <?php if($cmt_status == 2){ echo "Selected";};?> >Draft</option>
                                                    </select>
                                                  </div>
                                                   <div class="form-group">
                                                    <input type="hidden" name="cmt_id" value="<?php echo $cmt_id;?>">
                                                    <input type="submit" name="submit" id="toasttest" class="btn btn-block btn-primary btn-flat" value="Save Changes">
                                                  </div>

                                                </form>
                                              </div>

                                            </div>
                                          </div>   
                                        </div>
                                      </div>

                              <?php } //End while
                              } // End if
                            } //End Main else if

                            else if ($do == 'Update'){
                              //Update start
                             if($_SERVER['REQUEST_METHOD'] == 'POST') {
                              $updateStatuID  = $_POST['cmt_id'];
                              $cmt_status     = $_POST['cmt_status'];   

                                  $sql = "UPDATE comments SET cmt_status='$cmt_status' WHERE cmt_id = '$updateStatuID' ";
                                  
                                  $result = mysqli_query($db, $sql);

                                  if($result){
                                    header("Location: comments.php?do=Manage");
                                  }
                                  else{
                                    die("MySQLi Query Failed". mysqli_error($db));
                                  }
                                }

                              //Update End
                            }
                            else if ($do == 'Delete'){
                              if(isset($_GET['delete'])){
                                $deleteCommentID = $_GET['delete'];

                                $sql = "UPDATE comments SET cmt_status= 3 WHERE cmt_id = '$deleteCommentID' ";
                                  
                                  $result = mysqli_query($db, $sql);

                                if($result){
                                  header("Location: comments.php?do=Manage");
                                }
                                else{
                                  die("MySQLi Query Failed". mysqli_error($db));
                                }   
                              }
                            }

                          ?>
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
