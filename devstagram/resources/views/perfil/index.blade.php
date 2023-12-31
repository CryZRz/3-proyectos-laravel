@extends("layouts.app")

@section("titulo")
    Editar perfil: {{auth()->user()->username}}
@endsection

@section("contenido")
    <div class="md:flex md:justify-center">
        <div class="md:w-1/2 bg-white shadow p-10">
        <form class="mt-10 md:mt-0" acction="{{route("perfil.store")}}" enctype="multipart/form-data" method="POST">
            @csrf
            <div class="mb-5">
                <label for="username" class="mb-2 block uppercase text-gray-500 font-bold">
                    Username
                </label>
                <input
                    id="username"
                    name="username"
                    type="text"
                    placeholder="Repite tu password"
                    class="border p-3 w-full rounded-lg"
                    value="{{auth()->user()->username}}"
                />
                @error("username")
                    <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                        {{$message}}
                    </p>
                @enderror
            </div>
            <div class="mb-5">
                <label for="imagen" class="mb-2 block uppercase text-gray-500 font-bold">
                    Imagen perfil
                </label>
                <input
                    id="imagen"
                    name="imagen"
                    type="file"
                    class="border p-3 w-full rounded-lg"
                    accept=".jpg, .png, .jpeg, .gif"
                />
            </div>
            <input
                type="submit"
                value="Actualizar perfil"
                class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer 
                uppercase font-bold p-3 w-full text-white rounded-lg"
            />
        </form>
        </div>
    </div>
@endsection