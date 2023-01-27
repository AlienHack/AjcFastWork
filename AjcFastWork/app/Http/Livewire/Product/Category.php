<?php

namespace App\Http\Livewire\Product;

use App\Models\Product;
use App\Models\ProductCategory;
use Livewire\Component;
use Livewire\WithPagination;

class Category extends Component
{
    use WithPagination;
    public $search;
    public $selectedCategory;
    public $addForm = array();
    public $editForm = array();
    public $productForm = array();
    public $editProductForm = array();
    public $productList = [];
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
    public function setEditProductForm(Product $product){
        $this->editProductForm['id'] = $product->id;
        $this->editProductForm['name'] = $product->name;
        $this->editProductForm['detail'] = $product->detail;
        $this->editProductForm['rawPrice'] = $product->raw_price;
        $this->editProductForm['price'] = $product->price;
        $this->editProductForm['unit'] = $product->unit;
    }
    public function setProductForm(ProductCategory $category){
        $this->productList = Product::where('category_id', $category->id)->get();
        $this->selectedCategory = $category->id;
    }
    public function addSubmit() {
        if (!isset($this->addForm['name'])){
            $this->dispatchBrowserEvent('showAlert', [
                'icon' => 'error',
                'text' => __('Category name is required'),
                'toast' => true,
                'timer' => 3000,
                'position' => 'top-end',
                'showConfirmButton' => false,
                'timerProgressBar' => true,
            ]);
            return;
        }
        $category = new ProductCategory();
        $category->name = $this->addForm['name'] ?? "";
        $category->detail = $this->addForm['detail'] ?? "";
        $category->price = $this->addForm['price'] ?? 0;
        $category->unit = $this->addForm['unit'] ?? "";
        $category->save();

        $this->dispatchBrowserEvent('closeModal', [
            'modalId' => 'add-modal'
        ]);

        $this->dispatchBrowserEvent('showAlert', [
            'icon' => 'success',
            'text' => __('Category added successfully'),
            'toast' => true,
            'timer' => 3000,
            'position' => 'top-end',
            'showConfirmButton' => false,
            'timerProgressBar' => true,
        ]);
    }
    public function editSubmit() {
        if (!isset($this->editForm['name'])){
            $this->dispatchBrowserEvent('showAlert', [
                'icon' => 'error',
                'text' => __('Category name is required'),
                'toast' => true,
                'timer' => 3000,
                'position' => 'top-end',
                'showConfirmButton' => false,
                'timerProgressBar' => true,
            ]);
            return;
        }
        $category = ProductCategory::find($this->editForm['id']);
        $category->name = $this->editForm['name'] ?? "";
        $category->detail = $this->editForm['detail'] ?? "";
        $category->price = $this->editForm['price'] ?? 0;
        $category->unit = $this->editForm['unit'] ?? "";
        $category->save();

        $this->dispatchBrowserEvent('closeModal', [
            'modalId' => 'edit-modal'
        ]);

        $this->dispatchBrowserEvent('showAlert', [
            'icon' => 'success',
            'text' => __('Category updated successfully'),
            'toast' => true,
            'timer' => 3000,
            'position' => 'top-end',
            'showConfirmButton' => false,
            'timerProgressBar' => true,
        ]);
    }
    public function editProductSubmit() {
        if (!isset($this->editProductForm['name'])){
            $this->dispatchBrowserEvent('showAlert', [
                'icon' => 'error',
                'text' => __('Product name is required'),
                'toast' => true,
                'timer' => 3000,
                'position' => 'top-end',
                'showConfirmButton' => false,
                'timerProgressBar' => true,
            ]);
            return;
        }

        $product = Product::find($this->editProductForm['id']);
        $product->name = $this->editProductForm['name'] ?? "";
        $product->detail = $this->editProductForm['detail'] ?? "";
        $product->raw_price = $this->editProductForm['rawPrice'] ?? 0;
        $product->price = $this->editProductForm['price'] ?? 0;
        $product->unit = $this->editProductForm['unit'] ?? "";
        $product->save();

        $this->dispatchBrowserEvent('closeModal', [
            'modalId' => 'edit-product-modal'
        ]);

        $this->dispatchBrowserEvent('showAlert', [
            'icon' => 'success',
            'text' => __('Product updated successfully'),
            'toast' => true,
            'timer' => 3000,
            'position' => 'top-end',
            'showConfirmButton' => false,
            'timerProgressBar' => true,
        ]);

        $this->productList = Product::where('category_id', $this->selectedCategory)->get();
    }
    public function delete(ProductCategory $category){
        $category->delete();
        $this->dispatchBrowserEvent('showAlert', [
            'icon' => 'success',
            'text' => __('Category deleted successfully'),
            'toast' => true,
            'timer' => 3000,
            'position' => 'top-end',
            'showConfirmButton' => false,
            'timerProgressBar' => true,
        ]);
    }
    public function addProduct(){
        if (!isset($this->productForm['name'])){
            $this->dispatchBrowserEvent('showAlert', [
                'icon' => 'error',
                'text' => __('Product name is required'),
                'toast' => true,
                'timer' => 3000,
                'position' => 'top-end',
                'showConfirmButton' => false,
                'timerProgressBar' => true,
            ]);
            return;
        }
        $product = new Product();
        $product->category_id = $this->selectedCategory;
        $product->name = $this->productForm['name'] ?? "";
        $product->detail = $this->productForm['detail'] ?? "";
        $product->raw_price = $this->productForm['rawPrice'] ?? 0;
        $product->price = $this->productForm['price'] ?? 0;
        $product->unit = $this->productForm['unit'] ?? "";
        $product->save();

        $this->productForm = array();

        $this->productList = Product::where('category_id', $this->selectedCategory)->get();
    }
    public function deleteProduct(Product $product){
        $product->delete();
        $this->productList = Product::where('category_id', $this->selectedCategory)->get();

    }
}
