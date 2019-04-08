<div class="col-md-12">
    <div class="row">

        <div class="col-md-3">
            <div class="form-group{{ $errors->has("empresa_cnpj") ? ' has-error' : '' }}">
                {!! Form::label("empresa_cnpj", 'CPF/CNPJ', ['class' => '']) !!}
                {!! Form::text("empresa_cnpj", null, ["class" => "form-control", 'id'=>'empresa_cnpj', 'required','required', 'placeholder'=>"Informe o CPF ou CNPJ", 'minlength' => 11, 'maxlength' => 14])  !!}
                <small class="text-danger">{{ $errors->first("empresa_cnpj") }}</small>
            </div>
        </div>

        <div class="col-md-5">
            <div class="form-group{{ $errors->has("empresa_rzsocial") ? ' has-error' : '' }}">
                {!! Form::label("empresa_rzsocial", 'Razão Social', ['class' => '']) !!}
                {!! Form::text("empresa_rzsocial", null, ["class" => "form-control", 'id'=>'empresa_rzsocial', 'required','required', 'placeholder'=>"Informe a razão social"])  !!}
                <small class="text-danger">{{ $errors->first("empresa_rzsocial") }}</small>
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group{{ $errors->has("empresa_fantasia") ? ' has-error' : '' }}">
                {!! Form::label("empresa_fantasia", 'Fantasia', ['class' => '']) !!}
                {!! Form::text("empresa_fantasia", null, ["class" => "form-control", 'id'=>'empresa_fantasia', 'required','required', 'placeholder'=>"Informe a fantasia"])  !!}
                <small class="text-danger">{{ $errors->first("empresa_fantasia") }}</small>
            </div>
        </div>

        <div class="col-md-3">
            <div class="form-group{{ $errors->has("empresa_cep") ? ' has-error' : '' }}">
                {!! Form::label("empresa_cep", 'CEP', ['class' => '']) !!}
                {!! Form::text("empresa_cep", null, ["class" => "form-control", 'id'=>'empresa_cep', 'placeholder'=>"Informe o cep", 'maxlength' => '8'])  !!}
                <small class="text-danger">{{ $errors->first("empresa_cep") }}</small>
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group{{ $errors->has("empresa_logradouro") ? ' has-error' : '' }}">
                {!! Form::label("empresa_logradouro", 'Endereço', ['class' => '']) !!}
                {!! Form::text("empresa_logradouro", null, ["class" => "form-control", 'id'=>'empresa_logradouro', 'placeholder'=>"Informe o endereço"])  !!}
                <small class="text-danger">{{ $errors->first("empresa_logradouro") }}</small>
            </div>
        </div>

        <div class="col-md-3">
            <div class="form-group{{ $errors->has("empresa_numero") ? ' has-error' : '' }}">
                {!! Form::label("empresa_numero", 'Número', ['class' => '']) !!}
                {!! Form::number("empresa_numero", null, ["class" => "form-control", 'id' => 'empresa_num_endereco', 'placeholder'=>"Informe o número", 'min' => 0])  !!}
                <small class="text-danger">{{ $errors->first("empresa_numero") }}</small>
            </div>
        </div>

        <div class="col-md-5">
            <div class="form-group{{ $errors->has("empresa_bairro") ? ' has-error' : '' }}">
                {!! Form::label("empresa_bairro", 'Bairro', ['class' => '']) !!}
                {!! Form::text("empresa_bairro", null, ["class" => "form-control", 'id' => 'empresa_bairro', 'placeholder'=>"Informe o bairro"])  !!}
                <small class="text-danger">{{ $errors->first("empresa_bairro") }}</small>
            </div>
        </div>

        <div class="col-md-5">
            <div class="form-group{{ $errors->has("empresa_cidade") ? ' has-error' : '' }}">
                {!! Form::label("empresa_cidade", 'Cidade', ['class' => '']) !!}
                {!! Form::text("empresa_cidade", null, ["class" => "form-control", 'id' => 'empresa_cidade', 'placeholder'=>"Informe a cidade"])  !!}
                <small class="text-danger">{{ $errors->first("empresa_cidade") }}</small>
            </div>
        </div>

        <div class="col-md-2">
            <div class="form-group{{ $errors->has("empresa_uf") ? ' has-error' : '' }}">
                {!! Form::label("empresa_uf", 'UF', ['class' => '']) !!}
                {!! Form::text("empresa_uf", null, ["class" => "form-control", 'id' => 'empresa_uf', 'placeholder'=>"Informe a unidade federativa"])  !!}
                <small class="text-danger">{{ $errors->first("empresa_uf") }}</small>
            </div>
        </div>

        <div class="col-md-12">
            <div class="form-group{{ $errors->has("empresa_cor") ? ' has-error' : '' }}">
                {!! Form::label("empresa_cor", 'Cor nos gráficos', ['class' => '']) !!}
                {{ Form::color('empresa_cor', null, ["class" => "form-control", 'id'=>'empresa_cor', 'required', 'required']) }}
                <small class="text-danger">{{ $errors->first("empresa_cor") }}</small>
            </div>
        </div>
    </div>
</div>





