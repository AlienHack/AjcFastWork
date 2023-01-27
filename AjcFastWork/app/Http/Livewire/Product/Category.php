<?php

namespace App\Http\Livewire\Product;

use App\Models\ProductCategory;
use Livewire\Component;
use Livewire\WithPagination;

class Category extends Component
{
    use WithPagination;
    public $search;
    public $editForm = array();
    protected $queryString = ['search'];

    public function render()
    {
        return view('livewire.product.category', [
            'categories' => ProductCategory::where('name', 'like', "%{$this->search}%")->paginate(10),
        ]);
    }

    public function setEditForm(ProductCategory $category){
        $this->editForm['id'] = $category->id;
        $this->editForm['name'] = $category->name;
        $this->editForm['detail'] = $category->detail;
        $this->editForm['price'] = $category->price;
        $this->editForm['unit'] = $category->unit;
    }

    public function editSubmit() {
        $category = ProductCategory::find($this->editForm['id']);
        $category->name = $this->editForm['name'];
        $category->detail = $this->editForm['detail'];
        $category->price = $this->editForm['price'];
        $category->unit = $this->editForm['unit'];
        $category->save();

        $this->dispatchBrowserEvent('closeModal', [
            'modalId' => 'edit-modal'
        ]);

        $this->dispatchBrowserEvent('showAlert', [
            'icon' => 'success',
            'text' => 'Category updated successfully',
            'toast' => true,
            'timer' => 3000,
            'position' => 'top-end',
            'showConfirmButton' => false,
            'timerProgressBar' => true,
        ]);
    }
}
