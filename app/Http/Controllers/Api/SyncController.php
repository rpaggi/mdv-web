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
        \Log::info("[Sync Recebido] " . json_encode($data));

        $date = substr($request->date, 6, 4)."-".substr($request->date, 3, 2)."-".substr($request->date, 0, 2);
        $hour = $request->hour.":00";

        $exists = \DB::table('people as p')
            ->join('exams as e', 'e.person_id', '=', 'p.id')
            ->where('p.name', $data['name'])
            ->where('p.document', $data['document'])
            ->where('e.exam_at', Carbon::parse($date." ".$hour))
            ->get();

        if(count($exists) > 0){
            \Log::info("[Entrada duplicada no SYNC]");
            return response()->json(["status"=>true, "message"=>"Duplicate Entry"]);
        }

        $data['address_city_id'] = $request->city["_id"];

        try{
            $person = Person::create($data);

            Exam::create([
                "person_id" => $person->id,
                "agent_id" => $data["user_id"],
                "exam_at" => Carbon::parse($date." ".$hour),
                "notes" => $data["notes"]
            ]);
        }catch(\Exception $e){
            \Log::error("[Erro ao gravar]");
            \Log::error($e);
            return response()->json(["status"=>false]);
        }

        return response()->json(["status"=>true]);
    }
}
