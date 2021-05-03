<div class="flex items-center justify-between mb-5">
    <div class="text-black bg-white flex items-center justify-center">
      <div class="border rounded overflow-hidden flex">
        <button class="flex items-center justify-center px-4 border-l">
          <x-simbolos class="text-sm text-gray-500" nombre="search" />
        </button>
        <input type="search" wire:model="search" class="px-4 py-1 border-none focus:border-transparent" placeholder="Buscar...">
      </div>
    </div>
    <div class="">
        <x-button class="bg-indigo-600" wire:click="create()">
            <x-simbolos nombre="plus-circle" />
        </x-button>
    </div>
</div>