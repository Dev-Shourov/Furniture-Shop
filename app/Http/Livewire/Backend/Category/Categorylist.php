<?php

namespace App\Http\Livewire\Backend\Category;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Backend\Category;
use Illuminate\Support\Str;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Validator;
use File;

class Categorylist extends Component
{
    use WithFileUploads;

    public $showUpdateModal = false;
    public $catData         = [];

    public function render(){
        $categories = Category::latest()->paginate();
        return view('livewire.backend.category.categorylist', compact('categories'));
    }

    public function addCat(){
        $this->showUpdateModal = false;
        $this->dispatchBrowserEvent('show-form');
        $this->dispatchBrowserEvent('img_required');
    }

    public function editCat(Category $category){
        $this->showUpdateModal  = true;
        $this->catData          = $category->toArray();
        $this->dispatchBrowserEvent('show-form');
    }

    public function confirmDel(Category $category){
        $this->catData          = $category->toArray();
        $this->dispatchBrowserEvent('show-confirm');
    }
    
    public function createCat(){
        $category               = new Category;
        $category->cat_name     = $this->catData['cat_name'];
        $category->cat_str      = Str::slug($this->catData['cat_name']);
        // image handle
        if (!empty($this->catData['cat_image'])) {
            $img_name = time() . '_' . $this->catData['cat_image']->getClientOriginalName();
            $this->catData['cat_image']->storeAs('category', $img_name, 'myUpload');

            $category->cat_image    = $img_name;
        }
        $category->save();
        // browser events
        $this->browserEvents();
        // toastr alert
        $this->dispatchBrowserEvent('alert',[
            'type' => 'success',  
            'message' => 'Category Created Successfully!'
        ]);
        return redirect()->back();
    }

    public function updateCat(){
        $category               = Category::find($this->catData['id']);
        $category->cat_name     = $this->catData['cat_name'];
        $category->cat_str      = Str::slug($this->catData['cat_name']);
        // image handle
        if (!empty($this->catData['cat_image'])) {
            // delete old image
            if(File::exists(storage_path('app/backend/category/'. $category->cat_image))){
                File::delete(storage_path('app/backend/category/'. $category->cat_image));
            }
            $img_name = time() . '_' . $this->catData['cat_image']->getClientOriginalName();
            $this->catData['cat_image']->storeAs('category', $img_name, 'myUpload');

            $category->cat_image    = $img_name;
        }
        $category->save();
        // browser events
        $this->browserEvents();
        // toastr alert
        $this->dispatchBrowserEvent('alert',[
            'type' => 'success',  
            'message' => 'Category Updated Successfully!'
        ]);
        
        return redirect()->back();
    }

    public function deleteCat(){
        $category   = Category::find($this->catData['id']);
        if (!empty($category->cat_image)) {
            // delete image from folder
            if(File::exists(storage_path('app/backend/category/'. $category->cat_image))){
                File::delete(storage_path('app/backend/category/'. $category->cat_image));
            }
        }
        $category->delete();
        $this->dispatchBrowserEvent('hide-confirm');
        $this->dispatchBrowserEvent('alert',[
            'type' => 'success',  
            'message' => 'Category Deleted Successfully!'
        ]);

        return redirect()->back();
    }

    public function browserEvents(){
        $this->reset();
        $this->dispatchBrowserEvent('hide-form');
        $this->dispatchBrowserEvent('pondReset');
        
    }

    public function closeModal(){
        $this->reset();
        $this->dispatchBrowserEvent('pondReset');
    }

}
