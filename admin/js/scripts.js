function ckEditor() {
  ClassicEditor
      .create( document.querySelector( '#editor' ), {
          toolbar: [ 'heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote' ],
          heading: {
              options: [
                  { model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },
                  { model: 'heading1', view: 'h1', title: 'Heading 1', class: 'ck-heading_heading1' },
                  { model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2' }
              ]
          }
      } )
      .catch( error => {
          //console.log( error );
      } );
}


function photoModal() {
  var user_href;
  var user_href_splited;
  var user_id;

  var image_src;
  var image_src_splited;
  var image_name;
  var photo_id;

  /*************************Edit Photo************************/

  $(".info-box-header").on('click', function() {
    $(".inside").slideToggle("faset");
    $("#toggle").toggleClass("glyphicon glyphicon-menu-down, glyphicon glyphicon-menu-up");
  });

  $('.modal_thumbnails').on('click', function() {
    $('#set_user_image').prop('disabled', false);

    user_href = $("#user-id").prop('href');
    user_href_splited = user_href.split("=");
    user_id = user_href_splited[user_href_splited.length -1];

    image_src = $(this).prop("src");
    image_src_splited = image_src.split("/");
    image_name = image_src_splited[image_src_splited.length -1];

    photo_id = $(this).attr('data');

    $.ajax({
      url: "includes/ajax_code.php",
        data: {photo_id: photo_id},
        type: "POST",
        success: function(data) {
          if(!data.error) {
            $("#modal_sidebar").html(data);
          }
      }
    });

  });

    $('#set_user_image').on('click', function() {
      $.ajax({
        url: "includes/ajax_code.php",
        data: {image_name: image_name, user_id: user_id},
        type: "POST",
        success: function(data) {
          if(!data.error) {
            $(".user_image_box a img").prop('src', data);
          }
        }
      });
    });

    /***********Delete Function*********************/

    $(".delete_link").on('click', function() {
      return
      confirm("Are you sure you want to delete this item");
    });

}




function init() {
  photoModal();
  ckEditor();

}
window.onload = init;
