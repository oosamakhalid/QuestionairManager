<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Collection;
use App\Questionair;
use App\Question;
use App\QuestionChoice;
class QuestionairController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'duration' => 'required|numeric',
        ]);
    }

     protected function create(array $data)
    {
        return Questionair::create([
            'name' => $data['name'],
            'duration' => $data['duration'] ." " ,
            'timeType' => $data['timeType'],
            'resumeable' => $data['resumeable'],
            'publish' => 'No',
        ]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $questionairs = Questionair::all();
        return view('questionairs',['Questionairs' => $questionairs]);
    }

    public function createQuestionair()
    {
        $questionair = new Questionair();
        $questionair->name = "";
        return view('createQuestionair',['Questionair' => $questionair]);
    }

    public function saveQuestionair(Request $request)
    {
        
        $validator = $this->validator($request->all());

        if ($validator->fails()) 
        {
            $this->throwValidationException(
                $request, $validator
            );
        }

       $questionair = $this->create($request->all());
       $questionairs = Questionair::all();
        return view('questionairs',['Questionairs' => $questionairs]);
        
    }
    public function deleteQuestionair(Request $request){

        

        $result = Questionair::where( 'id','=', $request->Questionair )->delete();
        if($result>0){
            return "success";
        }

    }
    public function deleteChoice(Request $request){
       $result = QuestionChoice::where('id','=',intval($request->chocieId))->delete();
        if($result>0){
            return "success";
        }
    }
    public function deleteQuestion(Request $request){
       $result = QuestionChoice::where('question_id','=',intval($request->questionId))->delete();
       $resultQ = Question::where('id','=',intval($request->questionId))->delete();
        if($resultQ>0){
            return "success";
        }
    }
    public function editQuestionair($id){

        $questionair = Questionair::where( 'id','=', $id)->first();
        $questionair->duration = str_replace(' ', '', $questionair->duration);

        return view('createQuestionair',['Questionair'=> $questionair]);

    }
    public function updateQuestionair(Request $request){

      $questionair = Questionair::where( 'id','=', $request->questionairId )->first();
      $questionair->name = $request->name;
      $questionair->duration = $request->duration . " ";
      $questionair->timeType = $request->timeType;
      $questionair->save();

        $questionairs = Questionair::all();
        return view('questionairs',['Questionairs' => $questionairs]);
        
    }

    public function addQuestion($id){

        $Questionair = Questionair::where('id','=',intval($id))->first();
        $Questions = $Questionair->Questions;
        return view('addQuestion',['Questionair'=>$Questionair,'Questions' => $Questions]);

    }

    public function saveQuestions(Request $request){
        
        foreach ($request->Questions as $Question) {

           $question = Question::firstOrNew(['id' => $Question["questionId"]]);
           $question->text = $Question["questionText"];
           $question->type = $Question["questionType"];
           if(strpos($Question["questionId"], "questionN")==false || strpos($Question["questionId"], "questionN")== -1)
            {
              $question->answer = $Question["questionAnswer"];
            }
           $question->questionair_id = $request->QuestionairId; 
           $question->save();
           $questionID = Question::where("text","=", $Question["questionText"])->first();
           if($Question["questionType"]=="multipleS" || $Question["questionType"]=="multipleM")
           {
                foreach($Question["questionChoices"] as $Ch)
                {
                    $choice = QuestionChoice::firstOrNew(['id'=>intval($Ch["choiceId"])]);
                    $choice->text = $Ch["choiceText"];
                    $choice->question_id = $questionID->id;
                    $choice->save();
                }
           }
           
           
        }
        return redirect('/questionairs');
    }

}
