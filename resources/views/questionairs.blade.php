@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1" >
            <div class="panel panel-success">
                <div align="center" class="panel-heading"><label>Questionairs</label> | <a class="link link-success link-xs" href="{{ URL('questionairCreate') }}"> Add Questionair</a></div>
                <div class="panel-body">
                @if($Questionairs->isNotEmpty())
                    <table class="table table-bordered table-inverse">
                        <thead>
                        <tr>
                            <td>Sr.</td>
                            <td>Name</td>
                            <td>Number Of Question</td>
                            <td>Duration</td>
                            <td>Resumeable</td>
                            <td>Published</td>
                            <td>Action</td>
                        </tr>
                        </thead>
                        <tbody>
                          @foreach($Questionairs as $Questionair)
                          <tr id="{{ $Questionair->id }}">
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $Questionair->name }}</td>
                                <?php $count = $Questionair->tQuestionss(); ?>
                                <td align="center">
                                     {{ $count }} | <a class="btn btn-link btn-sm" href="./addQuestion/{{ $Questionair->id}}">Add</a>
                                </td>
                                <td>{{ $Questionair->duration . " " . $Questionair->timeType }} </td>
                                <td>{{ $Questionair->resumeable }}</td>
                                <td>{{ $Questionair->publish }}</td>
                                <td><a class="btn btn-link" href="./editQuestionair/{{ $Questionair->id }}">Edit</a> | <button class="btn btn-link deleteQuestionair" value="{{ $Questionair->id }}">Delete</button></td>
                           </tr>
                          @endforeach
                        </tbody>
                    </table>
                    @else
                    <label align="center" style="color:red">No Questionair Added so far!</label>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
