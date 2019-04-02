<?php include("includes/header.php"); ?>

<?php
    if(!$session->is_signed_in()) {
        redirect("login.php");
    }
 ?>

 <?php

 $page = !empty($_GET['page']) ? (int)$_GET['page'] : 1;
 $items_per_page = 4;
 $items_total_count = Photo::count_all();
 // $photos = Photo::find_all();

 $paginate = new Paginate($page, $items_per_page, $items_total_count);
 $sql = "SELECT * FROM photos ";
 $sql .= "LIMIT {$items_per_page} ";
 $sql .= "OFFSET {$paginate->offset()}";
 $photos = Photo::find_by_query($sql);
  // $photos = Photo::find_all();

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
                            Photos
                        </h1>
                        <p class="bg-success"><?= $message; ?></p>

                        <div class="col-md-12">
                          <ul class="pagination">
                            <?php
                              if($paginate->page_total() > 1) {

                                if($paginate->has_previous()) {
                                    echo "<li class='previous'><a href='photos.php?page={$paginate->previous()}'>Previous</a></li>";
                                }

                                for($i =1; $i <= $paginate->page_total(); $i++) {
                                  if($i == $paginate->current_page) {
                                      echo "<li class='active'><a href='photos.php?page={$i}'>{$i}</a> </li>";
                                  }else {
                                      echo "<li><a href='photos.php?page={$i}'>{$i}</a></li>";
                                  }
                                }


                                if($paginate->has_next()) {
                                  echo "<li class='next'><a href='photos.php?page={$paginate->next()}'>Next</a></li>";
                                }

                              }
                             ?>



                          </ul>
                          <table class="table table-hover">
                            <thead>
                              <tr>
                                <th>Photo</th>
                                <th>Id</th>
                                <th>File Name</th>
                                <th>Title</th>
                                <th>Size</th>
                                <th>Comments</th>
                              </tr>
                            </thead>

                            <tbody>
                              <?php  foreach ($photos as $photo):  ?>


                               <tr>
                                 <td><img class="admin-photo-thumbnail" src="<?= $photo->picture_path(); ?>" alt="" />
                                   <div class="action_link">
                                     <a class="delete_link" href="delete_photo.php?id=<?= $photo->id; ?>">Delete</a>
                                     <a href="edit_photo.php?id=<?= $photo->id; ?>">Edit</a>
                                     <a href="../photo.php?id=<?= $photo->id; ?>">View</a>
                                   </div>
                                 </td>
                                 <td><?= $photo->id; ?></td>
                                 <td><?= $photo->filename ?></td>
                                 <td><?= $photo->title; ?></td>
                                 <td><?= $photo->size; ?></td>
                                 <td>

                                   <?php

                                     $comments = Comment::find_the_comments($photo->id);
                                     if(count($comments) > 0) {
                                       echo "<a href='comment_photo.php?id=$photo->id'>";
                                       echo count($comments);
                                       echo "</a>";
                                     }else {
                                       echo count($comments);
                                     }

                                    ?>
                                 </td>
                               </tr>

                             <?php endforeach; ?>
                            </tbody>
                          </table><!--end Table-->


                        </div>


                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

  <?php include("includes/footer.php"); ?>
