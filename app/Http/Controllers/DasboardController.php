<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class DasboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $areas=Area::count();
        $users=User::count();
        $date=Carbon::today();
        // Obtener el mes y año actual
        $inicioMes = Carbon::now()->startOfMonth();
        $finMes = Carbon::now()->endOfMonth();
        $month=User::whereBetween('created_at', [$inicioMes, $finMes])->count();
        $today=User::whereDate('created_at',$date)->count();
        return view('dashboard',compact('areas','users','today','month'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
