<div class="col-md-12">
    <div class="row">
        <div class="col-md-12">
            <div class="form-group{{ $errors->has("perfil_descricao") ? ' has-error' : '' }}">
                {!! Form::label("perfil_descricao", 'Descrição', ['class' => '']) !!}
                {!! Form::text("perfil_descricao", null, ["class" => "form-control", 'id'=>'perfil_descricao', 'required','required', 'placeholder'=>"Informe uma descrição para o perfil de acesso"])  !!}
                <small class="text-danger">{{ $errors->first("perfil_descricao") }}</small>
            </div>
        </div>
        <div class="col-md-12">
            <select id='keep-order' multiple='multiple'>
                <option value='elem_1'>elem 1</option>
                <option value='elem_2'>elem 2</option>
                <option value='elem_3'>elem 3</option>
                <option value='elem_4'>elem 4</option>
                ...
                <option value='elem_100'>elem 100</option>
            </select>
        </div>
    </div>
</div>

@section('scripts')

@endsection
