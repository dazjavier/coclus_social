<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <label class="control-label" for="tokenfield">Ingresa tus intereses:</label>
            <small class="color_body_text">(Cuando ya hayas escrito uno, presiona Enter para seguir agregando intereses.)</small>
            <input type="text" class="form-control" id="tokenfield" name="intereses[]" />
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js" integrity="sha384-I6F5OKECLVtK/BL+8iSLDEHowSAfUo76ZL9+kGAgTRdiByINKJaqTPH/QVNS1VDb" crossorigin="anonymous"></script>
            <script src="{{ asset('js/plugins/bootstrap-tokenfield.min.js') }}"></script>
            <link rel="stylesheet" href="{{ asset('css/bootstrap-tokenfield.min.css') }}">
            <link rel="stylesheet" href="{{ asset('css/tokenfield-typeahead.min.css') }}">
            <script>
                $('#tokenfield').tokenfield({
                    showAutocompleteOnFocus: true
                })
            </script>
        </div>
    </div>
</div>
