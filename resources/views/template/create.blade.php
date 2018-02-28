@extends('layouts.panel')
<?php  /** @var \Illuminate\Support\ViewErrorBag $errors */  ?>
@section('panel')
    {{--<plaintext></plaintext>--}}
    <div class="panel-heading container-fluid">
        <div class="form-group">
            <div class="centered-child col-md-11 col-sm-10 col-xs-10"><b>New Template</b></div>
        </div>
    </div>

    <div class="alert alert-primary raw" role="alert">
        <a class="raw-link" href="/public/teest/templatees.html">Нажмите , если вы хотите использовать готовый код шаблона</a>
    </div>

    <div class="panel-body">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
{{--        {{dd(\App\Models\Subscriber::find()->get())}}--}}
        {!! Form::open(['route' => 'template.store']) !!}

        @include('template._form')

        <div class="form-group">
            {!! Form::button('Create', ['type' => 'submit', 'class' => 'btn btn-primary']) !!}
        </div>

        {!! Form::close() !!}

    </div>

@endsection