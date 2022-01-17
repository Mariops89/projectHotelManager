<?php

namespace App\Http\Controllers;

use App\Models\Login;
use App\Services\PlantillaService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{

    public function mostrar(PlantillaService $plantilla)
    {
        $plantilla->setHeader(false);
        $plantilla->setSidebar(false);
        $plantilla->setFooter(false);
        $plantilla->setPageBreadcrumb(false);
        $plantilla->setTitle('Login');
        $plantilla->setCss('paginas/login/css/login.css'); //esto es el js, no la vista*/
        $plantilla->setJs('paginas/login/js/login.js'); //esto es el js, no la vista*/

        return $plantilla->load('login/login'); //la vista
    }


    public function login(Request $request)
    {
        $credentials = $request->validate([
            'usuario' => ['required'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->route('dashboard');
        }

        return back()->withErrors([
            'login' => 'Usuario y contraseña incorrectos',
        ]);
    }


    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }

}
