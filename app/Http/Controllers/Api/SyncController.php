<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Exam;
use App\Models\Person;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SyncController extends Controller
{
    public function sync(Request $request){
        $data = $request->all();

        $data['address_city_id'] = $request->city["_id"];
        $date = substr($request->date, 6, 4)."-".substr($request->date, 3, 2)."-".substr($request->date, 0, 2);
        $hour = $request->hour.":00";
        try{
            $person = Person::create($data);

            Exam::create([
                "person_id" => $person->id,
                "exam_at" => Carbon::parse($date." ".$hour)
            ]);
        }catch(\Exception $e){
            \Log::error("[Erro ao gravar]");
            \Log::error($e);
            return response()->json(["status"=>false]);
        }

        return response()->json(["status"=>true]);
    }
}
