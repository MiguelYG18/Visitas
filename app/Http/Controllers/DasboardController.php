<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Visitor;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Mpdf\Mpdf;
use Illuminate\Support\Facades\View;

class DasboardController extends Controller
{
    public function dashboard(){
        $user= Auth::user();        
        if($user->level == 1){ 
            $users=User::count();
            $rest=User::where('status',0)->count();
            $asset=User::where('status',1)->count();
            $linked = DB::table('sessions')
            ->where('last_activity', '>=', now()->subMinutes(config('session.lifetime'))->timestamp)
            ->count();
            return view('admin.dashboard',compact('users','rest','asset','linked'));
        }
        if($user->level == 2){
            $inicioMes = Carbon::now()->startOfMonth();
            $finMes = Carbon::now()->endOfMonth();
            $date=Carbon::today();
            $visitors=Visitor::count();
            $month=Visitor::whereBetween('created_at', [$inicioMes, $finMes])->count();
            $today=Visitor::whereDate('created_at',$date)->count();
            return view('vigilante.dashboard',compact('visitors','today','month'));
        } 
    }
    public function reporte(){
        // Obtener todos los visitantes
        $date=Carbon::today();
        $visitors = Visitor::whereDate('created_at',$date)->get(); // O personaliza la consulta si es necesario
        // Cargar la vista y pasar los datos de los usuarios
        $view = View::make('vigilante.report.today', ['visitors' => $visitors]);
        // Obtener el contenido HTML de la vista
        $html = $view->render();
        // Crear una instancia de mPDF
        $mpdf = new Mpdf();
        // Configurar el pie de página centrado
        $footerHtml = '<footer>Página {PAGENO} de {nbpg}</footer>';
        $mpdf->SetHTMLFooter($footerHtml);      
        // Escribir el contenido HTML en el PDF
        $mpdf->WriteHTML($html);
        // Nombre del archivo con fecha
        $filename = 'reporte_visitantes_' . $date->toDateString() . '.pdf';
        // Devolver el PDF como respuesta
        return response($mpdf->Output($filename, 'I')) // 'I' para Inline, 'D' para Descargar
            ->header('Content-Type', 'application/pdf')
            ->header('Content-Disposition', 'inline; filename="' . $filename . '"'); 
    } 
}
