<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(){
        if(!empty(Auth::check())){
            if(Auth::user()->level == 1){
                //Redireccionar al link de acuerdo al rol
                return redirect('admin/panel');
            }
            if(Auth::user()->level == 2){
                //Redireccionar al link de acuerdo al rol
                return redirect('vigilante/panel');
            }
        }
        return view('auth.login');
    }
    public function AuthLogin(AuthRequest $request){
        $remember = $request->filled('remember');
        // Intentar iniciar sesión del usuario
        if (Auth::attempt(['dni' => $request->dni, 'password' => $request->password], $remember)) {
            // Verificar si el estado del usuario es activo
            if (Auth::user()->status == 1) {
                $request->session()->regenerate();
                // Guardar el DNI en la sesión solo si el checkbox "Recordar" está marcado
                if ($remember) {
                    $request->session()->put('dni', $request->dni);
                } else {
                    $request->session()->forget('dni'); // Eliminar el DNI de la sesión si el checkbox "Recordar" no está marcado
                }
                // Redirigir al usuario según su nivel
                switch (Auth::user()->user_level) {
                    case 1:
                        return redirect('admin/panel');
                    case 2:
                        return redirect('vigilante/panel');
                    default:
                        return redirect('/'); // Redirigir a una ruta por defecto si no hay una coincidencia
                }
            } else {
                Auth::logout(); // Cerrar sesión del usuario si el estado del usuario o del grupo es inactivo
                return redirect()->back()->withErrors('Usted no tiene acceso');
            }
        } else {
            // Si el usuario no existe o la contraseña es incorrecta
            return redirect()->back()->withErrors('Por favor, ingrese su usuario y contraseña correctas');
        }
    }  
    public function Logout(){
        Auth::logout();
        return redirect(url('/'));
    }    
}
