<div class="bg-gray-100 p-5 mt-10 flex justify-center flex-col items-center">
    <h3 class="text-center text-2xl font-bold my-4">
        Postularme a esta vacante
    </h3>
    @if (session()->has("mensaje"))
        <div class="uppercase border border-green-600 bg-green-100 text-green-600 p-2 font-bold my-3">
            {{session("mensaje")}}
        </div>
    @endif
    <form action="" class="w-96 mt-5" wire:submit.prevent="postularme">
        
        <div class="mb-4">
            <x-input-label for="cv" :value="__('Curriculum')" />
            <x-text-input id="cv" class="block mt-1 w-full" type="file" wire:model="cv" accept=".pdf"/>
        </div>
        @error("cv")
            <livewire:mostrar-alerta :message="$message">
        @enderror
        <x-primary-button class="w-full justify-center my-5">
            Postularme
        </x-primary-button>
    </form>
</div>
