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
            $paddingModel = Padding::find($user_id);

            return response()->json([
                'success' => true,
                'message' => 'Успешно',
                'data'    => [
                    'padding_top'    => $paddingModel->padding_top,
                    'padding_bottom' => $paddingModel->padding_bottom,
                ],
            ]);

        } catch (\Exception $e){
            DB::rollBack();
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }

    }

    public function edit(Request $request){
        $user_id        = $request->user_id;

        $padding_top    = $request->data['padding_top'];
        $padding_bottom = $request->data['padding_bottom'];

        if(!$user_id && (!$padding_top || !$padding_bottom))
            return response()->json([
                'success'   => false,
                'message'   => 'Нет user_id или нет значения нужного padding.',
            ]);

        DB::beginTransaction();
        try {
            $paddingModel = Padding::find($user_id) ?: new Padding();

            if($padding_top)    $paddingModel->padding_top    = $padding_top;
            if($padding_bottom) $paddingModel->padding_bottom = $padding_bottom;
            $paddingModel->save();

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
