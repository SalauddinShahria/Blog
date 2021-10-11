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
            if($_SESSION['role'] == 1){ ?>
                <div class="col-lg-12">

                   <?php

                            $do = isset($_GET['do']) ? $_GET['do'] : 'Manage'; 

                            if($do== 'Manage'){ ?>
                              
                              <div class="card">
                                <div class="card-header">
                                  <h3 class="card-title">Managel All Users</h3>
                                </div>
                                <div class="card-body" style="display: block;">
                                  <table id="datatable" class="table table-striped table-bordered table-hover table-dark">
                                    <thead>
                                      <tr>
                                        <th scope="col" class="text-center">Sl.</th>
                                        <th scope="col" class="text-center">Image</th>
                                        <th scope="col" class="text-center">Full Name</th>
                                        <th scope="col" class="text-center">Email</th>
                                        <th scope="col" class="text-center">Address</th>
                                        <th scope="col" class="text-center">Phone</th>
                                        <th scope="col" class="text-center">User Role</th>
                                        <th scope="col" class="text-center">Status</th>
                                        <th scope="col" class="text-center">Join Date</th>
                                        <th scope="col" class="text-center">Action</th>
                                      </tr>
                                    </thead>
                                    <tbody>

                                      <?php
                                        $sql = "SELECT * FROM users";
                                        $allUsers = mysqli_query($db, $sql);
                                        $i = 0;

                                        while($row = mysqli_fetch_assoc($allUsers)){
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
                                          $i++
                                        ?>

                                        <tr>
                                          <td><?php echo  $i;?></td>
                                          <td>
                                            <?php 
                                              if(!empty($image)){ ?>
                                                 <img src="img\users\<?php echo $image; ?>" class="table-img">
                                              <?php }
                                              else{ ?>
                                                <img src="img\users\default.png" class="table-img">
                                              <?php }
                                            ?>
                                          </td>
                                          <td><?php echo  $name;?></td>
                                          <td><?php echo  $email;?></td>
                                          <td><?php echo  $address;?></td>
                                          <td><?php echo  $phone;?></td>
                                          <td>
                                            <?php
                                              if($role == 1){ ?>
                                                <span class="badge badge-primary">Super Admin</span>
                                              <?php }
                                              else if($role == 2){ ?>
                                                 <span class="badge badge-success">Editor</span>
                                              <?php }
                                            ?>
                                          </td>
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
                                          <td><?php echo  $joindate;?></td>
                                          <td class="project-actions">
                                            <!-- <a class="btn btn-primary btn-sm mr-2" href="#">
                                              <i class="fas fa-eye"></i>
                                            </a> -->
                                            <a class="btn btn-info btn-sm mr-2" href="users.php?do=Edit&edit=<?php echo $id; ?>">
                                                <i class="fas fa-pencil-alt"></i>
                                              Edit
                                            </a>

                                            <?php
                                              if($role == 1){

                                              }
                                              else if($role == 2){ ?>
                                            <a class="btn btn-danger btn-sm" href="" data-toggle="modal" data-target="#delete<?php echo $id;?>">
                                            Delete
                                            </a>
                                              <?php }
                                            ?>
                                          </td>
                                        </tr>


                                      <!-- Modal -->
                                      <div class="modal fade" id="delete<?php echo $id;?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                          <div class="modal-content">
                                            <div class="modal-header">
                                              <h5 class="modal-title" id="staticBackdropLabel">Do you Confirm to Delete this User?</h5>
                                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                              </button>
                                            </div>
                                            <div class="modal-body">
                                              <div class="delete-option text-center" >
                                                <ul>
                                                  <li><a href="users.php?do=Delete&delete=<?php echo $id;?>" id="toasttest" class="btn btn-danger">Delete</a></li>
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
                            else if ($do == 'Add'){ ?>
                              <div class="col-lg-12">
                                <div class="card">
                                  <div class="card-header">

                                    <h3 class="card-title">Add New User</h3>

                                  </div>
                                  <div class="card-body" style="display: block;">
                                    <div class="row">
                                      <div class="col-lg-6">
                                        <form action="users.php?do=Insert" method="POST" enctype="multipart/form-data">
                                          <div class="form-group">
                                            <label>Full Name</label>
                                            <input type="text" name="name" class="form-control" required="required">
                                          </div>
                                          <div class="form-group">
                                            <label>Email Address</label>
                                            <input type="email" name="email" class="form-control" required="required">
                                          </div>
                                          <div class="form-group">
                                            <label>Password</label>
                                            <input type="password" name="password" class="form-control" required="required">
                                          </div>
                                          <div class="form-group">
                                            <label>ReType Password</label>
                                            <input type="password" name="repassword" class="form-control" required="required">
                                          </div>
                                      </div>

                                      <div class="col-lg-6">
                                          <div class="form-group">
                                            <label>Address</label>
                                            <input type="text" name="address" class="form-control" required="required">
                                          </div>
                                          <div class="form-group">
                                            <label>Phone No.</label>
                                            <input type="text" name="phone" class="form-control" required="required">
                                          </div>
                                          <div class="form-group">
                                            <label>User Roll</label>
                                            <select name="role" class="form-control">
                                              <option>Please Select User Role</option>
                                              <option value="1">Super Admin</option>
                                              <option value="2">Editor</option>
                                            </select>
                                          </div>
                                          <div class="form-group">
                                            <label>Account Status</label>
                                            <select name="status" class="form-control">
                                              <option>Please Select User Account Status</option>
                                              <option value="0">Inactive</option>
                                              <option value="1">Active</option>
                                            </select>
                                          </div>
                                          <div class="form-group">
                                            <label>Upload Image</label>
                                            <input type="file" name="image" class="form-control-file">
                                          </div>
                                          <div class="form-group">
                                            <input type="submit" name="addUser" class="btn btn-block btn-primary btn-flat" value="Register">
                                          </div>

                                        </form>
                                      </div>

                                    </div>
                                  </div>   
                                </div>
                              </div>

                            <?php }

                            else if ($do == 'Insert'){
                              if($_SERVER['REQUEST_METHOD'] == 'POST') {
                                $name       = $_POST['name'];    
                                $email      = $_POST['email'];    
                                $password   = $_POST['password'];    
                                $repassword = $_POST['repassword'];    
                                $address    = $_POST['address'];    
                                $phone      = $_POST['phone'];    
                                $role       = $_POST['role'];    
                                $status     = $_POST['status'];

                                //Preaper the image       
                                $imageName = $_FILES['image']['name'];    
                                $imageSize = $_FILES['image']['size'];
                                $imageTmp = $_FILES['image']['tmp_name'];

                                $imageAllowedExtension = array("jpg", "jpeg", "png");
                                $imageExtension = explode('.', $imageName);
                                $imageExtension = strtolower(end($imageExtension));

                                $formErrors = array();

                                if(strlen($name) < 3){
                                  $formErrors = 'username is too short!!!';
                                }
                                if($password != $repassword){
                                  $formErrors = 'password don\'t match';
                                }
                                if(!empty($imageName)){
                                  if(!empty($imageName) && !in_array($imageExtension, $imageAllowedExtension)){
                                    $formErrors = 'Invalid image format. Please upload a JPG, JPEG or PNG image'; 
                                  }
                                  if(!empty($imageSize) && $imageSize > 2097152){
                                    $formErrors = 'Image size id Too Large. Allowed image size Max is 2 MB';
                                  }
                                }

                                foreach($formErrors as $error){
                                  echo '<div class="alert alert-warning">' . $error . '</div>';
                                }
                                if (empty($formErrors)){
                                  //Encrypted Password
                                  $hassedPass = sha1($password);
                                  // Change the image Name

                                  if( !empty($imageName) ){
                                    $image = rand(0, 999999) . '_' . $imageName;
                                    // Upload the image to its own Folder Location
                                    move_uploaded_file($imageTmp, "img\users\\" . $image);

                                    $sql = "INSERT INTO users (name, email, password, address, phone, role, status, image, joindate) VALUES ('$name', '$email', ' $hassedPass', '$address', '$phone', '$role', '$status', '$image', now() )";
                                    
                                    $addUser = mysqli_query($db, $sql);

                                    if($addUser){
                                      header("Location: users.php?do=Manage");
                                    }
                                    else{
                                      die("MySQLi Query Failed". mysqlierror($db));
                                    }
                                  }
                                  else{
                                    $sql = "INSERT INTO users (name, email, password, address, phone, role, status, joindate) VALUES ('$name', '$email', ' $hassedPass', '$address', '$phone', '$role', '$status', now() )";
                                    
                                    $addUser = mysqli_query($db, $sql);

                                    if($addUser){
                                      header("Location: users.php?do=Manage");
                                    }
                                    else{
                                      die("MySQLi Query Failed". mysqlierror($db));
                                    }
                                  }

                                  
                                }


                              }
                            }
                            
                            else if ($do == 'Edit'){ 
                              if(isset($_GET['edit'])){
                                $editID = $_GET['edit'];

                                $sql = "SELECT * FROM users WHERE id = $editID";

                                $readUsers = mysqli_query($db, $sql); 

                                while($row = mysqli_fetch_assoc($readUsers)){
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
                                ?>

                                      <div class="col-lg-12">
                                        <div class="card">
                                          <div class="card-header">

                                            <h3 class="card-title">Update User Information</h3>

                                          </div>
                                          <div class="card-body" style="display: block;">
                                            <div class="row">
                                              <div class="col-lg-6">
                                                <form action="users.php?do=Update" method="POST" enctype="multipart/form-data">
                                                  <div class="form-group">
                                                    <label>Full Name</label>
                                                    <input type="text" name="name" class="form-control" required="required" value="<?php echo $name;?>">
                                                  </div>
                                                  <div class="form-group">
                                                    <label>Email Address</label>
                                                    <input type="email" name="email" class="form-control" required="required" value="<?php echo $email;?>">
                                                  </div>
                                                  <div class="form-group">
                                                    <label>Password</label>
                                                    <input type="password" name="password" class="form-control" placeholder="Change the password">
                                                  </div>
                                                  <div class="form-group">
                                                    <label>RetypePassword</label>
                                                    <input type="password" name="repassword" class="form-control" placeholder="Retype the password">
                                                  </div>
                                                  <div class="form-group">
                                                    <label>Address</label>
                                                    <input type="text" name="address" class="form-control" required="required" value="<?php echo $address;?>">
                                                  </div>
                                                  
                                              </div>

                                              <div class="col-lg-6">
                                                  <div class="form-group">
                                                    <label>Phone No.</label>
                                                    <input type="text" name="phone" class="form-control" required="required" value="<?php echo $phone;?>" >
                                                  </div>
                                                  <div class="form-group">
                                                    <label>User Roll</label>
                                                    <select name="role" class="form-control" value="<?php echo $role;?>" >
                                                      <option>Please Select User Role</option>
                                                      <option value="1" <?php if($role == 1){ echo "Selected";};?> >Super Admin</option>
                                                      <option value="2" <?php if($role == 2){ echo "Selected";};?> >Editor</option>
                                                    </select>
                                                  </div>
                                                  <div class="form-group">
                                                    <label>Account Status</label>
                                                    <select name="status" class="form-control" value="<?php echo $status;?>" >
                                                      <option>Please Select User Account Status</option>
                                                      <option value="0" <?php if($status == 0){ echo "Selected";}?> >Inactive</option>
                                                      <option value="1" <?php if($status == 1){ echo "Selected";}?> >Active</option>
                                                    </select>
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
                                                    <input type="hidden" name="updateUserID" value="<?php echo $id;?>">
                                                    <input type="submit" name="updateUser" id="toasttest" class="btn btn-block btn-primary btn-flat" value="Save Changes">
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
                              $updateUserID = $_POST['updateUserID'];
                              $name         = $_POST['name'];    
                              $email        = $_POST['email'];    
                              $password     = $_POST['password'];    
                              $repassword   = $_POST['repassword'];    
                              $address      = $_POST['address'];    
                              $phone        = $_POST['phone'];    
                              $role         = $_POST['role'];    
                              $status       = $_POST['status'];
                              $imageName = $_FILES['image']['name']; 

                              if(!empty( $imageName)){

                              //Preaper the image       
                              // $imageName = $_FILES['image']['name'];    
                              $imageSize = $_FILES['image']['size'];
                              $imageTmp = $_FILES['image']['tmp_name'];

                              $imageAllowedExtension = array("jpg", "jpeg", "png");
                              $imageExtension = explode('.', $imageName);
                              $imageExtension = strtolower(end($imageExtension));

                              $formErrors = array();

                              if(strlen($name) < 3){
                                $formErrors = 'username is too short!!!';
                              }
                              if($password != $repassword){
                                $formErrors = 'password don\'t match';
                              }
                              if(!empty($imageName)){
                                if(!empty($imageName) && !in_array($imageExtension, $imageAllowedExtension)){
                                  $formErrors = 'Invalid image format. Please upload a JPG, JPEG or PNG image'; 
                                }
                                if(!empty($imageSize) && $imageSize > 2097152){
                                  $formErrors = 'Image size id Too Large. Allowed image size Max is 2 MB';
                                }
                              }
                              }

                              foreach($formErrors as $error){
                                echo '<div class="alert alert-warning">' . $error . '</div>'; 
                              }
                              if (empty($formErrors)){

                                //Upload image and change the Password
                                if(!empty($password) && !empty($imageName)){
                                  //Encrypted Password
                                  $hassedPass = sha1($password);

                                  // Delete The Existing Image while update the new Image
                                  $deleteImageSQL = "SELECT * FROM users WHERE id = '$updateUserID'";
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

                                  $sql = "UPDATE users SET name='$name', email='$email', password='$hassedPass', address='$address', phone='$phone', role='$role', status='$status', image='$image' WHERE id = '$updateUserID' ";
                                  
                                  $addUser = mysqli_query($db, $sql);

                                  if($addUser){
                                    header("Location: users.php?do=Manage");
                                  }
                                  else{
                                    die("MySQLi Query Failed". mysqli_error($db));
                                  }
                                }

                                // Change the Image Only
                                else if (!empty($imageName) && empty($password)){
                                  // Delete The Existing Image while update the new Image
                                  $deleteImageSQL = "SELECT * FROM users WHERE id = '$updateUserID'";
                                  $data = mysqli_query($db, $deleteImageSQL);
                                  while($row = mysqli_fetch_assoc($data)){
                                    $existingImage = $row['image'];
                                  }
                                  unlink('img/users/'. $existingImage);


                                  // Change the image Name
                                  $image = rand(0, 999999) . '_' . $imageName;
                                  // Upload the image to its own Folder Location
                                  move_uploaded_file($imageTmp, "img\users\\" . $image);

                                  $sql = "UPDATE users SET name='$name', email='$email', address='$address', phone='$phone', role='$role', status='$status', image='$image' WHERE id = '$updateUserID' ";
                                  
                                  $addUser = mysqli_query($db, $sql);

                                  if($addUser){
                                    header("Location: users.php?do=Manage");
                                  }
                                  else{
                                    die("MySQLi Query Failed". mysqli_error($db));
                                  }
                                }

                                // Change the Password Only
                                else if (!empty($password) && empty($imageName)){
                                  //Encrypted Password
                                  $hassedPass = sha1($password);

                                  // Change the image Name
                                  $image = rand(0, 999999) . '_' . $imageName;
                                  // Upload the image to its own Folder Location
                                  move_uploaded_file($imageTmp, "img\users\\" . $image);

                                  $sql = "UPDATE users SET name='$name', email='$email', password='$hassedPass', address='$address', phone='$phone', role='$role', status='$status' WHERE id = '$updateUserID' ";
                                  
                                  $addUser = mysqli_query($db, $sql);

                                  if($addUser){
                                    header("Location: users.php?do=Manage");
                                  }
                                  else{
                                    die("MySQLi Query Failed". mysqli_error($db));
                                  }
                                }

                                // NO password and image update
                                else{
                                  $sql = "UPDATE users SET name='$name', email='$email', address='$address', phone='$phone', role='$role', status='$status' WHERE id = '$updateUserID' ";
                                  
                                  $addUser = mysqli_query($db, $sql);

                                  if($addUser){
                                    header("Location: users.php?do=Manage");
                                  }
                                  else{
                                    die("MySQLi Query Failed". mysqli_error($db));
                                  }
                                }
                          
                                }
                              }
                              //Update End
                            }
                            else if ($do == 'Delete'){
                              if(isset($_GET['delete'])){
                                $deleteID = $_GET['delete'];

                                // Delete The Existing Image while Delete the user account
                                $deleteImageSQL = "SELECT * FROM users WHERE id = '$deleteID'";
                                $data = mysqli_query($db, $deleteImageSQL);
                                while($row = mysqli_fetch_assoc($data)){
                                  $existingImage = $row['image'];
                                }
                                unlink('img/users/'. $existingImage);

                                //Delete the user data from db
                                $sql = "DELETE FROM users WHERE id = '$deleteID' AND role = 2";
                                $deleteUserData = mysqli_query($db, $sql);


                                if($deleteUserData){
                                  header("Location: users.php?do=Manage");
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
