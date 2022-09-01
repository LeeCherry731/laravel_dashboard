<?php

namespace App\Http\Livewire;

use App\Models\Item;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class Items extends Component
{
    use WithPagination;

    public $q;
    public $sortBy = 'id';
    public $sortAsc = true;
    public $item;

    public $confirmingItemDeletion = false;
    public $confirmingItemAdd = false;

    public $isEdit = false;



    protected $rules = [
        'item.name' => 'required|string|min:2',
        'item.coin' => 'required|numeric|between:0,1000000',
        'item.price' => 'required|numeric|between:0,1000000',
    ];

    protected $queryString = [
        'q'=>['except'=> ''],
        'sortBy'=>'id',
        'sortAsc'=>true,
    ];

    public function render()
    {
        $items =  DB::table('items')
            ->when($this->q, function($query) {
                return $query->where(function($query){
                    $query->where('name', 'like', '%' . $this->q . '%')
                        ->orWhere('email', 'like', '%' . $this->q . '%')
                        ->orWhere('id', 'like', '%' . $this->q . '%');
                });
        })->orderBy($this->sortBy, $this->sortAsc?'ASC' : 'DESC');

        $items = $items->paginate(10);
        return view('livewire.items', ['items' => $items]);
    }

        public function updatingActive() {
        $this->resetPage();
    }

    public function sortBy($field)
    {
        if($this->sortBy == $field) return $this->sortAsc = !$this->sortAsc;
        return $this->sortBy = $field;
    }


    public function confirmItemDeletion($id){

        $this->confirmingItemDeletion = $id;
    }

    public function deleteItem(Item $item){
        $item->delete();
        session()->flash('message', 'Item delete successfully');
        $this->confirmingItemDeletion = false;
    }

    public function comfirmItemAdd() {
        $this->isEdit = false;
        $this->reset(['item']);
        $this->confirmingItemAdd = true;
    }

    public function confirmItemEdit(Item $item){
        $this->isEdit = true;
        $this->item = $item;
        $this->confirmingItemAdd = true;
    }

    public function saveItem(){

        $this->validate();
        if($this->isEdit == true){
            $this->edit();
        } else {
            $this->add();
        }
        $this->confirmingItemAdd = false;
    }

    public function add() {
        $item = new Item();
        $item->name = $this->item['name'];
        $item->coin = $this->item['coin'];
        $item->price = $this->item['price'];
        $item->save();
        session()->flash('message', 'Item added successfully');
    }

    public function edit() {
        $this->item->save();
        session()->flash('message', 'Item Edited successfully');
    }
}
