<?php

namespace App\Modules\Site\Controllers\v1;

use App\Http\Controllers\Controller;
use App\Modules\Site\Model\Padding;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PaddingController extends Controller{

    public function get(Request $request){
        $user_id     = $request->user_id;

        if(!$user_id)
            return response()->json([
                'success'   => false,
                'message'   => 'Нет user_id.',
            ]);

        DB::beginTransaction();
        try {
            $paddingModel = Padding::where('user_id', '=', $user_id)->first();

            $padding_top    = $paddingModel ? $paddingModel->padding_top    : 0;
            $padding_bottom = $paddingModel ? $paddingModel->padding_bottom : 0;

            return response()->json([
                'success' => true,
                'message' => 'Успешно',
                'data'    => [
                    'padding_top'    => $padding_top,
                    'padding_bottom' => $padding_bottom,
                ],
            ]);

        } catch (\Exception $e){
            DB::rollBack();
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }

    }

    public function change(Request $request){
        $user_id        = $request->user_id;

        $padding_type   = $request->padding_type;
        $padding_top    = $request->padding_top    ?: null;
        $padding_bottom = $request->padding_bottom ?: null;

        if(!$user_id )
            return response()->json([
                'success'   => false,
                'message'   => 'Нет user_id',
            ]);

        DB::beginTransaction();
        try {
            $paddingModel = Padding::where('user_id', '=', $user_id)->first() ?: new Padding();

            $paddingModel->user_id = $user_id;

            if($padding_type === 'top')    $paddingModel->padding_top    = $padding_top;
            if($padding_type === 'bottom') $paddingModel->padding_bottom = $padding_bottom;

            $paddingModel->save();

            DB::commit();
            return response()->json([
                'success' => true,
                'message' => 'Успешно',
            ]);

        } catch (\Exception $e){
            DB::rollBack();
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }

    }

}
