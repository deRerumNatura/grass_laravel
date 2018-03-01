@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">TEMPLATES</div>
                    @if(session()->has('message'))
                        <div class="alert alert-success">
                            {{ session()->get('message') }}
                        </div>
                    @endif
                    <div class="panel-body">
                        {{ link_to_route('template.create', 'create', null, ['class' => 'btn btn-info btn-xs']) }}
                        <table class="table table-bordered table-responsive table-striped">
                            <tr>
                                <th width="25%">id</th>
                                <th width="50%">Title</th>
                                <th width="45%">action</th>
                            </tr>
                            <tr>
                                <td colspan="3" class="light-green-background no-padding" title="Create new template">
                                    <div class="row centered-child">
                                        <div class="col-md-12">

                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @foreach ($templates as $model)

                                <tr class="table-click" style="cursor: pointer" onclick="document.location = 'template/{{$model->id}}';">
                                    <td>{{$model->id}}</td>
                                    <td>{{$model->name}}</td>
                                    <td>
                                        {{Form::open(['class' => 'confirm-delete', 'route' => ['template.destroy', $model->id], 'method' => 'DELETE'])}}
                                        {{ link_to_route('template.show', 'info', [$model->id], ['class' => 'btn btn-info btn-xs']) }} |
                                        {{ link_to_route('template.edit', 'edit', [$model->id], ['class' => 'btn btn-success btn-xs']) }}
                                        {{Form::button('Delete', ['class' => 'btn btn-danger btn-xs', 'type' => 'submit'])}}
                                        {{Form::close()}}
                                    </td>

                                    </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection