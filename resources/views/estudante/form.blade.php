<div class="box box-info padding-1">
    <div class="box-body">

        <div class="form-group">
            {{ Form::label('nomeCompleto') }}
            {{ Form::text('nomeCompleto', $estudante->nomeCompleto, ['class' => 'form-control' . ($errors->has('nomeCompleto') ? ' is-invalid' : ''), 'placeholder' => 'Nomecompleto']) }}
            {!! $errors->first('nomeCompleto', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('Sexo') }}
            {{ Form::text('Sexo', $estudante->Sexo, ['class' => 'form-control' . ($errors->has('Sexo') ? ' is-invalid' : ''), 'placeholder' => 'Sexo']) }}
            {!! $errors->first('Sexo', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            <label for="paidId">{{ __('Perfil:') }}</label>
            <div class="col-md-6">
                <select id="paidId" class="form-control getPais @error('paidId') is-invalid @enderror" name="paidId" value="{{ old('perfil') }}">
                    @foreach($paises as $pais)
                        <option value="{{$pais -> id}}">{{$pais -> nome}}</option>
                    @endforeach
                </select>
                @error('paidId')
                <span class="invalid-feedback" role="alert">
                                       <strong>{{ $message }}</strong>
                                    </span>
                @enderror
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-6">
                <label for="natur">{{ __('Naturalidade:') }}</label>
                <select id="natur" class="form-control getNatur @error('natur') is-invalid @enderror" name="natur" value="{{ old('natur') }}">
                    <option value="0" selected disabled>Naturalidade</option>
                </select>
                @error('natur')
                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                @enderror
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-6">
                <label for="morada">{{ __('Morada:') }}</label>
                <select id="morada" class="form-control getMorada @error('morada') is-invalid @enderror" name="morada" value="{{ old('morada') }}">
                    <option value="0" selected disabled>Morada</option>
                </select>
                @error('morada')
                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                @enderror
            </div>
        </div>
        <div class="form-group">
            {{ Form::label('dataNascimento') }}
            {{ Form::date('dataNascimento', $estudante->dataNascimento, ['class' => 'form-control' . ($errors->has('dataNascimento') ? ' is-invalid' : ''), 'placeholder' => 'Datanascimento']) }}
            {!! $errors->first('dataNascimento', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('nomePai') }}
            {{ Form::text('nomePai', $estudante->nomePai, ['class' => 'form-control' . ($errors->has('nomePai') ? ' is-invalid' : ''), 'placeholder' => 'Nomepai']) }}
            {!! $errors->first('nomePai', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('nomeMae') }}
            {{ Form::text('nomeMae', $estudante->nomeMae, ['class' => 'form-control' . ($errors->has('nomeMae') ? ' is-invalid' : ''), 'placeholder' => 'Nomemae']) }}
            {!! $errors->first('nomeMae', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('classe') }}
            {{ Form::text('classe', $estudante->classe, ['class' => 'form-control' . ($errors->has('classe') ? ' is-invalid' : ''), 'placeholder' => 'Classe']) }}
            {!! $errors->first('classe', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('userId') }}
            {{ Form::text('userId', $estudante->userId, ['class' => 'form-control' . ($errors->has('userId') ? ' is-invalid' : ''), 'placeholder' => 'Userid']) }}
            {!! $errors->first('userId', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</div>
