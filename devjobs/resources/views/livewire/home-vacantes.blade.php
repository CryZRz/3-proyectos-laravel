<div>

    <livewire:filtrar-vacantes>

    <div class="py-12">
        <div class="max-w-7xl mx-auto">
            <h3 class="font-extrabold text-4xl text-gray-700 mb-12">
                Nuestras vacantes disponibles
            </h3>
            <div class="bg-white shadow-sm rounded-lg p-6 divide-y divide-gray-600 ">
                @forelse ($vacantes as $vacante)
                    <div class="md:flex md:justify-between md:items-center py-5">
                        <div class="md:flex-1">
                            <a href="{{route("vacantes.show", $vacante)}}" class="text-3xl font-extrabold text-gray-600">
                                {{$vacante->titulo}}
                            </a>
                            <p class="text-base text-gray-600 mb-6">{{$vacante->empresa}}</p>
                            <p class="text-base text-gray-600 mb-6">{{$vacante->categoria->categoria}}</p>
                            <p class="text-base text-gray-600 mb-6">{{$vacante->salario->salario}}</p>
                            <p class="font-bold text-xs text-gray-600">Utimo dia para postularse
                                <span class="font-normal">{{$vacante->ultimo_dia}}</span>
                            </p>
                        </div>
                        <div class="md:mt-0 mt-5">
                            <a href="{{route("vacantes.show", $vacante)}}" class="bg-indigo-500 p-3 text-sm uppercase font-bold text-white rounded-lg block text-center">
                                Ver vacante
                            </a>
                        </div>
                    </div>
                @empty
                    <p class="p-3 text-center text-sm text-gray-600">No hay vacantes disponibles</p>
                @endforelse
            </div>
        </div>
    </div>
</div>
