<?php

namespace App\Http\Controllers;

use App\Models\Discount;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DiscountController extends Controller
{

    public function addDiscount(Request $request)
    {
        $result = [];
        if($request->en != null){
            $expiredAt = Carbon::parse($request->expired_at)
                        ->setTimezone('Asia/Kuala_Lumpur')
                        ->toDateTimeString();

            $desc = Discount::create([
                'name' => $request->en['title'],
                'expired_at' => $expiredAt
            ]);
            if($desc){
                if($request->en){
                    $resultEn = DB::table('ticket_discounts_lang')
                        ->insert([
                            'name' => $request->en['title'],
                            'description' => $request->en['description'],
                            'discount_id' => $desc->id,
                            'language_id' => 1
                        ]);
                }
                if($request->zh){
                    $resultZh = DB::table('ticket_discounts_lang')
                        ->insert([
                            'name' => $request->zh['title'],
                            'description' => $request->zh['description'],
                            'discount_id' => $desc->id,
                            'language_id' => 2
                        ]);
                }

                if($resultEn && $resultZh){
                    $result['success'] = true;
                    $result['message'] = 'data created';
                }else{
                    $result['success'] = false;
                    $result['message'] = 'Data created failed.';
                }
            }
        }

        return $result;
    }

    public function showDiscount(Request $request)
    {
        $data = [];
        $language = ($request->header("accept-language") == "en") ? "1" :  "2";

        $disc = Discount::all();

        if($disc->isNotEmpty()){
            foreach ($disc as $key => $value) {
                $expired_at = $value['expired_at'];
                $created_at = $value['created_at'];
                $id = $value['id'];

                $langData = DB::table('ticket_discounts_lang')
                            ->where('discount_id',$id)
                            ->where('language_id',$language)
                            ->get(['name','description','discount_id']);

                foreach ($langData as $lang) {
                    $data[] = [
                        'id' => $lang->discount_id,
                        'title' => $lang->name,
                        'description' => $lang->description,
                        'created_at' => $created_at->format('Y-m-d H:i:s'),
                        'expired_at' => $expired_at,
                    ];
                }
            }
        }

        return response()->json([
            'success' => true,
            'data' => $data
        ]);
    }

    public function getDiscount(Request $request){
        $result = [];
        $data = [];

        $expired_at = Discount::where('id',$request->discount_id)
                        ->first('expired_at')->expired_at;

        $discount = DB::table('ticket_discounts_lang')
                ->where('discount_id',$request->discount_id)
                ->get();

        if($discount){
            foreach ($discount as $value) {
                switch ($value->language_id) {
                    case 1:
                        $data['en'] = $value;
                        break;
                    
                    case 2:
                        $data['zh'] = $value;
                }
            }
            $data['expired_at'] = $expired_at;

            $result['success'] = true;
            $result['data'] = $data;
        }else{
            $result['success'] = false;
            $result['data'] = $data;
        }

        return $result;
    }

    public function editDiscount(Request $request)
    {
        $result = [];

        if($request->discount_id != 0 || $request->discount_id != null){
            $table = Discount::where('id',$request->discount_id)
                ->update([
                    'name'=> $request->en['name']
                ]);
            if($table){
                if($request->en){
                    $resultEN = DB::table('ticket_discounts_lang')
                        ->where('discount_id',$request->discount_id)
                        ->where('language_id',1)
                        ->update([
                            'name' => $request->en['name'],
                            'description' => $request->en['description'],
                        ]);
                    if($request->zh){
                        $resultZH = DB::table('ticket_discounts_lang')
                        ->where('discount_id',$request->discount_id)
                        ->where('language_id',2)
                        ->update([
                            'name' => $request->zh['name'],
                            'description' => $request->zh['description'],
                        ]);
                    }

                    if ($resultZH > 0 || $resultEN > 0) {
                        $result['success'] = true;
                        $result['message'] = 'success';
                    } else {
                        $result['success'] = false;
                    }
                }
            }else {
                $result['success'] = false;
            }
        }

        return response()->json($result);
    }

}
