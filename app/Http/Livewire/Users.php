<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class Users extends Component
{
    use WithPagination;

    public $q;
    public $sortBy = 'id';
    public $sortAsc = true;
    public $user;

    public $confirmingUserDeletion = false;
    public $confirmingUserEdit = false;

    protected $queryString = [
        'q'=>['except'=> ''],
        'sortBy'=>'id',
        'sortAsc'=>true,
    ];

    protected $rules = [
        'user.name' => 'required|string|min:4',
        'user.email' => 'required|email',
        'user.coin' => 'required|numeric|between:0,1000000',
    ];

    public function render()
    {
        $users =  DB::table('users')
            ->when($this->q, function($query) {
                return $query->where(function($query){
                    $query->where('name', 'like', '%' . $this->q . '%')
                        ->orWhere('email', 'like', '%' . $this->q . '%')
                        ->orWhere('id', 'like', '%' . $this->q . '%');
                });
        })->orderBy($this->sortBy, $this->sortAsc?'ASC' : 'DESC');

        $users = $users->paginate(10);

        return view('livewire.users', [
            'users' => $users,

        ]);
    }

    public function updatingActive() {
        $this->resetPage();
    }

    public function sortBy($field)
    {
        if($this->sortBy == $field) return $this->sortAsc = !$this->sortAsc;
        return $this->sortBy = $field;
    }

    public function confirmUserDeletion($id){
        $this->confirmingUserDeletion = $id;
    }

    public function deleteUser(User $user){
        $user->delete();
        session()->flash('message', 'User delete successfully');
        $this->confirmingUserDeletion = false;
    }

    public function confirmUserEdit(User $user){
        $this->user = $user;
        $this->confirmingUserEdit = true;
    }

    public function saveUser(){
        $this->validate();
        $this->user->save();
        session()->flash('message', 'User saved successfully');
        $this->confirmingUserEdit = false;
    }


}