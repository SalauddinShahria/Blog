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
            <h1 class="m-0 text-dark">Manage Your Profile</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
              <li class="breadcrumb-item active">Profile</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
  
 

<section>
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-4">

      <div class="card">
        <div class="card-header profile-title">
          <h3 class="card-title">Your Profile</h3>
        </div>
        <div class="card-body user-profile">
          <?php
            $userID = $_SESSION['id'];
            $sql = "SELECT * FROM users WHERE id = '$userID' ";
            $theUser = mysqli_query($db, $sql);

            while ( $row = mysqli_fetch_assoc($theUser) ) {
              $id       = $row['id'];
              $name     = $row['name']; 
              $email    = $row['email']; 
              $password = $row['password']; 
              $address  = $row['address']; 
              $phone    = $row['phone']; 
              $role     = $row['role']; 
              $status   = $row['status']; 
              $image    = $row['image']; 
              $joindate = $row['joindate']; 
            }
          ?>
          <img src="img/users/<?php echo $image;?>" class="img img-fluid img-thumbnail">
          <table class="table table-sm table-hover table-bordered">
                    <tbody>
                      <tr>
                        <th scope="col">Name</th>
                        <td><?php echo $name;?></td>
                      </tr>
                      <tr>
                        <th scope="row">Email</th>
                        <td><?php echo $email;?></td>
                      </tr>
                      <tr>
                        <th scope="row">Phone No.</th>
                        <td><?php echo $phone;?></td>
                      <tr>
                        <th scope="row">Role</th>
                        <td>
                           <?php
                              if($role == 1){ ?>
                                <span class="badge badge-primary">Super Admin</span>
                              <?php }
                              else if($role == 2){ ?>
                                 <span class="badge badge-primary">Editor</span>
                              <?php }
                            ?>
                        </td>
                      </tr>
                      </tr>
                        <th scope="row">Status</th>
                        <td>
                          <?php
                            if($status == 0){ ?>
                              <span class="badge badge-danger">Inactive</span>
                            <?php }
                            else if($status == 1){ ?>
                               <span class="badge badge-success">Active</span>
                            <?php }
                          ?>
                        </td>
                      </tr>
                      <tr>
                        <th scope="row">Address</th>
                        <td><?php echo $address?></td>
                      </tr>
                      <tr>
                        <th scope="row">Join Date</th>
                        <td><?php echo $joindate?></td>
                      </tr>
                    </tbody>
                  </table>

        </div>

      </div>

      </div>
      <div class="col-md-8">
        <div class="card">
          <div class="card-header edit-title">
            <h3 class="card-title">Edit Your Profile</h3>
          </div>
          <div class="card-body">
             <?php
                $userID = $_SESSION['id'];
                $sql = "SELECT * FROM users WHERE id = '$userID' ";
                $theUser = mysqli_query($db, $sql);

                while ( $row = mysqli_fetch_assoc($theUser) ) {
                  $theID    = $row['id'];
                  $name     = $row['name']; 
                  $email    = $row['email'];  
                  $address  = $row['address']; 
                  $phone    = $row['phone']; 
                  $image    = $row['image'];
                  ?>

                  <div class="row">
                    <div class="col-lg-6">
                      <form action="" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                          <label>Full Name</label>
                          <input type="text" name="name" class="form-control" required="required" value="<?php echo $name;?>">
                        </div>
                        <div class="form-group">
                          <label>Email Address</label>
                          <input type="email" class="form-control" required="required" value="<?php echo $email;?>" readonly>
                        </div>
                        <div class="form-group">
                          <label>Phone No.</label>
                          <input type="text" name="phone" class="form-control" required="required" value="<?php echo $phone;?>" >
                        </div>       
                    </div>

                    <div class="col-lg-6">   
                        <div class="form-group">
                          <label>Address</label>
                          <input type="text" name="address" class="form-control" required="required" value="<?php echo $address;?>">
                        </div>
                        <div class="form-group">
                          <label>Upload Image</label>
                          <?php 
                            if(!empty($image)){?>
                              <img src="img\users\<?php echo $image; ?>" class="form-img">
                            <?php }
                            else{
                              echo "No image Uploaded";
                            }
                          ?>
                          <input type="file" name="image" class="form-control-file">
                        </div>
                        <div class="form-group">
                          <input type="hidden" name="userID" value="<?php echo $theID;?>">
                          <input type="submit" name="updateProfile" id="toasttest" class="btn btn-block btn-primary btn-flat" value="Save Changes">
                        </div>

                      </form>
                    </div>
                  </div>

                <?php }
              ?>

          </div>
        </div>

        <?php

          if(isset($_POST['updateProfile'])){
            $updateUser   = $_POST['userID'];
            $name         = $_POST['name'];
            $phone        = $_POST['phone'];
            $address      = $_POST['address'];

            //Preaper the image       
            $imageName = $_FILES['image']['name'];    
            $imageSize = $_FILES['image']['size'];
            $imageTmp = $_FILES['image']['tmp_name'];

            $imageAllowedExtension = array("jpg", "jpeg", "png");
            $imageExtension = explode('.', $imageName);
            $imageExtension = strtolower(end($imageExtension));

            if(!empty($imageName)){
                // Delete The Existing Image while update the new Image
                $deleteImageSQL = "SELECT * FROM users WHERE id = '$updateUser'";
                $data = mysqli_query($db, $deleteImageSQL);
                while($row = mysqli_fetch_assoc($data)){
                  $existingImage = $row['image'];
                }

                if( !empty( $existingImage) ){
                  unlink('img/users/'. $existingImage);
                }

                // Change the image Name
                $image = rand(0, 999999) . '_' . $imageName;
                // Upload the image to its own Folder Location
                move_uploaded_file($imageTmp, "img\users\\" . $image);

                $sql = "UPDATE users SET name='$name', email='$email', phone='$phone', address='$address', image='$image' WHERE id = '$updateUser' ";
                
                $addUser = mysqli_query($db, $sql);

                if($addUser){
                  header("Location: profile.php");
                }
                else{
                  die("MySQLi Query Failed". mysqli_error($db));
                }
              }

              // NO image update
              else{
                $sql = "UPDATE users SET name='$name', email='$email', phone='$phone', address='$address' WHERE id = '$updateUser' ";
                
                $addUser = mysqli_query($db, $sql);

                if($addUser){
                  header("Location: profile.php");
                }
                else{
                  die("MySQLi Query Failed". mysqli_error($db));
                }
              }


          }
        ?>

      </div>
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
