<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Support\Arr;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users=User::all();
        return view('admin.admin.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.admin.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        try {
            DB::beginTransaction();
                //Encriptar la contraseña
                $fieldHash=Hash::make($request->password);
                //Modificar el valor de password en nuestro request
                $request->merge(['password'=>$fieldHash]);
                //Crear un usuario
                $user=User::create($request->all());
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->route('users.index')->with('error','Usuario no Registrado');
        }
        return redirect()->route('users.index')->with('success','Usuario Registrado');
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
    public function edit(User $user)
    {
        return view('admin.admin.edit',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        try {
            DB::beginTransaction();
                //Comprobar el password y aplicar el Hash
                if(empty($request->password)){
                    $request= Arr::except($request, array('password'));
                }else{
                    $fieldHash=Hash::make($request->password);
                    $request->merge(['password'=>$fieldHash]);
                }
                $user->update($request->all());
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
        }
        return redirect()->route('users.index')->with('success','El usuario '.$user->names.' fue editado');      
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user=User::find($id);
        //Eliminar al usario
        $user->delete();
        return redirect()->route('users.index')->with('success','El usuario '.$user->names.' fue eliminado');
    }
}
