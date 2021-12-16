<div>
{{-- cambiamos la variable a true con metodo magico --}}
 <x-jet-secondary-button wire:click="$set('open', true)">
        Crear nuevo post
    </x-jet-secondary-button>

    <x-jet-dialog-modal wire:model="open">
        <x-slot name="title">
            Crear nuevo post
        </x-slot>

        <x-slot name="content">
            <div class="mb-4">
                <x-jet-label value="Titulo" />
                <x-jet-input class="w-full" type="text" wire:model="title"/>
                <x-jet-input-error for="title" class="mt-3" />
            </div>
            <div class="mb-4">
                <x-jet-label value="Content" />
                <x-jet-input class="w-full" type="text" wire:model="content" />
                <x-jet-input-error for="title" class="mt-3" />
            </div>
        </x-slot>

        <x-slot name="footer">
           <x-jet-secondary-button wire:click="$set('open', false)">
               Cancelar
           </x-jet-secondary-button> 

           <x-jet-secondary-button wire:click="save" wire:loading.attr="disabled" wire:target="save" class="disabled:opacity-25">
               Crear post
           </x-jet-secondary-button>
           
        </x-slot>

    </x-jet-dialog-modal>
</div> 
<!-- Button trigger modal -->

