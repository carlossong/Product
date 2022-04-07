<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class Users extends Component
{
    use WithPagination;

    public function getProductsProperty()
    {
        return User::latest()->paginate();
    }

    public function render()
    {
        return view('livewire.users');
    }
}
