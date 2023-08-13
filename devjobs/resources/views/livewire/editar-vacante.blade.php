<form class="md:w-1/2 space-y-5" wire:submit.prevent='editarVacante'>

    <div>
        <x-input-label for="titulo" :value="__('Titulo vacante')" />
        <x-text-input id="titulo" class="block mt-1 w-full" type="text" wire:model="titulo" :value="old('titulo')" placeholder="Titulo vancante" autocomplete="username" />
        
        @error("titulo")
            <livewire:mostrar-alerta :message="$message">
        @enderror
    </div>

    <div class="mt-4">
        <x-input-label for="salario" :value="__('Salario mensual')" />
        <select 
            wire:model="salario"
            id="salario"
            class="w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
        >
            <option>-- Seleccione --</option>
            @foreach ($salarios as $salario)
                <option value="{{$salario->id}}">{{$salario->salario}}</option>
            @endforeach
        </select>
        @error("salario")
            <livewire:mostrar-alerta :message="$message">
        @enderror
        
    </div>

    <div class="mt-4">
        <x-input-label for="categoria" :value="__('Categoria')" />
        <select 
            wire:model="categoria"
            id="categoria"
            class="w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
        >
            <option>-- Seleccione --</option>
            @foreach ($categorias as $categoria)
                <option value="{{$categoria->id}}">{{$categoria->categoria}}</option>
            @endforeach
        </select>
        @error("categoria")
            <livewire:mostrar-alerta :message="$message">
        @enderror
    </div>

    <div>
        <x-input-label for="empresa" :value="__('Titulo empresa')" />
        <x-text-input id="empresa" class="block mt-1 w-full" type="text" wire:model="empresa" :value="old('empresa')" placeholder="Titulo empresa" />
        @error("empresa")
            <livewire:mostrar-alerta :message="$message">
        @enderror
    </div>

    <div>
        <x-input-label for="utlimo_dia" :value="__('Ultimo dia para postularse')" />
        <x-text-input id="utlimo_dia" class="block mt-1 w-full" type="date" wire:model="utlimo_dia" :value="old('utlimo_dia')" />
        @error("utlimo_dia")
            <livewire:mostrar-alerta :message="$message">
        @enderror
    </div>

    <div>
        <x-input-label for="descripcion" :value="__('Descripcion puesto')" />
        <textarea
            wire:model="descripcion"
            placeholder="Descripcion general del puesto"
            class="w-full h-72 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
        ></textarea>
        @error("descripcion")
            <livewire:mostrar-alerta :message="$message">
        @enderror
    </div>
    <div class="my-5 w-80">
        <x-input-label for="iamgen" :value="__('Imagen nueva')" />
        <x-text-input id="iamgen" class="block mt-1 w-full" type="file" wire:model="imagenNueva" accept="image/*"/>
        
        <div class="my-5 w-80">
            @if ($imagenNueva)
                Imagen:
                <img src="{{$imagenNueva->temporaryUrl()}}"/>
            @endif
        </div>

        @error("imagenNueva")
            <livewire:mostrar-alerta :message="$message">
        @enderror
    </div>

    <div class="my-5 w-80">
        <x-input-label :value="__('Imagen actual')" />
        <img src="{{asset("storage/vacantes/".$imagen)}}" alt="Imagen vacante {{$titulo}}"/>
    </div>

    <x-primary-button class="w-full justify-center">
        Guardar cambios
    </x-primary-button>
</form>
