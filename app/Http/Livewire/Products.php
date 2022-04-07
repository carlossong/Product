<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class Products extends Component
{

    public $form;
    public $openModalCreate = false;
    public $rules = [
        'form.name' => 'required',
        'form.description' => 'required',
        'form.price' => 'required|integer|min:0',
    ];

    use WithPagination;

    public function getProductsProperty()
    {
        return Product::latest()->paginate(10);
    }

    public function newProduct()
    {
        $this->form = new Product();
        $this->openModalCreate = true;
        $this->clearValidation();
    }

    public function save()
    {
        $this->validate();
    }

    public function render()
    {
        return view('livewire.products');
    }
}
