<?php

namespace integradora\Http\Controllers;

use integradora\Models\Especialidad;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;


class EspecialidadController extends Controller
{

    public function index()
    {
    	$especialidades=Especialidad::all();

        return view('especialidad.index')->with('especialidades',Especialidad::all());//withTrashed()->get() en caso de querer mirar todos los registros

        return view('especialidad.index',compact('title','Especialidad)es'));
    }

    public function create()
    {
        return view('especialidad.new',compact('title','especialidad'));
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'nombre' => ['required','unique:Especialidades,nombre'],
        ]);

        /*if (empty($request['nombre']))
        {
            return redirect()->route('Especialidad.nueva')->withErrors([
                'nombre'=>'el campo nombre es obligatorio'
            ]);
        }*/

        Especialidad::create([
            'nombre'=>$request['nombre']
        ]);

        return redirect()->route('especialidades');
    }


    public function show(Request $request)
    {
        if ($request['buscar']==null) {
         return view('especialidad.index')->with('especialidades',Especialidad::all());
        }
        else{
        $especialidad=Especialidad::where('nombre','like',"%{$request['buscar']}%")->get();
        return view('especialidad.index')->with('especialidades',$especialidad);
        }
    }


   public function edit(Especialidad $especialidad)
    {

        return view('especialidad.edit',compact('title','especialidad'));
    }

    public function update(Request $request, Especialidad $especialidad)
    {
        $data = request()->all();//->validate(['nombre'=>'required',])
        //$data['password']=bcrypt($data['password']);

        $this->validate($request,[
            'nombre'=> ['required',Rule::unique('especialidades')->ignore($especialidad->id)],
        ]);

        //$Especialidad->nombre=$request

        $especialidad->update($data);/*save($data);*///->update($data);
        //return redirect()->route('especialidad.edit',['especialidad'=>$especialidad]);
        return redirect()->route('especialidades');
    }


    public function destroy(Especialidad $especialidad)
    {
        $especialidad->delete();

        return redirect()->route('especialidades');
    }

    public function editar(Especialidad $especialidad)
    {
        //$especialidad=Especialidad::findOrFail($id);

        //return response()->view('errors.404',[],404);

        return view('especialidad.edit',compact('title','especialidad'));
    }
    public function test()
    {
        $ee= Especialidad::all();

        return $ee()->json();
    }


}
