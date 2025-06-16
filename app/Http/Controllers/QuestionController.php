<?php

namespace App\Http\Controllers;

use App\Models\Language;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class QuestionController extends Controller
{
    public function all(Request $request){
        $data = [];
        $language = ($request->header("accept-language") == "en") ? "1" :  "2";

        App::setLocale($request->header("accept-language"));

        $question = Question::get(['id','created_at','updated_at']);
        for( $i = 0; $i < count($question); $i++ ){
            $questionResult = DB::table('ticket_common_question_lang')
                    ->where('question_id',$question[$i]->id)
                    ->where('language_id', $language)
                    ->where('is_delete',0)
                    ->first(['question_id','title','answers','is_show']);

            if($questionResult) {
                $data[] = [
                    'id'=> $questionResult->question_id,
                    'title'=> $questionResult->title,
                    'answers'=> $questionResult->answers,
                    'created_at' => $question[$i]->created_at->format('Y-m-d'),
                    'updated_at' => $question[$i]->created_at->format('Y-m-d'),
                    'show'=> ($questionResult->is_show == 0) ? true : false ,
                ];
            }
        }

        if(count($data) > 0){

            $result['success'] = true;
            $result['message'] = $data;
        }

        return $data;
    }

    public function addQuestion(Request $request){

        if($request->en != null){
            $eng = $request->en;
            $zh = $request->zh;

            $questionID = Question::create([
                'title' => $eng['questionEN']
            ]);
            if($questionID){
                if($request->en){
                    DB::table('ticket_common_question_lang')->insert([
                        'title' => $eng['questionEN'],
                        'answers' => $eng['answersEN'],
                        'question_id' => $questionID->id,
                        'language_id' => 1
                    ]);
                }
                if($request->zh){
                    DB::table('ticket_common_question_lang')->insert([
                        'title' => $zh['questionCN'],
                        'answers' => $zh['answersCN'],
                        'question_id' => $questionID->id,
                        'language_id' => 2
                    ]);
                }
                $result['success'] = true;
                $result['data'] = ['id' => $questionID->id];
            }
        }
        return response()->json($result);
    }

    public function getQuestionDetails(Request $request){

        $result = [];
        $languageList = Language::get(['id','code']);

        if($request){
            $row =  DB::table('ticket_common_question_lang')
                ->where('question_id',$request->question_id)
                ->get(['question_id','title','answers','language_id']);
            if($row){
                $data = [];
                foreach ($languageList as $key => $lang) {
                    foreach ($row as $key => $value) {
                        if($value->language_id == $lang->id){
                            $data[$lang->code] = $value;
                        }
                    }
                }
                foreach ($row as $key => $value) {
                    
                }
                $result['success'] = true;
                $result['data'] = $data;
            }else{
                $result['success'] = false;
                $result['data'] = [];
            }
        }

        return response()->json($result);
    }

    public function editQuestion(Request $request){

        if($request->questionID != 0 || $request->questionID != null){
            $table = Question::where('id',$request->questionID)
                ->update([
                    'title'=> $request->en['question']
                ]);
            if($table){
                if($request->en){
                    $resultEN = DB::table('ticket_common_question_lang')
                        ->where('question_id',$request->questionID)
                        ->where('language_id',1)
                        ->update([
                            'title' => $request->en['question'],
                            'answers' => $request->en['answers'],
                        ]);
                    if($request->zh){
                        $resultZH = DB::table('ticket_common_question_lang')
                        ->where('question_id',$request->questionID)
                        ->where('language_id',2)
                        ->update([
                            'title' => $request->zh['question'],
                            'answers' => $request->zh['answers'],
                        ]);
                    }

                    if ($resultZH > 0 || $resultEN > 0) {
                        $result['success'] = true;
                        $result['data']['en'] = $resultEN;
                    } else {
                        $result['success'] = false;
                    }
                }
            }
        }
        return response()->json($result);
    }

    public function editShow(Request $request) {
        $questionId = $request->id;
        $isDelete = $request->show ? 0 : 1;

        // Question::where('id',$request->id)
        //     ->update([
        //         'is_delete' => $isDelete
        //     ]);
    
        $updateData = DB::table('ticket_common_question_lang')
            ->where('question_id', $questionId)
            ->update([
                'is_show' => $isDelete
            ]);
    
        $result = [];
    
        if ($updateData > 0) {
            $result['success'] = true;
            $result['data'] = $updateData;
        } else {
            $result['success'] = false;
            $result['message'] = "No matching records found or already updated.";
            $result['debug'] = DB::table('ticket_common_question_lang')
                ->where('question_id', $questionId)
                ->get();
        }
    
        return response()->json($result);
    }

    public function deleteQuestion(Request $request){
        $result = [];

        foreach ($request->selected as $key => $value) {

            $rowQues = Question::where('id',$value)
                ->update([
                    'is_delete' => 1
                ]);

            $rowLang = DB::table('ticket_common_question_lang')
                    ->where('question_id',$value)
                    ->update([
                        'is_delete' => 1
                    ]);
        }
        if($rowLang || $rowQues){
            $result['success'] = true;
            $result['message'] = 'Delete Success';
        }else{
            $result['success'] = false;
            $result['message'] = 'No row for delete !';
        }
                    
        return response()->json($result);
    }
    
}
