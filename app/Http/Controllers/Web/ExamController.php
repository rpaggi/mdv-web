<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Exam;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ExamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $build = Exam::with(['person']);

        if($request->term){
            $build->whereHas('person', function($query) use($request){
                $query->where('document', $request->term)
                    ->orWhere('name', 'like', "%$request->term%")
                    ->orWhere('nickname', 'like', "%$request->term%")
                    ->orWhere('phone', $request->term);
            });
        }

        if($request->startDate){
            $build->where('exam_at', '>=', Carbon::parse($request->startDate)->startOfDay() );
        }

        if($request->endDate){
            $build->where('exam_at', '<=', Carbon::parse($request->endDate)->endOfDay() );
        }

        return Inertia::render('Exam/List',[
            'exams' => $build->paginate(8)
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $exam = Exam::with(['person', 'person.city', 'person.city.state'])->findOrFail($id);

        return Inertia::render('Exam/Show', [
            "exam" => $exam
        ]);
    }

    public function formReport($id){
        $exam = Exam::with(['person', 'person.city', 'person.city.state'])->findOrFail($id);

        return Inertia::render('Exam/Report', [
            "exam" => $exam
        ]);
    }
}
