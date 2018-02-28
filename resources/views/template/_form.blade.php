<div class="form-group">
    {!!Form::label('name', 'Name') !!}
    {!!Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'name', 'required']) !!}
    {!!Form::label('content', 'Content') !!}
    <div class="alert alert-success" role="alert">
        Нажмите "Источник", и вставте код.
    </div>
    {!!Form::textarea('content', null, ['class' => 'form-control', 'required' => 'required', 'id' => 'content-ckeditor']) !!}
{{--    {!!Form::hidden('created_by', Auth::user()->id) !!}--}}
    {{--TODO Если выбран радиобаттон, то отравить одну текстариа с кодом щаблона, если нет, то заполнять самому--}}
    {{--{{dd()}}--}}
</div>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

</body>
</html>