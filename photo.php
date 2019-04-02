<?php include("includes/header.php"); ?>
<?php

  if(empty($_GET['id'])) {
    redirect("index.php");
  }

  $photo = Photo::find_by_id($_GET['id']);

    if(isset($_POST['submit'])) {
      $author = trim($_POST['author']);
      $body = trim($_POST['body']);
      $date = date("Y-m-d");

      $new_comment = Comment::create_comment($photo->id, $author, $body, $date);


      if($new_comment && $new_comment->save()) {
        echo "works";
        redirect("photo.php?id={$photo->id}");
      }else {
        $message = "There was some problems saving";
      }
    }else {
      $author = "";
      $body = "";
      $message = "";
      $date = "";
    }

    // Comment::find_the_comments($photo->id);
    $comments = Comment::find_the_comments($photo->id);
 ?>

 <?php include("includes/header.php"); ?>
         <div class="row">
             <!-- Blog Entries Column -->
             <div class="col-md-8">

               <!-- Blog Post -->

               <!-- Title -->
               <h1><?= $photo->title; ?></h1>


               <!-- Author -->
               <p class="lead">
                   by <a href="#">Start Bootstrap</a>
               </p>

               <hr>

               <!-- Date/Time -->
                <p><span class="glyphicon glyphicon-time"></span> <?= $photo->date;?></p>

               <hr>

               <!-- Preview Image -->
                 <img class="img-responsive" src="admin/<?= $photo->picture_path(); ?>" alt="">

               <hr>

               <p class="lead"><?= $photo->caption; ?></p>

               <div class="">
                 <?= $photo->description; ?>
               </div>



               <!-- Post Content -->
               <?= $photo->description; ?>

               <hr>

               <!-- Blog Comments -->

               <!-- Comments Form -->
               <div class="well">
                   <h4>Leave a Comment:</h4>

                   <form action="" role="form" method="post">
                     <div class="form-group">
                       <label for="author">Author</label>
                       <input type="text" name="author" class="form-control">
                     </div>
                       <div class="form-group">
                         <label for="comment">Comment</label>
                           <textarea class="form-control" name=body rows="3"></textarea>
                       </div>
                       <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                   </form>
               </div>

               <hr>

               <!-- Posted Comments -->

                <?php foreach ($comments as $comment): ?>

                  <div class="media">
                    <a href="#" class="pull-left">
                      <img src="http::/placeholder.it/64x64" alt="">
                    </a>
                    <div class="media-body">
                      <h4 class="media-heading"><?= $comment->author; ?>
                        <small><?= $comment->date; ?></small>
                      </h4>
                      <?= $comment->body; ?>
                    </div>
                  </div>

                <?php endforeach; ?>

             </div>

             <!-- Blog Sidebar Widgets Column -->
             <div class="col-md-4">

                  <?php include("includes/sidebar.php"); ?>
            </div>

         </div>
         <!-- /.row -->

         <?php include("includes/footer.php"); ?>
