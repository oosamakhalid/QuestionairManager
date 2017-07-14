@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1" >
            <div class="panel panel-success">
                <div align="center" class="panel-heading">
                        <label class="pull-left label label-default label-lg">Questionair: <span class="label label-primary"><i>{{ $Questionair->name }}</i></span></label> ADD/EDIT Questions <label class="label pull-right label-default label-md">Posted By: <span class="label label-primary">{{ Auth::user()->name }}</span></label>
                </div>
                <div class="panel-body">
                        <form class="form-horizontal" role="form" method="POST" action="{{ url('/saveQuestionair') }}">
                                {{ csrf_field() }}
                            <div class="questionsBody">
                            <input type="hidden" name="questionairId" value="{{ $Questionair->id }}">
                                @foreach($Questions as $Question)
                            <div class="questions" id="Question{{$Question->id}}">
                                <div class="form-group form-group-sm" >
                                        <label for="QuestionType" class="col-md-3 control-label">Question Type</label>
                                        <div class="col-md-7">
                                            <div class="row">
                                                <div class="col-md-11">
                                                     <select id="QuestionSelect{{$Question->id}}" class="form-control typeSelectorOnLoad" name="questionTypeD" required>
                                                            <option value="text" <?php if($Question->type=="text") echo "selected";  ?>><label>Text</label></option>
                                                            <option value="multipleS" <?php if($Question->type=="multipleS") echo "selected";  ?>><label>Multiple Choice(Single Option)</label></option>
                                                            <option value="multipleM" <?php if($Question->type=="multipleM") echo "selected";  ?>><label>Multiple Choice(Multiple Option)<label></option>
                                                    </select>
                                                    <input type="hidden" name="questionId" value="{{$Question->id}}">

                                                </div>
                                                <div class="col-md-1">
                                                    <button class="btn btn-link btn-sm deleteQuestion" type="button" value="Question{{$Question->id}}">Delete Question</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                     <div class="QuestionBody" id="questionBodyOnLoad{{$Question->id}}">
                                    <div class="form-group form-group-sm" >
                                        <label for="Question" class="col-md-3 control-label">Question.{{$loop->iteration}}</label>
                                        <div class="col-md-7">
                                            <div class="row">
                                                <div class="col-md-11">
                                                    <input id="Question" type="text" class="form-control" name="questionText" value="{{ $Question->text }}"  required autofocus>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group{{ $errors->has('duration') ? ' has-error' : '' }} form-group-sm">
                                       @if($Question->type == "text")
                                            <label for="duration" class="col-md-3 control-label">Answer</label>
                                            <div class="col-md-3">
                                                    <input id="answer{{$Question->id}}" type="text" class="form-control" name="questionAnswer" value="{{ $Question->answer }}" required>
                                            </div>
                                        @elseif($Question->type == "multipleS")
                                                <div class="choiceDiv{{$Question->id}}">
                                                    <?php $Choices = $Question->choices; ?>
                                                    <input type="hidden" name="answer{{$Question->id}}" value="{{$Question->answer}}">
                                                    @foreach($Choices as $Choice)
                                                    
                                                    <div class="choices" id="Choice{{$Choice->id}}">
                                                        <label for="duration" class="col-md-3 control-label">Choice {{$loop->iteration}}</label>
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="row">
                                                                        <div class="col-md-6">
                                                                            <input data-cb="ab{{$Choice->id}}" type="text" class="form-control" name="choiceText" id="ch{{$Choice->id}}" value="{{ $Choice->text }}" required>
                                                                            <input type="hidden" name="choiceId" value="{{$Choice->id}}">
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <div class="row">
                                                                                <div class="col-md-6">
                                                                                    @if($Choice->text == $Question->answer)
                                                                                        <label class=""><input id="{{$Question->id}}" type="checkbox" class="checkboxes" checked value="ch{{$Choice->id}}" name="resumeable{{$Question->id}}"> Correct?</label>
                                                                                    @else
                                                                                        <label class=""><input id="{{$Question->id}}" type="checkbox" class="checkboxes" value="ch{{$Choice->id}}" name="resumeable{{$Question->id}}"> Correct?</label>
                                                                                    @endif
                                                                                </div>
                                                                                <div class="col-md-6">
                                                                                    <button type="button" class="btn btn-link btn-sm pull-left deleteChoice" value="Choice{{ $Choice->id }}">Delete Choice</button>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                    </div>
                                                    @endforeach
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <button type="button" value="choiceDiv{{$Question->id}}"  class="btn btn-link addChoice" style="margin-left:85%;">Add Choice</button>
                                                    </div>
                                                </div>
                                                 @elseif($Question->type == "multipleM")
                                                <div class="choiceDiv{{$Question->id}}">
                                                    <?php $Choices = $Question->choices;  ?>
                                                    <input type="hidden" name="answer{{$Question->id}}" value="{{$Question->answer}}">
                                                    @foreach($Choices as $Choice)
                                                    <div class="choices" name="choices" id="Choice{{$Choice->id}}">
                                                        <label for="duration" class="col-md-3 control-label">Choice {{$loop->iteration}}</label>
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="row">
                                                                        <div class="col-md-6">
                                                                            <input id="ch{{$Choice->id}}" type="text" class="form-control" name="choiceText" value="{{ $Choice->text }}" required>
                                                                            <input type="hidden" name="choiceId" value="{{$Choice->id}}">    
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <div class="row">
                                                                                <div class="col-md-6">
                                                                                    @if($Choice->text == $Question->answer)
                                                                                        <label class=""><input type="checkbox" id="{{$Question->id}}" checked value="ch{{$Choice->id}}" name="resumeableM{{$Choice->id}}"> Correct?</label>
                                                                                    @else
                                                                                        <label class=""><input type="checkbox" id="{{$Question->id}}" value="ch{{$Choice->id}}" name="resumeableM{{$Choice->id}}"> Correct?</label>
                                                                                    @endif
                                                                                </div>
                                                                                <div class="col-md-6">
                                                                                    <button type="button" class="btn btn-link btn-sm pull-left deleteChoice" value="Choice{{ $Choice->id }}">Delete Choice</button>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                    </div>
                                                    @endforeach
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <button type="button" value="choiceDiv{{$Question->id}}"  class="btn btn-link addChoice" style="margin-left:85%;">Add Choice</button>
                                                    </div>
                                                </div>
                                        @endif
                                        </div>
                                    </div> 
                                <hr>
                                </div>
                                @endforeach
                                </div>
                                </form>
                                <div class="row">
                                    <div class="col-md-6">
                                    <button type="button" id="addButton" class="btn btn-success">Add Question</button>
                                    </div>
                                    <div class="col-md-6">
                                    <button type="button" id="saveButton" class="pull-right btn btn-primary">Save Questions</button>
                                    </div>

                                </div> 
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
