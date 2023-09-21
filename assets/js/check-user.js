$( document ).ready( function() {
  $('#show').click(function(){
    var pass = document.getElementById('floatingPassword');
    if(pass.type == 'password')
      pass.type = 'text';
    else
      pass.type = 'password';
  });

  function check_login() {
    event.preventDefault();
    var nome = $('#floatingInput').val();
    var pw = $('#floatingPassword').val();

    if(nome == ''){
      $('#msgErr').html('nome non inserita');
      $('#floatingInput').addClass('is-invalid');
      $('#label-nome').attr('for', 'floatingInputInvalid');
      $('#label-nome').html('Invalid nome');
    } else if(pw == ''){
      $('#msgErr').html('Password non inserita');
      $('#floatingPassword').addClass('is-invalid');
      $('#label-pw').attr('for', 'floatingInputInvalid');
      $('#label-pw').html('Invalid Password');
    } else {
      $.post('../admin/login/login.php', {nome:nome, pw:pw}, function(resp){
        if(resp == 'userWrong'){
          $('#msgErr').html('Credenziali errate');
          $('#floatingPassword, #floatingInput').addClass('is-invalid');
          $('#label-pw').attr('for', 'floatingInputInvalid');
          $('#label-pw').html('Invalid Password');
          $('#label-nome').attr('for', 'floatingInputInvalid');
          $('#label-nome').html('Invalid nome');
        } else {
          window.location.href = "../admin/";
          //alert('Logged');
        }
      });
    }
  }


  $('#signin').click( function() { check_login(); });
  $('#form-login').submit( function() { check_login(); });
});
