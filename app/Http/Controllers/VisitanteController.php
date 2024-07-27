<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreVisitorRequest;
use App\Models\Area;
use App\Models\Visitor;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VisitanteController extends Controller
{
    public function index()
    {
        $visitors=Visitor::all();
        $areas=Area::all();
        return view('vigilante.visitante.index',compact('visitors','areas'));
    }
    public function store(StoreVisitorRequest $request)
    {
        try {
            DB::beginTransaction();
                //Crear un usuario
                $visitor=Visitor::create($request->all());
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
        }
        return redirect()->route('visitors.index')->with('success','Visitante Registrado');        
    }
}
