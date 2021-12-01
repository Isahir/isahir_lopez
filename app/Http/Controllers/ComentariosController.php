<?php

namespace App\Http\Controllers;

use App\Models\Comentarios;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ComentariosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $date['comentarios']=Comentarios::paginate(5);
        return view('comentarios.index', $date);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('comentarios.create');
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


        $fields=[
            'Nombre'=>'required | string| max:100',
            'Correo'=>'required |email',
            'Telefono'=>'required | string| max:100',
            'Comentario'=>'required | string| max:100',
            'Foto'=>'required|max:10000|mimes:jpeg,png,jpg'
        ];
        $mensaje=[
            'required'=>'El :attribute es necesario que lo digite',
            'Foto.required'=>'La foto es necesaria'
        ];

        $this ->validate($request, $fields, $mensaje);


        //$datosComments = request()->all(); 
        $datosComments = request()->except('_token'); 

        if($request->hasFile('Foto')){
            $datosComments['Foto']=$request->file('Foto')->store('uploads','public');

        }

        Comentarios::insert($datosComments);
        //return response ()->json($datosComments);
        return redirect('comentarios')->with('mensaje','Registro agregado');
    
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Comentarios  $comentarios
     * @return \Illuminate\Http\Response
     */
    public function show(Comentarios $comentarios)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Comentarios  $comentarios
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $comentarios=Comentarios::findOrFail($id);
        return view('comentarios.edit', compact('comentarios'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Comentarios  $comentarios
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $fields=[
            'Nombre'=>'required | string| max:100',
            'Correo'=>'required |email',
            'Telefono'=>'required | string| max:100',
            'Comentario'=>'required | string| max:100',
            
        ];
        $mensaje=[
            'required'=>'El :attribute es necesario que lo digite',
            
        ];
        if($request->hasFile('Foto')){

          $fields=['Foto'=>'required|max:10000|mimes:jpeg,png,jpg'];
          $mensaje=['Foto.required'=>'La foto es necesaria'];
        }

        $this ->validate($request, $fields, $mensaje);


        //
        $datosComments = request()->except(['_token','_method']); 
        $comentarios=Comentarios::findOrFail($id);
        Storage::delete('public/'.$comentarios->Foto);
        if($request->hasFile('Foto')){


            $datosComments['Foto']=$request->file('Foto')->store('uploads','public');
        }

        Comentarios::where('id','=',$id)->update($datosComments);
        $comentarios=Comentarios::findOrFail($id);
        
        return redirect ('comentarios')->with('mensaje','Registro Actualizado');


        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Comentarios  $comentarios
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //

        $comentarios=Comentarios::findOrFail($id);

        if(Storage::delete('public/'.$comentarios->Foto)){
            Comentarios::destroy($id); 
        }

       
        return redirect ('comentarios')->with('mensaje','Registro eliminado');
    }
}
