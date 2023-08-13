<?php

namespace App\Http\Livewire;

use App\Models\Vacante;
use App\Notifications\NuevoCandidato;
use Livewire\Component;
use Livewire\WithFileUploads;

class PostularVacante extends Component
{
    use WithFileUploads;
    public $cv;
    public $vacante;

    protected $rules = [
        "cv" => "required|mimes:pdf"    
    ];

    public function mount(Vacante $vacante){
        $this->vacante = $vacante;
    }

    public function postularme(){
        $this->validate();

        //guardar dv en disco
        $cv = $this->cv->store("public/cv");
        $datos["cv"] = str_replace("public/cv/", "", $cv);


        //crear la candidato a la vacante
        $this->vacante->candidatos()->create([
            "user_id" => auth()->user()->id,
            "cv" => $datos["cv"]
        ]);

        //crear notificacion y enviar el email
        $this->vacante->reclutador->notify(new NuevoCandidato($this->vacante->id, $this->vacante->titulo, auth()->user()->id));

        //mostrar usuario emnsaje de ok
        session()->flash("mensaje", "Se envio correctamente tu informacion mucha suerte");
        
        return redirect()->back();
    }

    public function render()
    {
        return view('livewire.postular-vacante');
    }
}
