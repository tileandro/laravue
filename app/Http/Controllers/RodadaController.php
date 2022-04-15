<?php

namespace App\Http\Controllers;

use App\Models\Rodada;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class RodadaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$rodadas = Rodada::all();
        return view('rodadas.index', ['titulo' => 'Rodadas']);
    }

    //public function jogos()
    //{
    //    try {
    //        $request = request()->query();
    //        $jogos = Rodada::query();
    //
    //        //if (!empty($request['rodada'])) {
    //        //    $jogos->where('rodada', '=', $request['rodada']);
    //        //}
    //        $jogos->when(!empty($request['rodada']), function ($query) use ($request) {
    //            $query->where('rodada', '=', $request['rodada'])->orderBy('data_jogo');
    //        });
    //
    //        return $jogos->get();
    //    } catch (Exception $ex) {
    //        return response()->json(['error' => true, 'message' => $ex->getMessage()], $ex->getCode());
    //    }
    //}

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
        try {
            $rodadas = $request->all();
            $rodadas = Rodada::create($rodadas)->toArray();
            return response()->json([$rodadas], 201);
        } catch (Exception $ex) {
            return response()->json(['error' => true, 'message' => $ex->getMessage()], $ex->getCode());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Rodada  $rodada
     * @return \Illuminate\Http\Response
     */
    public function show(int $rodada)
    {
        try {
            $rodadas = Rodada::where('rodada', $rodada)->orderBy('data_jogo')->get();
            //throw_unless($rodadas, new Exception('Registro nao encontrado', 422));
            $rodadas = json_decode($rodadas, true);
            if (!empty($rodadas)) {
                return response()->json($rodadas, 201);
            } else {
                return response()->json([['error' => true, 'message' => 'Rodada não cadastrada!']], 201);
            }
        } catch (Exception $ex) {
            return response()->json(['error' => true, 'message' => $ex->getMessage()], $ex->getCode());
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Rodada  $rodada
     * @return \Illuminate\Http\Response
     */
    public function edit(Rodada $rodada)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Rodada  $rodada
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Rodada $rodada)
    {
        try {
            $rodada = $rodada->update($request->all());
            $rodada = json_decode($rodada, true);
            if (!empty($rodada)) {
                return response()->json($rodada, 201);
            } else {
                return response()->json([['error' => true, 'message' => 'Rodada não encontrado!']], 201);
            }
        } catch (Exception $ex) {
            return response()->json(['error' => true, 'message' => $ex->getMessage()], $ex->getCode());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Rodada  $rodada
     * @return \Illuminate\Http\Response
     */
    public function destroy(Rodada $rodada)
    {
        //
    }
}
