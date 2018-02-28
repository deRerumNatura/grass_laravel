<div class="form-group">
    {!!Form::label('content', 'Bunch') !!}
    {!!Form::text('title', null, ['class' => 'form-control', 'placeholder' => ' title', 'required']) !!}
    {!!Form::text('description', null, ['class' => 'form-control', 'placeholder' => ' description']) !!}
    <p></p>
    {!! Form::select(
         'subscriber_ids[]',
         $subs_list,
         isset($selected_subscribers) ? $selected_subscribers : null,
         ['class' => 'form-control', 'multiple' , 'required']
     ) !!}

</div>