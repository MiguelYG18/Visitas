<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAreaRequest;
use App\Models\Area;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AreaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $areas = Area::all();
        return view('admin.area.index', compact('areas')); 
    }
    public function store(StoreAreaRequest $request)
    {
        try {
            DB::beginTransaction();
            $area = new Area();
            $area->fill([
                'names' => $request->names,
            ]);
            $area->save();
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
        }
        return redirect()->route('areas.index')->with('success', 'Área registrada');
    }
}
