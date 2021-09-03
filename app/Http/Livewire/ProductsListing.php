<?php

namespace App\Http\Livewire;

use App\Models\Website\Products;
use Illuminate\Support\Facades\Http;
use Livewire\Component;

class ProductsListing extends Component
{

    public $products;

    public function mount()
    {

        $this->fill([
            'products' => $this->getProducts()
        ]);

    }


    public function getProducts()
    {
        return Products::all();
    }


    public function render()
    {
        return view('livewire.products-listing');
    }
}
