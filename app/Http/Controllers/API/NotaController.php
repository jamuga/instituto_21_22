<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\NotaResource;
use App\Models\Nota;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NotaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->authorizeResource(Nota::class, 'nota');
    }

    public function index()
    {
        return NotaResource::collection(Nota::paginate(20));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $nota = json_decode($request->getContent(), true);

        $nota = Nota::create($nota);

        return new NotaResource($nota);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Nota  $nota
     * @return \Illuminate\Http\Response
     */
    public function show(Nota $nota)
    {
        return new NotaResource($nota);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Nota  $nota
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Nota $nota)
    {
        $notaData = json_decode($request->getContent(), true);
        $nota->update($notaData);

        return new NotaResource($nota);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Nota  $nota
     * @return \Illuminate\Http\Response
     */
    public function destroy(Nota $nota)
    {
        $nota->delete();
    }

    public function calcularMedia(Request $request, $materia_id)
    {
        //return $request->user()->id;
        //return $materia_id;
        $total=0;
        $notas = DB::table('notas')->where('user_id', $request->user()->id)
            ->where('materia_id', $materia_id)
            ->get('nota');

        $totalNotas = DB::table('notas')->where('user_id', $request->user()->id)
            ->where('materia_id', $materia_id)
            ->count();

        foreach ($notas as $key => $value) {
            $total = $value->nota + $total;

        }
        return "La nota media del alumno: ".$request->user()->name . " es: ".$total/$totalNotas;
    }
}
