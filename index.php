<?php include("includes/header.php"); ?>

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



 ?>




        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-12">

              <div class="row">
                <?php foreach ($photos as $photo): ?>



                    <div class="col-xs-6 col-md-3">

                      <div class="card">
                        <a class="" href="photo.php?id=<?= $photo->id; ?>"><img class="card-img-top" src="admin/<?= $photo->picture_path(); ?>" alt="">
                        </a>
                        <div class="card-body">
                          <h5 class="card-title"><?= $photo->title; ?></h5>
                          <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                          <a href="photo.php?id=<?= $photo->id; ?>" class="btn btn-primary">View more</a>
                        </div>
                      </div>

                    </div>

                <?php endforeach; ?>
              </div>


              <div class="row">
                <ul class="pager">
                  <?php
                    if($paginate->page_total() > 1) {
                      if($paginate->has_next()) {
                        echo "<li class='next'><a href='index.php?page={$paginate->next()}'>Next</a></li>";
                      }

                      ?>

                      <?php
                      for($i =1; $i <= $paginate->page_total(); $i++) {

                      ?>

                      <?php
                        if($i == $paginate->current_page) {
                            echo "<li class='active'><a href='index.php?page={$i}'>{$i}</a> </li>";
                        }else {
                            echo "<li><a href='index.php?page={$i}'>{$i}</a></li>";
                        }

                       ?>

                      <?php
                        }
                       ?>

                      <?php

                      if($paginate->has_previous()) {
                        echo "<li class='previous'><a href='index.php?page={$paginate->previous()}'>Previous</a></li>";
                      }
                    }
                   ?>



                </ul>
              </div>



            </div>


        </div>
        <!-- /.row -->

        <?php include("includes/footer.php"); ?>
