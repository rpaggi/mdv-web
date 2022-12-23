<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Exam;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class HomeController extends Controller
{
    public function index(){
        $day = Exam::where("exam_at", ">=", Carbon::today()->setTimezone(-3)->startOfDay())
            ->where("exam_at", "<=", Carbon::today()->setTimezone(-3)->endOfDay())
            ->get()->count();

        $week = Exam::where("exam_at", ">=", Carbon::today()->setTimezone(-3)->startOfWeek()->startOfDay())
            ->where("exam_at", "<=", Carbon::today()->setTimezone(-3)->endOfWeek()->endOfDay())
            ->get()->count();

        $month = Exam::where("exam_at", ">=", Carbon::today()->setTimezone(-3)->startOfMonth()->startOfDay())
            ->where("exam_at", "<=", Carbon::today()->setTimezone(-3)->endOfMonth()->endOfDay())
            ->get()->count();

        return Inertia::render('Dashboard', [
            "counts" => [
                "day" => $day,
                "week" => $week,
                "month" => $month,
            ]
        ]);
    }

    public function examByAgent(Request $request){
        $startDate = Carbon::today()->setTimezone(-3)->startOfDay();
        $endDate = Carbon::today()->setTimezone(-3)->endOfDay();
        if($request->filled("startDate")){
            $startDate = Carbon::parse($request->startDate)->startOfDay();
        }
        if($request->filled("endDate")){
            $endDate = Carbon::parse($request->endDate)->endOfDay();
        }

        $query = DB::table('users as u')
            ->join('exams as e', 'u.id', '=', 'e.agent_id')
            ->selectRaw('u.name, count(e.id) as count')
            ->where('e.created_at', '>=', $startDate)
            ->where('e.created_at', '<=', $endDate)
            ->orderBy('u.name')
            ->groupBy('u.id')
            ->get();

        return response()->json($query, 200);

    }
}
