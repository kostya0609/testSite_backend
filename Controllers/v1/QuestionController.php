<?php
namespace App\Modules\Site\Controllers\v1;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class QuestionController extends Controller {

    public function list(Request $request){
        return response()->json([
            'success'     => true,
            'data'        => [
                'mok_data' => 'it is ok',
            ],
        ]);
    }



}
