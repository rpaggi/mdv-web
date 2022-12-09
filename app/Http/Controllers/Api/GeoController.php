<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Guiliredu\BrazilianCityMigrationSeed\Models\City;
use Guiliredu\BrazilianCityMigrationSeed\Models\State;
use Illuminate\Http\Request;

class GeoController extends Controller
{
    public function getStates(Request $request){
        $builder = State::query();

        if($request->filled('term')){
            $builder->where('title', 'like', '%'.$request->term.'%');
        }

        return response()->json($builder->get());
    }

    public function getCities(Request $request){
        $builder = City::query();

        if($request->filled('state_id')){
            $builder->where('state_id', $request->state_id);
        }

        if($request->filled('term')){
            $builder->where('title', 'like', '%'.$request->term.'%');
        }

        return response()->json($builder->get());
    }
}
