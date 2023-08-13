<div>
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

        @forelse ($vacantes as $vacante)
            <div class="p-6 bg-white border-b border-gray-200 md:flex md:justify-between md:items-center md:mt-0 mt-5">
                <div class="leading-10">
                    <a href="{{route("vacantes.show", $vacante)}}" class="text-xl font-bold">
                        {{$vacante->titulo}}
                    </a>
                    <p class="text-sm text-gray-600 font-bold">{{$vacante->empresa}}</p>
                    <p class="text-sm text-gray-500">Utimo dia: {{$vacante->ultimo_dia}}</p>
                </div>
                <div class="flex gap-3 md:items-center flex-col items-stretch md:flex-row md:mt-0 mt-4">
                    <a href="{{route("candidatos.index", $vacante)}}" class="bg-slate-800 py-2 px-4 text-white text-xs font-bold rounded-lg uppercase text-center">
                        Cantidatos: {{$vacante->candidatos->count()}}
                    </a>
                    <a href="{{route("vacantes.edit", $vacante->id)}}" class="bg-blue-800 py-2 px-4 text-white text-xs font-bold rounded-lg uppercase text-center">
                        Editar
                    </a>
                    <button wire:click="$emit('mostrarAlerta', {{ $vacante->id }})" class="bg-red-600 py-2 px-4 text-white text-xs font-bold rounded-lg uppercase text-center">
                        Eliminar
                    </button>
                </div>
            </div>
        @empty
            <a class="text-sm text-gray-600 p-3 text-center">No hay vacantes</a>
        @endforelse
        </div>
        <div class="flex jusrigy-center mt-10">
            {{$vacantes->links()}}
        </div>
        </div>
@push("scripts")
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>

        Livewire.on("mostrarAlerta", (vacanteId) => {
            Swal.fire({
            title: 'Eliminar vacante?',
            text: "Una vacante eliminada no se puede recuperar!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, eliminar!'
            }).then((result) => {

                Livewire.emit("eliminarVacante", vacanteId)

              if (result.isConfirmed) {
                Swal.fire(
                  'Se elmino la vacante!',
                  'Eliminado correctamente',
                  'Ok'
                )
              }
            })
        })

        
    </script>
@endpush
