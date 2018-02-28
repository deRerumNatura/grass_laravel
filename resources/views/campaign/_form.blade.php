<div class="form-group">
    {!!Form::label('content', 'Campaign') !!}
    {!!Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'name', 'maxlength' => '200', 'required']) !!}
    <p></p>
    {!!Form::text('description', null, ['class' => 'form-control', 'placeholder' => 'description']) !!}
    <p></p>
    {!! Form::select(
         'template_id',
         $templates_list,
         isset($selected_templates) ? $selected_templates : null,
         ['class' => 'form-control', 'required']
     ) !!}
    <p></p>
    {!! Form::select(
         'bunch_id',
         $bunches_list,
         isset($selected_bunches) ? $selected_bunches : null,
         ['class' => 'form-control', 'required']
     ) !!}
</div>