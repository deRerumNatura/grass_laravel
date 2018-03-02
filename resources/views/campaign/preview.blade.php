@extends('layouts.panel')
@section('panel')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">campaignS</div>
                    <a class="btn btn-info btn-xs col-md-1 col-sm-2 col-xs-2" href="{{route('campaign.index')}}">
                        <i class="fa fa-backward" aria-hidden="true"></i> back
                    </a>
                    <div class="panel-body">
                        <table class="table table-bordered table-responsive table-striped">
                            <tr>
                                <th width="140px">Subject</th>
                                <th width="300px">To</th>
                                <th width="300px">From</th>
                                <th width="400px">Message</th>
                            </tr>
                            {{--                            @foreach ($campaigns as $model)--}}
                            {{--                                {{dd($campaigns->)}}--}}
                            <tr>
                                <td>{{$campaigns->name}}</td>
                                @if(empty($campaigns->bunch))
                                    <td style="color: red;">list is deleted. Update list for success.</td>
                                @else
                                    <td>@foreach($campaigns->bunch->subscribers as $index => $subscriber)
                                        @if($index > 199)
                                                <pre><span style="font-size: 1.2em">...</span></pre>
                                                @break;
                                            @endif
                                                {{$subscriber->email}}
                                        @endforeach</td>
                                @endif
                                <td>myemail@gmail.com</td>
                                <td>{{$campaigns->template->content}}</td>
                                <td>
                                    {{Form::open(['class' => 'confirm-delete', 'route' => ['campaign.destroy', $campaigns->id], 'method' => 'DELETE'])}}

                                    {{Form::close()}}
                                </td>

                            </tr>
                            {{--@endforeach--}}
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection