<?php

namespace App\Http\Livewire;

use App\Models\Product as ModelsProduct;
use Livewire\Component;
use Livewire\WithPagination;

class Product extends Component
{
    use WithPagination;

    public function getProductsProperty()
    {
        return ModelsProduct::latest()->paginate();
    }

    public function render()
    {
        return view('livewire.product');
    }
}
