<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreVisitorRequest;
use App\Models\Area;
use App\Models\Visitor;
use Illuminate\Support\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VisitanteController extends Controller
{
    public function index()
    {
        $date=Carbon::today();
        $visitors=Visitor::whereDate('fecha_hora',$date)->get();
        $areas=Area::all();
        return view('vigilante.visitante.index',compact('visitors','areas'));
    }
    public function store(StoreVisitorRequest $request)
    {
        try {
            DB::beginTransaction();
                //Crear un visitante
                $visitor=Visitor::create($request->all());
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
        }
        return redirect()->route('visitors.index')->with('success','Visitante Registrado');        
    }
}
