<?php

namespace App\Http\Controllers;

use App\Models\Rodada;
use App\Models\Time;
use App\Models\Welcome;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WelcomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $times = DB::table('tabela_2022')
            ->orderBy('ponto', 'desc')
            ->orderBy('vitoria', 'desc')
            ->orderBy('empate', 'desc')
            ->orderBy('derrota', 'asc')
            ->orderBy('time', 'asc')
            ->get();

        return view('welcome', ['titulo' => 'Tabela'])->with(compact('times'));
    }

    public function listar()
    {
        try {
            $times = DB::table('tabela_2022')
                ->orderBy('ponto', 'desc')
                ->orderBy('vitoria', 'desc')
                ->orderBy('empate', 'desc')
                ->orderBy('derrota', 'asc')
                ->orderBy('time', 'asc')
                ->get();
            return response()->json($times);
        } catch (Exception $ex) {
            return response()->json(['error' => true, 'message' => $ex->getMessage()], $ex->getCode());
        }
    }

    public function time()
    {
        try {
            $times = Time::all();
            return response()->json($times);
        } catch (Exception $ex) {
            return response()->json(['error' => true, 'message' => $ex->getMessage()], $ex->getCode());
        }
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
     * @param  \App\Models\Welcome  $welcome
     * @return \Illuminate\Http\Response
     */
    public function show(Welcome $welcome)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Welcome  $welcome
     * @return \Illuminate\Http\Response
     */
    public function edit(Welcome $welcome)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Welcome  $welcome
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Welcome $welcome)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Welcome  $welcome
     * @return \Illuminate\Http\Response
     */
    public function destroy(Welcome $welcome)
    {
        //
    }
}
