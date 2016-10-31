$(document).ready(function () {
  var obj = {};

  $('.scroll a[href^="#"]').click(function (e) {
    e.preventDefault();
    $(window).stop(true).scrollTo(this.hash, { duration: 500, interrupt: true });
  });

  $('.persona label').click(function(e) {
      $(this).parent().parent().parent().parent().css('display', 'none');
      $data_href = $(this).attr('data-href');
      $('#next').attr('href', "/set_profile/" + $data_href);

      setTimeout(function(){
          $('.register').css('display', 'block');
      }, 1000);
  });


  $('.perfiles li button').on('click', function(e){
      e.preventDefault();

      $('li button.selected').removeClass('selected');
      $(this).addClass('selected');
  });

  $('.next-step').click(function(e){
      e.preventDefault();
      var $selected_profile = $('.perfiles li button.selected').attr('data-href');
      if ($selected_profile === undefined) { alert('Debes seleccionar un perfil.'); return; }

      $('.perfiles input[type="hidden"]').val($selected_profile);
      $body = $("body");
      $body.addClass("loading");
      setTimeout(function(){
          $('.selec-perfil').css('display', 'none');
          $body.removeClass("loading");
      }, 2000);
      $('.row-register').css('display', 'block');

  });

});
