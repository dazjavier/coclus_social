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

  $.get('https://gist.githubusercontent.com/gonzalo-bulnes/337ea1e916e3890fdefa/raw/6706ec2d59d4647dda7fbbbbafa4ad9ead433caa/comunas.json', function(response){
      var comunas = JSON.parse(response);
      comunas.sort(function(a, b){
          return a.name.localeCompare(b.name);
      });
      $.each(comunas, function(a, b){
          $('.select-comuna').append('<option value="' + b.name + '">' + b.name + '</option>');
      });
  });

  $('.comment-link').click(function(e){
      e.preventDefault();
      $(this).toggleClass('active');
      var thebox = $(this).parent().parent().find('.comment-textbox').attr('id');
      $('#' + thebox).toggleClass('reply-status');
  });

    $('.delete-comment-button').click(function(e) {
        e.preventDefault();
        swal({
            title: "¿Estás seguro?",
            text: "No podrás restablecer el estado nuevamente",
            type: "error",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Si, eliminar",
            cancelButtonText: "Cancelar",
            closeOnConfirm: true
        },
        function(){
            $(this).parent().submit();
        }.bind(this));
    });

    $('.list-interest li span').click(function(){
        $(this).toggleClass('list-interest-selected');
    });

    $('.try').click(function(e){
        e.preventDefault();
        var interests = [];
        var values = $('.list-interest li span.list-interest-selected');
        if(values[0] === undefined) { return; }
        $.each(values, function(i, element){
            var el = $(element).attr('data-value');
            interests.push(el);
        });

        $.ajax({
            url: '/add/interests',
            method: 'post',
            data: { interests: interests, user_id: $('.list-interest').attr('id'), _token: $('input[name="_token"]').val() }
        })
        .done(function(msg){
            console.log(msg);
            $('.set_profile_form').submit();
        })
        .error(function(error){
            console.log(error);
        });
    });

});
