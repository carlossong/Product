<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class Products extends Component
{

    public $openModalCreate = true;

    use WithPagination;

    public function getProductsProperty()
    {
        return Product::latest()->paginate(10);
    }

    public function render()
    {
        return view('livewire.products');
    }
}
