<?php
namespace App\Modules\Site\Controllers\v1;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class QuestionController extends Controller {

    public function list(Request $request){
        return response()->json(['status' => 'success', 'data' => [
            'mok_data_new' => 'it is ok new'
        ]]);
    }



}
