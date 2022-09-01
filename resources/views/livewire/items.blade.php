

<div class="p-6 sm:px-20 bg-white border-b border-gray-200">

    <div class="mt-6 w-full">
        ldd
    </div>


        @if (session()->has('message'))

        <div class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md" role="alert">
        <div class="flex">
            <div class="py-1"><svg class="fill-current h-6 w-6 text-teal-500 mr-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z"/></svg></div>
            <div>
            <p class="font-bold">{{session('message')}}</p>
            <p class="text-sm">Make sure you know how these changes affect you.</p>
            </div>
        </div>
        </div>
    @endif

    <div class="mt-8 text-2xl flex justify-between">
        <div>Items</div>
        <div class="mr-2">
            <x-jet-button class="bg-cyan-600 hover:bg-sky-500" wire:click="comfirmItemAdd"  wire:loading.attr="disabled">
            Add Item
                </x-jet-button>
        </div>
    </div>

    <div class="mt-6">
        <table class="table-auto w-full">
            <thead>
                <tr>
                    <th class="px-4 py-2">
                        <div class="flex items-center">ID</div>
                    </th>
                    <th class="px-4 py-2">
                        <div class="flex items-center">Name</div>
                    </th>
                    <th class="px-4 py-2">
                        <div class="flex items-center">Coin</div>
                    </th>
                    <th class="px-4 py-2">
                        <div class="flex items-center">Price</div>
                    </th>
                    <th class="px-4 py-2">
                        Actions
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach($items as $item)
                <tr>
                    <td class="border px-4 py-2">{{$item->id}}</td>
                    <td class="border px-4 py-2">{{$item->name}}</td>
                    <td class="border px-4 py-2">{{number_format($item->coin, 2)}}</td>
                    <td class="border px-4 py-2">{{number_format($item->price, 2)}}</td>
                    <td class="border px-4 py-2">
                        <x-jet-button class="bg-sky-600 hover:bg-sky-400" wire:click="confirmItemEdit({{$item->id}})"  wire:loading.attr="disabled">
                        Edit
                         </x-jet-button>
                        <x-jet-danger-button wire:click="confirmItemDeletion({{$item->id}})" wire:loading.attr="disabled">
                        Delete
                         </x-jet-danger-button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{$items->links()}}
    </div>

     <x-jet-dialog-modal wire:model="confirmingItemDeletion">
            <x-slot name="title">
                {{ __('Delete Item') }}
            </x-slot>

            <x-slot name="content">
                {{ __('Are you sure you want to delete this Item?') }}
            </x-slot>

            <x-slot name="footer">
                <x-jet-secondary-button wire:click="$set('confirmingItemDeletion',false)" wire:loading.attr="disabled">
                    {{ __('Cancel') }}
                </x-jet-secondary-button>

                <x-jet-danger-button class="ml-3" wire:click="deleteItem({{$confirmingItemDeletion}})" wire:loading.attr="disabled">
                    {{ __('Delete Item') }}
                </x-jet-danger-button>
            </x-slot>
        </x-jet-dialog-modal>


        <x-jet-dialog-modal wire:model="confirmingItemAdd">
            <x-slot name="title">
                {{$this->isEdit? 'Edit Item' : 'Add Item'}}
            </x-slot>

            <x-slot name="content">
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label for="name" value="{{ __('Name') }}" />
                <x-jet-input id="name" type="text" class="mt-1 block w-full" wire:model.defer="item.name" autocomplete="name" />
            <x-jet-input-error for="item.name" class="mt-2" />

            <div class="col-span-6 sm:col-span-4">
                <x-jet-label for="coin" value="{{ __('Coin') }}" />
                <x-jet-input id="coin" type="text" class="mt-1 block w-full" wire:model.defer="item.coin" autocomplete="coin" />
            <x-jet-input-error for="item.coin" class="mt-2" />

            <div class="col-span-6 sm:col-span-4">
                <x-jet-label for="price" value="{{ __('Price') }}" />
                <x-jet-input id="price" type="text" class="mt-1 block w-full" wire:model.defer="item.price" autocomplete="price" />
            <x-jet-input-error for="item.price" class="mt-2" />
        </div>
            </x-slot>

            <x-slot name="footer">
                <x-jet-secondary-button wire:click="$set('confirmingItemAdd',false)" wire:loading.attr="disabled">
                    {{ __('Cancel') }}
                </x-jet-secondary-button>

                <x-jet-danger-button class="ml-3" wire:click="saveItem()" wire:loading.attr="disabled">
                    {{ __('Save') }}
                </x-jet-danger-button>
            </x-slot>
        </x-jet-dialog-modal>


</div>
