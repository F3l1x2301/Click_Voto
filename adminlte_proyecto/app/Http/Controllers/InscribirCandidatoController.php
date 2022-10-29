<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Estudiante;
use App\Models\Curso;
use App\Models\Candidato;
use App\Models\Cargo;

class InscribirCandidatoController extends Controller
{
    
    //Mostrar vista
    public function view_inscribirCandidato($id){
       // $estudiante = Estudiante::FindOrFail($id);
        $estudiante = new Estudiantes;
        $info = $estudiante->estudiante($id);

        $grado = new GradoController;
        $numero_grado = $grado->gradoById($id);
        
        $curso = new Cursos;
        $curso_estudiante = $curso->curso_estudiante($id);
        
        $cargo = new CargoController;
        //$cargo_estudiante = $cargo->todos_cargos();

        $can = Candidato::select(['estudiante_id'])->where('estudiante_id', $id)->get();
        
        if($can != '[]'){
            
            return redirect()->route('estudiante')->with('candidato', 'El candidato ya existe, seleccione otro');

        }else{

            if($numero_grado != "11" and $numero_grado != "10"){
                $cargo_estudiante_representante = $cargo->cargo_estudiante(1);
              // return $cargo_estudiante->id;
               return view('inscribirCandidatos', compact('info', 'cargo_estudiante_representante'));
            }else{
                if($numero_grado == "11"){
                    $cargo_estudiante_representante1 = $cargo->cargo_estudiante(1);
                    $cargo_estudiante_representante2 = $cargo->cargo_estudiante(2);
                    //return $cargo_estudiante_representante2->id;
                    
                }else{
                    $cargo_estudiante_representante1 = $cargo->cargo_estudiante(1);
                    $cargo_estudiante_representante2 = $cargo->cargo_estudiante(3);
                    //return view('inscribirCandidatos', compact('info', 'cargo_estudiante_representante1', 'cargo_estudiante_representante2'));
                }
                return view('inscribirCandidatos', compact('info', 'cargo_estudiante_representante1', 'cargo_estudiante_representante2'));
            }

        }
          
    }

    public function inscribirCandidatoEstudiante(Request $request){
        //Asignar tarjeton
        $estudiante = new Estudiantes;
        $id = $request->input('id');
        $est = $estudiante->estudiante($request->input('id'));
        $cargo = $request->get('cargo');
        $numero_grado = $est->cursos->grados->numero_grado;

        $tarjeton = new TarjetonController;
        $tarjeton_id = $tarjeton->asignar_tarjeton($numero_grado, $cargo);
        $this->guardar_candidato($id, $cargo, $tarjeton_id);
        return "Exitooooooo";
    }

    public function guardar_candidato($id, $cargo, $tarjeton_id){
        //Guardar candidato
       $candidato = new Candidato;
       $candidato->estudiante_id = $id;
       $candidato->cargo_id = $cargo;
       $candidato->tarjeton_id = $tarjeton_id;
       $candidato->save();

       //Colocarle los atributos de tiempo en la migracion de los candidatos
    }
}
