/**
 * Main.js
 * @Author Andrea Storci, Oppimittinetworing.com
 *
 */
var nav = $('.nav').children().find('a');

function active_div(nav, name) {
    //event.preventDefault();
    console.log(nav);
    for(let i = 0; i < nav.length; i++) {
      if(nav[i].classList.contains('active')) {
        nav[i].classList.remove('active');
        nav[i].classList.add('text-white');
      }
    }
    var element = document.getElementsByName(name);
    console.log(element);
    element[0].classList.add('active');
}

function view_data_pres(data, i, is_active_ps, is_active_dp) {
  var div_html      = '';
  var active_class  = 'active_pres';
  var disable_dp    = 'dont_show_dp';
  if(is_active_ps) {
    if(is_active_dp) {
      div_html = '<div class="col-2 box_img_dp ' + active_class + '"><img class="fix_img_dp" src="..\/' + data +
                 '" /><h5>Slide ' + i + '</h5></div>';
    } else {
      div_html = '<div class="col-2 box_img_dp ' + active_class + ' ' + disable_dp + '"><img class="fix_img_dp" src="..\/' + data +
                 '" /><h5>Slide ' + i + '</h5></div>';
    }
  } else {
    if(is_active_dp) {
      div_html = '<div class="col-2 box_img_dp"><img class="fix_img_dp" src="..\/' + data +
                 '" /><h5>Slide ' + i + '</h5></div>';
    } else {
      div_html = '<div class="col-2 box_img_dp ' + disable_dp + '"><img class="fix_img_dp" src="..\/' + data +
                 '" /><h5>Slide ' + i + '</h5></div>';
    }
  }
  return div_html;
}

function view_all_user() {
  $.post('../admin/functions.php', {fn: 'see_all_user'}, function(resp) {
    if(resp != null) {
      $( '.tbl_body' ).append();
    }
  }, 'json');
}
