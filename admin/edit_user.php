<?php include("includes/header.php"); ?>
<?include('includes/photo_library_modal.php') ?>

<?php
    if(!$session->is_signed_in()) {
        redirect("login.php");
    }
 ?>

  <?php

  if(empty($_GET['id'])) {
    redirect("users.php");
  }

  $user = User::find_by_id($_GET['id']);

  if(isset($_POST['update'])) {
    if($user) {
      $user->username = $_POST['username'];
      $user->first_name = $_POST['first_name'];
      $user->last_name = $_POST['last_name'];
      $user->password = $_POST['password'];
      $user->user_image = $_FILES['user_image'];

      if(empty($user->user_image)) {
        $user->save();
        redirect("users.php");
        $session->message("The user {$user->username} has been updated");
      }else {
        $user->set_file($user->user_image);
        $user->upload_photo();
        // redirect("edit_user.php?id={$user->id}");
        $session->message("The user {$user->username} has been updated");
        redirect("users.php");
      }
    }
  }



   ?>

        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <?php include("includes/top_nav.php") ?>
            <?php include("includes/side_nav.php") ?>
        </nav>

        <div id="page-wrapper">

                <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Edit user
                        </h1>

                        <div class="col-md-6 user_image_box">
                          <a href="javascript:;" data-toggle="modal" data-target="#photo-library">
                            <img class="img-responsive " src="<?= $user->image_path_placeholder(); ?>" alt="<?= $user->username; ?>">
                         </a>
                        </div>

                        <form action="" method="post" enctype="multipart/form-data">


                            <div class="col-md-6">
                              <div class="form-group">
                                <label for="username">User image</label>
                                  <input type="file" name="user_image">
                              </div>

                                <div class="form-group">
                                  <label for="username">Username</label>
                                    <input type="text" name="username" class="form-control" value="<?= $user->username; ?>">
                                </div>

                                <div class="form-group">
                                    <label for="first_name">First Name</label>
                                    <input type="text" name="first_name" class="form-control" value="<?= $user->first_name; ?>">
                                </div>

                                <div class="form-group">
                                    <label for="last_name">Last Name</label>
                                    <input type="text" name="last_name" class="form-control" value="<?= $user->last_name; ?>">
                                </div>

                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password" name="password" class="form-control" value="<?= $user->password; ?>">
                                </div>

                                <div class="form-group">
                                  <a  id="user-id" class="btn btn-danger pull-left" href="delete_user.php?id=<?= $user->id; ?>">Delete</a>
                                </div>

                                <div class="form-group">
                                    <input type="submit" name="update" class="btn btn-primary pull-right" value="Update">
                                </div>


                            </div><!--end form-->


                      </form>

                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->




  <?php include("includes/footer.php"); ?>
