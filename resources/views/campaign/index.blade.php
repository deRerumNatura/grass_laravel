@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">campaignS</div>
                    @if(session()->has('message'))
                        <div class="alert alert-success">
                            {{ session()->get('message') }}
                        </div>
                    @endif
                    <div class="panel-body">
                        {{ link_to_route('campaign.create', 'create', null, ['class' => 'btn btn-info btn-xs']) }}
                        <table class="table table-bordered table-responsive table-striped">
                            <tr>
                                <th width="140px">id</th>
                                <th width="300px">Title</th>
                                <th width="300px">Bunch</th>
                                <th width="400px">Template</th>
                                <th width="400px">action</th>
                            </tr>
                            <tr>
                                <td colspan="3" class="light-green-background no-padding" title="Create new campaign">
                                    <div class="row centered-child">
                                        <div class="col-md-12">

                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @foreach ($campaigns as $model)
                                <tr class="table-click" style="cursor: pointer" onclick="document.location = 'campaign/{{$model->id}}'">
                                    <td>{{$model->id}}</td>
                                    <td>{{$model->name}}</td>
                                    @if(empty($model->bunch))
                                        <td style="color: red">bunch is deleted. Update campaign record, please.</td>
                                    @else
                                        <td>{{$model->bunch->title}}</td>
                                    @endif
                                    @if(empty($model->template))
                                        <td style="color: red">template is deleted. Update campaign record, please.</td>
                                    @else
                                         <td>{{$model->template->name}}</td>
                                    @endif
                                    <td>
                                        {{Form::open(['class' => 'confirm-delete', 'route' => ['campaign.destroy', $model->id], 'method' => 'DELETE'])}}
                                        {{ link_to_route('campaign.show', 'info', [$model->id], ['class' => 'btn btn-info btn-xs']) }} |
                                        {{ link_to_route('campaign.edit', 'edit', [$model->id], ['class' => 'btn btn-success btn-xs']) }}
                                        {{Form::button('Delete', ['class' => 'btn btn-danger btn-xs', 'type' => 'submit'])}}
                                        {{ link_to_route('preview', 'preview', [$model->id], ['class' => 'btn btn-success btn-xs']) }}
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