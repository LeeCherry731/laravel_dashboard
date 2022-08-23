<div class="p-6 sm:px-20 bg-white border-b border-gray-200">


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
                    <td class="border px-4 py-2">Edit Delete</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{$users->links()}}
    </div>

</div>
