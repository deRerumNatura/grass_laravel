<div class="form-group">
    {!!Form::label('content', 'Subscriber') !!}
    {!!Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'name']) !!}
    <p></p>
    {!!Form::text('surname', null, ['class' => 'form-control', 'placeholder' => 'surname']) !!}
    <p></p>
    {!!Form::email('email', null, ['class' => 'form-control', 'placeholder' => 'email', 'required']) !!}
</div>