<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class Products extends Component
{

    public Product $form;
    public $openModalCreate = false;
    public ?Product $productToRemove = null;
    public $openModalDelete = false;

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
        $this->form->save();
        $this->openModalCreate = false;
        session()->flash('message', 'Successfully!');
    }

    public function edit(Product $product)
    {
        $this->form = $product;
        $this->openModalCreate = true;
        $this->clearValidation();
    }

    public function confirmingProductDeletion(Product $product)
    {
        $this->productToRemove = $product;
        $this->openModalDelete = true;

    }

    public function remove()
    {
        $this->productToRemove->delete();
        $this->openModalDelete = false;
        session()->flash('message', 'Successfully!');
    }

    public function render()
    {
        return view('livewire.products');
    }
}
