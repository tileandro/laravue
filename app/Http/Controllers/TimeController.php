<?php

namespace App\Http\Controllers;

use App\Models\Time;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TimeController extends Controller
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
        return view('times.index', ['titulo' => 'Times', 'times' => $times]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('times.create', ['titulo' => 'Cadastrar Time']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            //dd($request);

            if ($request->hasFile('escudo')) {
                $file = $request->file('escudo');
                $extension = $request->file('escudo')->getClientOriginalExtension();
                $name = uniqid();
                //salva um nome baseado no id
                $nameFile = $name . '.' . $extension;
                $file->move(public_path('image'), $nameFile);
                $time = new Time();
                $time->time = $request->time;
                $time->escudo = 'image/' . $nameFile;
                $time->save();
                return response()->json([$time], 201);
            }
        } catch (Exception $ex) {
            return response()->json(['error' => true, 'message' => $ex->getMessage()], $ex->getCode());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Time  $time
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        try {
            $time = Time::where('id', $id)->get();
            $time = json_decode($time, true);
            if (!empty($time)) {
                return response()->json($time, 201);
            } else {
                return response()->json([['error' => true, 'message' => 'Time não encontrado!']], 201);
            }
        } catch (Exception $ex) {
            return response()->json(['error' => true, 'message' => $ex->getMessage()], $ex->getCode());
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Time  $time
     * @return \Illuminate\Http\Response
     */
    public function edit(Time $time)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Time  $time
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Time $time)
    {
        try {
            $time = $time->update($request->all());
            //$time = Time::where('id', $id)->update([
            //    'ponto' => $request->ponto,
            //    'jogo' => $request->jogo,
            //    'vitoria' => $request->vitoria,
            //    'empate' => $request->empate,
            //    'derrota' => $request->derrota
            //]);
            $time = json_decode($time, true);
            if (!empty($time)) {
                return response()->json($time, 201);
            } else {
                return response()->json([['error' => true, 'message' => 'Time não encontrado!']], 201);
            }
        } catch (Exception $ex) {
            return response()->json(['error' => true, 'message' => $ex->getMessage()], $ex->getCode());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Time  $time
     * @return \Illuminate\Http\Response
     */
    public function destroy(Time $time)
    {
        try {
            $time->delete();
            return response()->json([$time], 201);
        } catch (Exception $ex) {
            return response()->json(['error' => true, 'message' => $ex->getMessage()], $ex->getCode());
        }
    }
}
