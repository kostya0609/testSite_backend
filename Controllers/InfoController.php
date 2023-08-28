<?php
namespace App\Modules\Site\Controllers;

use App\Http\Controllers\Controller;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InfoController extends Controller {

    public function get(Request $request){

        return response()->json(['status' => 'success', 'data' => [
            'mok_data_new' => 'it is ok new'
        ]]);
    }



}
