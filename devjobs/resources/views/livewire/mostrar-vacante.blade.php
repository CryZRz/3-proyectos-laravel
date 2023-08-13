<div class="p-10">
    <div class="mb-5">
        <h3 class="font-bold text-3xl text-gray-800 my-3">
            {{$vacante->titulo}}
        </h3>
            @if (session()->has("mensaje"))
                <div class="uppercase border border-green-600 bg-green-100 text-green-600 p-2 font-bold my-3">
                    {{session("mensaje")}}
                </div>
            @endif
        <div class="md:grid md:grid-cols-2 bg-gray-50 p-4 my-10">
            <p class="font-bold text-sm uppercase text-gray-800 my-3">Empresa:
                <span class="normal-case font-normal">{{$vacante->empresa}}</span>
            </p>
            <p class="font-bold text-sm uppercase text-gray-800 my-3">Utimo dia de postulo:
                <span class="normal-case font-normal">{{$vacante->ultimo_dia}}</span>
            </p>
            <p class="font-bold text-sm uppercase text-gray-800 my-3">Categoria:
                <span class="normal-case font-normal">{{$vacante->categoria->categoria}}</span>
            </p>
            <p class="font-bold text-sm uppercase text-gray-800 my-3">Salario:
                <span class="normal-case font-normal">{{$vacante->salario->salario}}</span>
            </p>
        </div>
    </div>

    <div class="md:grid md:grid-cols-6 gap-4">
        <div class="md:col-span-2">
            <img src="{{asset("storage/vacantes/".$vacante->imagen)}}" alt="imagen vacante {{$vacante->titulo}}">
        </div>
        <div class="md:col-span-4">
            <h2 class="text-2xl font-bold mb-5">
                Descripcion del puesto
            </h2>
            <p>{{$vacante->descripcion}}</p>
        </div>
    </div>
    @guest
        <div class="mt-5 bg-gray-50 border border-dashed p-5 text-center rounded">
            <p>Deseas aplicar?
                <a class="font-bold text-indigo-600" href="{{route("register")}}">Obten una cuenta y aplica a esta y otras vacantes</a>
            </p>
        </div>
    @endguest

    @cannot("create", App\Models\Vacante::class)
        <livewire:postular-vacante :vacante="$vacante">
    @endcannot

</div>
