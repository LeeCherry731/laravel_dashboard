{{-- <div class="p-6 sm:px-20 bg-white border-b border-gray-200"> --}}
<div class="p-6 sm:px-20 ">

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

    <div class="mt-8 text-2xl">
        Users
    </div>

    <div class="mt-6">
        <div class="flex justify-between">

            <div class="p-2">
                <input type="search" wire:model.debounce.800ms="q" name="" placeholder="search" class="shadow appearance border rounded w-full py-2 px-3 text-slate-600 leading-tight focus:outline-none focus:drop-shadow-xl">
            </div>
        </div>
        <table class="table-auto w-full">
            <thead>
                <tr>
                    <th class="px-4 py-2">
                        <div class="flex items-center">
                            <button wire:click="sortBy('id')">
                            ID
                            <x-sort-icon sortField="id" :sort-by="$sortBy" :sort-asc="$sortAsc"/>
                            </button>


                        </div>
                    </th>
                    <th class="px-4 py-2">
                        <div class="flex items-center">
                            <button wire:click="sortBy('name')">
                            Name

                            <x-sort-icon sortField="name" :sort-by="$sortBy" :sort-asc="$sortAsc"/>
                            </button></div>
                    </th>
                    <th class="px-4 py-2">
                        <div class="flex items-center">
                            <button wire:click="sortBy('email')">
                            Email

                                <x-sort-icon sortField="email" :sort-by="$sortBy" :sort-asc="$sortAsc"/>
                            </button></div>
                    </th>
                    <th class="px-4 py-2">
                        <div class="flex items-center">Role</div>
                    </th>
                    <th class="px-4 py-2">
                        <div class="flex items-center">
                            <button wire:click="sortBy('coin')">
                            Coin

                                <x-sort-icon sortField="coin" :sort-by="$sortBy" :sort-asc="$sortAsc"/>
                            </button></div>
                    </th>
                    <th class="px-4 py-2">
                        Actions
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr>
                    <td class="border px-4 py-2">{{$user->id}}</td>
                    <td class="border px-4 py-2">{{$user->name}}</td>
                    <td class="border px-4 py-2">{{$user->email}}</td>
                    <td class="border px-4 py-2">{{$user->role == 0? 'admin' : 'user'}}</td>
                    <td class="border px-4 py-2">{{$user->coin}}</td>
                    <td class="border px-4 py-2">

                        <x-jet-button class="bg-sky-600 hover:bg-sky-400" wire:click="confirmUserEdit({{$user->id}})"  wire:loading.attr="disabled">
                        Edit
                         </x-jet-button>
                        <x-jet-danger-button wire:click="confirmUserDeletion({{$user->id}})" wire:loading.attr="disabled">
                        Delete
                         </x-jet-danger-button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{$users->links()}}
    </div>

        <x-jet-dialog-modal wire:model="confirmingUserDeletion">
            <x-slot name="title">
                {{ __('Delete Account') }}
            </x-slot>

            <x-slot name="content">
                {{ __('Are you sure you want to delete this account?') }}
            </x-slot>

            <x-slot name="footer">
                <x-jet-secondary-button wire:click="$set('confirmingUserDeletion',false)" wire:loading.attr="disabled">
                    {{ __('Cancel') }}
                </x-jet-secondary-button>

                <x-jet-danger-button class="ml-3" wire:click="deleteUser({{ $confirmingUserDeletion}})" wire:loading.attr="disabled">
                    {{ __('Delete Account') }}
                </x-jet-danger-button>
            </x-slot>
        </x-jet-dialog-modal>


        <x-jet-dialog-modal wire:model="confirmingUserEdit">
            <x-slot name="title">
                {{ __('Edit Account') }}
            </x-slot>

            <x-slot name="content">
                {{ __('Edit User') }}
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label for="name" value="{{ __('Name') }}" />
                <x-jet-input id="name" type="text" class="mt-1 block w-full" wire:model.defer="user.name" autocomplete="name" />
            <x-jet-input-error for="user.name" class="mt-2" />
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label for="email" value="{{ __('Email') }}" />
                <x-jet-input id="email" type="text" class="mt-1 block w-full" wire:model.defer="user.email" autocomplete="email" />
            <x-jet-input-error for="user.email" class="mt-2" />
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label for="coin" value="{{ __('Coin') }}" />
                <x-jet-input id="coin" type="text" class="mt-1 block w-full" wire:model.defer="user.coin" autocomplete="coin" />
            <x-jet-input-error for="user.coin" class="mt-2" />
        </div>
            </x-slot>

            <x-slot name="footer">
                <x-jet-secondary-button wire:click="$set('confirmingUserEdit',false)" wire:loading.attr="disabled">
                    {{ __('Cancel') }}
                </x-jet-secondary-button>

                <x-jet-danger-button class="ml-3" wire:click="saveUser({{ $confirmingUserDeletion}})" wire:loading.attr="disabled">
                    {{ __('Save') }}
                </x-jet-danger-button>
            </x-slot>
        </x-jet-dialog-modal>
</div>
