<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\ExamEditRequest;
use App\Models\Exam;
use App\Models\Person;
use Carbon\Carbon;
use Guiliredu\BrazilianCityMigrationSeed\Models\City;
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
            $build->whereDate('exam_at', '>=', Carbon::parse($request->startDate) );
        }

        if($request->endDate){
            $build->whereDate('exam_at', '<=', Carbon::parse($request->endDate) );
        }

        if($request->startTime){
            $build->whereTime('exam_at', '>=', $request->startTime.":00" );
        }

        if($request->endTime){
            $build->whereTime('exam_at', '<=', $request->endTime.":00" );
        }

        if($request->cityId){
            $build->whereHas('person', function($query) use($request){
                $query->where('address_city_id', $request->cityId);
            });
        }

        $cities = City::with("state")->orderBy("title")->get();

        return Inertia::render('Exam/List',[
            'exams' => $build->orderBy('exam_at', 'desc')->paginate(8),
            'cities' => $cities
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
            "exams" => [$exam]
        ]);
    }

    public function formMultiReport(Request $request){
        $build = Exam::with(['person', 'person.city', 'person.city.state']);

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

        if($request->startTime){
            $build->whereTime('exam_at', '>=', $request->startTime.":00" );
        }

        if($request->endTime){
            $build->whereTime('exam_at', '<=', $request->endTime.":00" );
        }

        if($request->cityId){
            $build->whereHas('person', function($query) use($request){
                $query->where('address_city_id', $request->cityId);
            });
        }

        return Inertia::render('Exam/Report', [
            "exams" => $build->get()
        ]);
    }

    public function edit($id)
    {
        $exam = Exam::with(['person', 'person.city', 'person.city.state'])->findOrFail($id);

        return Inertia::render('Exam/Form', [
            "exam" => $exam,
            "cities" => City::with("state")->orderBy("title")->get()
        ]);
    }

    public function update(ExamEditRequest $request, $id){
        $data = $request->all();
        $data["exam_at"] = Carbon::parse($data["exam_at"])->setTimezone("America/Sao_Paulo");

        $exam = Exam::findOrFail($id);
        $exam->update($data);

        $person = Person::findOrFail($data["person"]["id"]);
        $person->update($data["person"]);

        return redirect()->route('exams.show', ['exam' => $exam->id]);
    }

    public function destroy($id){
        Exam::findOrFail($id)->delete();

        return response()->json('success');
    }
}
