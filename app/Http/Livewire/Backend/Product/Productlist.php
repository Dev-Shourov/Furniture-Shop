<?php

namespace App\Http\Livewire\Backend\Product;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Backend\Product;
use Illuminate\Support\Str;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Validator;
use File;

class Productlist extends Component
{
    public $showUpdateModal = false;
    public $prodData        = [];

    public function render()
    {
        $products = Product::latest()->paginate();
        return view('livewire.backend.product.productlist', compact('products'));
    }

    public function addProduct(){
        $this->showUpdateModal = false;
        $this->dispatchBrowserEvent('show-form');
        $this->dispatchBrowserEvent('img_required');
    }

    public function editProduct(Product $tag){
        $this->showUpdateModal  = true;
        $this->prodData         = $product->toArray();
        $this->dispatchBrowserEvent('show-form');
    }

    public function confirmDel(Product $product){
        $this->prodData         = $product->toArray();
        $this->dispatchBrowserEvent('show-confirm');
    }
    
    public function createProduct(){
        $product               = new Product;
        $product->prod_name     = $this->prodData['prod_name'];
        $product->prod_str      = Str::slug($this->prodData['prod_name']);
        $product->save();
        // browser events
        $this->browserEvents();
        // toastr alert
        $this->dispatchBrowserEvent('alert',[
            'type' => 'success',  
            'message' => 'Product Created Successfully!'
        ]);

        return redirect()->back();
    }

    public function updateProduct(){
        $product               = Product::find($this->prodData['id']);
        $product->prod_name     = $this->prodData['prod_name'];
        $product->prod_str      = Str::slug($this->prodData['prod_name']);
        $product->save();
        // browser events
        $this->browserEvents();
        // toastr alert
        $this->dispatchBrowserEvent('alert',[
            'type' => 'success',  
            'message' => 'Tag Created Successfully!'
        ]);
        
        return redirect()->back();
    }

    public function deleteProduct(){
        $product   = Product::find($this->prodData['id']);
        $product->delete();
        $this->dispatchBrowserEvent('hide-confirm');
        $this->dispatchBrowserEvent('alert',[
            'type' => 'success',  
            'message' => 'Tag Deleted Successfully!'
        ]);

        return redirect()->back();
    }

    public function browserEvents(){
        $this->reset();
        $this->dispatchBrowserEvent('hide-form');
        
    }

    public function closeModal(){
        $this->reset();
    }
}
