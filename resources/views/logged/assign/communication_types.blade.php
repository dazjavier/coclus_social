<h4>{{ $title_communication_types }}</h4>
<div class="row">
    <div class="col-md-4">
        <div class="checkbox">
            <label>
                <input type="checkbox" value="Implante Coclear" name="comunicacion[]" {{ old('comunicacion') == "Implante Coclear" ? 'checked' : '' }}> Implante Coclear
            </label>
        </div>
    </div>
    <div class="col-md-4">
        <div class="checkbox">
            <label>
                <input type="checkbox" value="Audífono" name="comunicacion[]" {{ old('comunicacion') == "Audífono" ? 'checked' : '' }}> Audifonos
            </label>
        </div>
    </div>
    <div class="col-md-4">
        <div class="checkbox">
            <label>
                <input type="checkbox" value="Lengua de Señas" name="comunicacion[]" {{ old('comunicacion') == "Lengua de Señas" ? 'checked' : '' }}> Lengua de Señas
            </label>
        </div>
    </div>
</div>
