<?php

namespace App\Http\Livewire;

use App\Models\Categoria;
use App\Models\Salario;
use App\Models\Vacante;
use Illuminate\Support\Carbon;
use Livewire\Component;
use Livewire\WithFileUploads;

class EditarVacante extends Component
{
    public $vacante_id;
    public $titulo;
    public $salario;
    public $categoria;
    public $empresa;
    public $utlimo_dia;
    public $descripcion;
    public $imagen;
    public $imagenNueva;

    use WithFileUploads;

    protected $rules = [
        "titulo" => "required|string",
        "salario" => "required",
        "categoria" => "required",
        "utlimo_dia" => "required",
        "empresa" => "required",
        "descripcion" => "required",
        "imagenNueva" => "nullable|image|max:1024",
    ];

    public function mount(Vacante $vacante){

        $this->vacante_id = $vacante->id;//no sirve

        $this->titulo = $vacante->titulo;
        $this->salario = $vacante->salario_id;
        $this->categoria = $vacante->categoria_id;
        $this->empresa = $vacante->empresa;
        $this->utlimo_dia = Carbon::parse($vacante->utlimo_dia)->format("Y-m-d");
        $this->descripcion = $vacante->descripcion;
        $this->imagen = $vacante->imagen;
    }

    public function editarVacante(){
        $datos = $this->validate();

        //si hay una nueva imagen
        if($this->imagenNueva){
            $imagen = $this->imagenNueva->store("public/vacantes");
            $datos["imagen"] = str_replace("public/vacantes/", "", $imagen);
        }

        //encontrar vacante a editar
        $vacante = Vacante::find($this->vacante_id);

        //asignar los valores
        $vacante->titulo = $datos["titulo"];
        $vacante->salario_id = $datos["salario"];
        $vacante->categoria_id = $datos["categoria"];
        $vacante->empresa = $datos["empresa"];
        $vacante->ultimo_dia = $datos["utlimo_dia"];
        $vacante->descripcion = $datos["descripcion"];
        $vacante->imagen = $datos["imagen"] ?? $vacante->imagen;

        //guardar vcante
        $vacante->save();
        
        //redireccionar
        session()->flash("mensaje", "la vcante se actulizo correctamente");
        
        return redirect()->route("vacantes.index");
    }

    public function render()
    {
        //consultar db
        $salarios = Salario::all();
        $categorias = Categoria::all();

        return view('livewire.editar-vacante', 
            [
                "salarios" => $salarios,
                "categorias" => $categorias
        ]);
    }
}
