<div class="col-md-12">
    <div class="row">
        <div class="col-md-12">
            <div class="form-group{{ $errors->has("categoria_codigo") ? ' has-error' : '' }}">
                {!! Form::label("categoria_codigo", 'Categoria do Chamado', ['class' => '']) !!}
                {{ Form::select('categoria_codigo', $categorias, null, ["class" => "form-control", 'id'=>'categoria_codigo', 'placeholder' => 'Selecione uma Categoria','required', 'required']) }}
                <small class="text-danger">{{ $errors->first("categoria_codigo") }}</small>
            </div>
        </div>

        <div class="col-md-12">
            <div class="form-group{{ $errors->has("helpdesk_titulo") ? ' has-error' : '' }}">
                {!! Form::label("helpdesk_titulo", 'Título do Chamado', ['class' => '']) !!}
                {!! Form::text("helpdesk_titulo", null, ["class" => "form-control", 'id'=>'helpdesk_titulo', 'required','required', 'placeholder'=>'Informe uma título para o chamado'])  !!}
                <small class="text-danger">{{ $errors->first("helpdesk_titulo") }}</small>
            </div>
        </div>

        <div class="col-md-12">
            <div class="form-group{{ $errors->has("helpdesk_detalhes") ? ' has-error' : '' }}">
                {!! Form::label("helpdesk_detalhes", 'Título do Chamado', ['class' => '']) !!}
                {!! Form::textarea("helpdesk_detalhes", null, ["class" => "form-control", 'id'=>'helpdesk_detalhes', 'required','required', 'placeholder'=>'Descreva com clareza o problema'])  !!}
                <small class="text-danger">{{ $errors->first("helpdesk_detalhes") }}</small>
            </div>
        </div>

        <div class="col-md-12 div_files">
            <a class="btn btn-primary btn-add-file" style="color: #fff;"><i class="fas fa-plus"></i>  Inserir Arquivo</a>
        </div>

    </div>
</div>





