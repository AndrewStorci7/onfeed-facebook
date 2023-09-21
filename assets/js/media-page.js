function upload(input) {
  var img         = input.value;
  var ext         = img.substring(img.lastIndexOf('.') + 1).toLowerCase();
  var form_data   = new FormData();
  form_data.append('file', input.files[0]);
  if(input.files && input.files[0] && (ext == "gif" || ext == "png" || ext == "jpeg" || ext == "jpg")) {
    $.ajax({
      url: '../admin/template/upl/upload.php',
      dataType: 'text',
      cache: false,
      contentType: false,
      processData: false,
      data: form_data,
      type: 'post',
      success: function(resp) {
        alert(resp);
      }
    });
  } else {
    alert('Errore nellupload');
  }
}
var active = false;

$(document).ready( function() {
  $( '#show_upload_form' ).click( function() {
    if(!active) {
      $( '.form_upload' ).addClass('show_form_upl');
      active = true;
    } else {
      $( '.form_upload' ).removeClass('show_form_upl');
      active = false;
    }
  });

  $.post('functions.php', {fn: 'see_all_media'}, function(resp) {
    console.log(resp);
    if(resp != null || resp != '') {
      for(let i = 0; i < resp.length; i++) {
        $( '#list_media' ).append('<div class="col-2 margin_fix"><img class="fix_img_dp shadow_img" src="../' + resp[i] + '"></div>');
      }
    }
  }, 'json');
});
