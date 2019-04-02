<?php include("includes/header.php"); ?>

<?php
    if(!$session->is_signed_in()) {
        redirect("login.php");
    }
 ?>

  <?php

  $user = new User();

    // $user = User::find_by_id($_GET['id']);

    if(isset($_POST['create'])) {
      if($user) {
        $user->username = $_POST['username'];
        $user->first_name = $_POST['first_name'];
        $user->last_name = $_POST['last_name'];
        $user->password = $_POST['password'];
        $user->user_image = $_FILES['user_image'];

        $user->set_file($user->user_image);
        $user->upload_photo();
        $user->save();
        redirect("users.php");
        $session->message("The user {$user->username} has been created");
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

                        <form action="" method="post" enctype="multipart/form-data">

                            <div class="col-md-6 col-md-offset-3">
                              <div class="form-group">
                                <label for="username">User image</label>
                                  <input type="file" name="user_image">
                              </div>

                                <div class="form-group">
                                  <label for="username">Username</label>
                                    <input type="text" name="username" class="form-control">
                                </div>

                                <div class="form-group">
                                    <label for="first_name">First Name</label>
                                    <input type="text" name="first_name" class="form-control">
                                </div>

                                <div class="form-group">
                                    <label for="last_name">Last Name</label>
                                    <input type="text" name="last_name" class="form-control">
                                </div>

                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password" name="password" class="form-control">
                                </div>

                                <div class="form-group">
                                    <input type="submit" name="create" class="btn btn-primary pull-right">
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
