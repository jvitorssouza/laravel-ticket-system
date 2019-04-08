<div class="col-md-12">
    <div class="row">
        <div class="col-md-12">
            <div class="form-group{{ $errors->has("departamento_descricao") ? ' has-error' : '' }}">
                {!! Form::label("departamento_descricao", 'Descrição', ['class' => '']) !!}
                {!! Form::text("departamento_descricao", null, ["class" => "form-control", 'id'=>'departamento_descricao', 'required','required', 'placeholder'=>"Informe uma descrição para o departamento"])  !!}
                <small class="text-danger">{{ $errors->first("departamento_descricao") }}</small>
            </div>
        </div>

        <div class="col-md-12">
            <div class="form-group{{ $errors->has("empresa_codigo") ? ' has-error' : '' }}">
                {!! Form::label("empresa_codigo", 'Empresa', ['class' => '']) !!}
                {{ Form::select('empresa_codigo', $empresas, null, ["class" => "form-control", 'id'=>'empresa_codigo', 'required', 'required']) }}
                <small class="text-danger">{{ $errors->first("empresa_codigo") }}</small>
            </div>
        </div>

        <div class="col-md-12">
            <div class="form-group{{ $errors->has("departamento_cor") ? ' has-error' : '' }}">
                {!! Form::label("departamento_cor", 'Cor nos gráficos', ['class' => '']) !!}
                {{ Form::color('departamento_cor', null, ["class" => "form-control", 'id'=>'departamento_cor', 'required', 'required']) }}
                <small class="text-danger">{{ $errors->first("departamento_cor") }}</small>
            </div>
        </div>
    </div>
</div>





