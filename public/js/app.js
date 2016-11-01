$(document).ready(function () {
  $('.scroll a[href^="#"]').click(function (e) {
    e.preventDefault();
    $(window).stop(true).scrollTo(this.hash, { duration: 500, interrupt: true });
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
      }, 1500);
      $('.row-register').css('display', 'block');
  });

  $.get('https://gist.githubusercontent.com/gonzalo-bulnes/337ea1e916e3890fdefa/raw/6706ec2d59d4647dda7fbbbbafa4ad9ead433caa/comunas.json', function(json){
      var asd = JSON.parse(json);
      $.each(asd, function(a, b){
          $('.select-comuna').append('<option value="' + b.name + '">' + b.name + '</option>')
      });
  });

});
