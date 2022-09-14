<?php

namespace App\Http\Livewire\Backend\Tag;

use Livewire\Component;
use App\Models\Backend\Tag;
use Illuminate\Support\Str;
use Brian2694\Toastr\Facades\Toastr;

class Taglist extends Component
{
    public $showUpdateModal = false;
    public $tagData         = [];

    public function render()
    {
        $tags = Tag::latest()->paginate();
        return view('livewire.backend.tag.taglist', compact('tags'));
    }

    public function addTag(){
        $this->showUpdateModal = false;
        $this->dispatchBrowserEvent('show-form');
        $this->dispatchBrowserEvent('img_required');
    }

    public function editTag(Tag $tag){
        $this->showUpdateModal  = true;
        $this->tagData          = $tag->toArray();
        $this->dispatchBrowserEvent('show-form');
    }

    public function confirmDel(Tag $tag){
        $this->tagData          = $tag->toArray();
        $this->dispatchBrowserEvent('show-confirm');
    }
    
    public function createTag(){
        $tag               = new Tag;
        $tag->tag_name     = $this->tagData['tag_name'];
        $tag->tag_str      = Str::slug($this->tagData['tag_name']);
        $tag->save();
        // browser events
        $this->browserEvents();
        // toastr alert
        $this->dispatchBrowserEvent('alert',[
            'type' => 'success',  
            'message' => 'Tag Created Successfully!'
        ]);

        return redirect()->back();
    }

    public function updateTag(){
        $tag               = Tag::find($this->tagData['id']);
        $tag->tag_name     = $this->tagData['tag_name'];
        $tag->tag_str      = Str::slug($this->tagData['tag_name']);
        $tag->save();
        // browser events
        $this->browserEvents();
        // toastr alert
        $this->dispatchBrowserEvent('alert',[
            'type' => 'success',  
            'message' => 'Tag Created Successfully!'
        ]);
        
        return redirect()->back();
    }

    public function deleteTag(){
        $tag   = Tag::find($this->tagData['id']);
        $tag->delete();
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
