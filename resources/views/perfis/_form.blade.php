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
            <h3>Permissões</h3>
            <select id="permissoes" name="permissoes[]" multiple="multiple" class="form-control">
                @foreach($permissoes as $p)
                    <option value="{{ $p->permissao_codigo }}" {{ in_array($p->permissao_codigo, $selecionadas) ? 'selected' : '' }}> {{ $p->permissao_descricao}} </option>
                @endforeach
            </select>
{{--            {!! Form::select("permissoes", $permissoes, null, ["class" => "form-control", 'id'=>'permissoes', 'required','required', 'name' => 'permissoes[]', 'multiple' => 'multiple'])  !!}--}}
        </div>
    </div>
</div>

@section('scripts')
    <script>
        $('#permissoes').multiSelect();
    </script>
@endsection
