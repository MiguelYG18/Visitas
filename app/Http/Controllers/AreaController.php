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
        return view('area.index', compact('areas')); 
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
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

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
