<?php

namespace App\Http\Controllers;

use App\Models\Doacao;
use Illuminate\Http\Request;

class DoacaoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Doacao  $doacao
     * @return \Illuminate\Http\Response
     */
    public function show(Doacao $doacao)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Doacao  $doacao
     * @return \Illuminate\Http\Response
     */
    public function edit(Doacao $doacao)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Doacao  $doacao
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Doacao $doacao)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Doacao  $doacao
     * @return \Illuminate\Http\Response
     */
    public function destroy(Doacao $doacao)
    {
        //
    }

    /**
     * Display the donations of the logged in donor.
     *
     * @return \Illuminate\Http\Response
     */
    public function minhas()
    {
        // Buscar doações do banco de dados com relacionamentos
        $doacoes = \App\Models\Doacao::with(['campanha.instituicao'])
            ->orderBy('created_at', 'desc')
            ->get();
        
        return view('doador.minhas-doacoes', compact('doacoes'));
    }
}
