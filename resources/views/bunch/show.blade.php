@extends('layouts.panel')
<?php
/** @var \Illuminate\Support\ViewErrorBag $errors */
/** @var \App\Post $post */
?>
@section('panel')
    <div class="panel-heading container-fluid">
        <div class="form-group">
            <a class="btn btn-info btn-xs col-md-1 col-sm-2 col-xs-2" href="{{route('bunch.index')}}">
                <i class="fa fa-backward" aria-hidden="true"></i> back
            </a>
            <div class="centered-child col-md-9 col-sm-7 col-xs-6">bunch: <b>{{$bunches->title}}</b></div>
            <div class="col-md-2 col-sm-3 col-xs-4">
                <div class="pull-right">
                    {{Form::open(['class' => 'confirm-delete', 'route' => ['bunch.destroy', $bunches->id], 'method' => 'DELETE'])}}
                    {{ link_to_route('bunch.edit', 'edit', [$bunches->id], ['class' => 'btn btn-primary btn-xs']) }} |
                    {{Form::button('Delete', ['class' => 'btn btn-danger btn-xs', 'type' => 'submit'])}}
                    {{Form::close()}}
                </div>
            </div>
        </div>
    </div>

    <div class="panel-body">

        <table class="table table-bordered table-responsive">
            <tr>
                <th width="25%">Attribute</th>
                <th width="75%">Value</th>
            </tr>
            
        @foreach ($bunches->getAttributes() as $attribute => $value)
                <tr>
                    <td>{{$attribute}}</td>
                    <td>{{$value}}</td>
                </tr>
            @endforeach
        </table>

        <table class="table table-bordered table-responsive">
            <tr>
                <th width="75%">Subscribers names</th>
            </tr>
            <tr>
            @foreach($bunches->subscribers as $subs)
                    <th>{{ link_to_route('showOne', $subs->name , [$bunches->id ,$subs->id], []) }}</th>
            @endforeach
            </tr>
{{--            {{dd($bunches->subscribers)}}--}}
            {{--@foreach ($subs_list as  $value)--}}
                {{--<tr>--}}
                    {{--<td>{{$value}}--}}{{--<a href="bunch/{{$bunches->id}}/subscriber/{{$bunches->}}"></a>--}}{{--</td>--}}
                {{--</tr>--}}
            {{--@endforeach--}}
        </table>

    </div>

@endsection