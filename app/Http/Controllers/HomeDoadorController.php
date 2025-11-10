<?php



namespace App\Http\Controllers;

use App\Models\Campanha;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class HomeDoadorController extends Controller
{

    public function index()
    {
        $doador = Auth::guard('doador')->user();
        $campanhas = Campanha::with('instituicao')->latest()->get();

        return view('doador.home', compact('doador', 'campanhas'));
    }
}
