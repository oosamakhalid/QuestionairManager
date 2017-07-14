@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-primary">
                            <div class="panel-heading">Update Questionair</div>

                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/saveQuestionair') }}">
                        {{ csrf_field() }}
                        <input type="hidden" name="questionairId" value="{{$Questionair->id}}">
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label" >Questionair Name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ $Questionair->name }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('duration') ? ' has-error' : '' }}">
                            <label for="duration" class="col-md-4 control-label" >Duration</label>

                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-6">
                                <input id="duration" type="text" class="form-control" name="duration" required value="{{ $Questionair->duration }}">
                                </div>
                                <div class="col-md-6">
                                <select class="form-control" name="timeType" required>
                                    <option  selected disabled><i>Select Min/Hrs</i></option>
                                    @if($Questionair->timeType == "Minutes")
                                    <option value="Minutes" selected><i>Minutes</i></option>
                                    @else
                                    <option value="Minutes"><i>Minutes</i></option>
                                    @endif
                                    @if($Questionair->timeType == "Hours")
                                    <option value="Hours" selected><i>Hours</i></option>
                                    @else
                                    <option value="Hours"><i>Hours</i></option>
                                    @endif
                                </select>
                                </div>
                                @if ($errors->has('duration'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('duration') }}</strong>
                                    </span>
                                @endif
                                </div>
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('resumable') ? ' has-error' : '' }}">
                            <label for="resumable" class="col-md-4 control-label">Can Resume?</label>

                            <div class="col-md-6">
                                @if($Questionair->resumeable == "Yes")
                                 <label class="radio-inline"><input type="radio" checked value="Yes" name="resumeable">YES</label>
                                @else
                                <label class="radio-inline"><input type="radio" value="Yes" name="resumeable">YES</label>
                                @endif
                                @if($Questionair->resumeable == "No")
                                <label class="radio-inline"><input type="radio" checked value="No" name="resumeable">NO</label> 
                                @else
                                <label class="radio-inline"><input type="radio" value="No" name="resumeable">NO</label> 
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Save
                                </button>

                                <button class="btn btn-link" id="clearBtn">
                                    Clear
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
              </div>
        </div>
    </div>
</div>
@endsection