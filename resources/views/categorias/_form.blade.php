<div class="col-md-12">
    <div class="row">
        <div class="col-md-12">
            <div class="form-group{{ $errors->has("categoria_descricao") ? ' has-error' : '' }}">
                {!! Form::label("categoria_descricao", 'Descrição', ['class' => '']) !!}
                {!! Form::text("categoria_descricao", null, ["class" => "form-control", 'id'=>'categoria_descricao', 'required','required', 'placeholder'=>"Informe uma descrição para a categoria"])  !!}
                <small class="text-danger">{{ $errors->first("categoria_descricao") }}</small>
            </div>
        </div>

        <div class="col-md-12">
            <div class="form-group{{ $errors->has("prioridade_codigo") ? ' has-error' : '' }}">
                {!! Form::label("prioridade_codigo", 'Prioridade', ['class' => '']) !!}
                {{ Form::select('prioridade_codigo', $prioridades, null, ["class" => "form-control", 'id'=>'prioridade_codigo', 'required', 'required']) }}
                <small class="text-danger">{{ $errors->first("prioridade_codigo") }}</small>
            </div>
        </div>
    </div>
</div>





