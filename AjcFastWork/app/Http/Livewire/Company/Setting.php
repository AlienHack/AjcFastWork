<?php

namespace App\Http\Livewire\Company;

use App\Models\Branch;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class Setting extends Component
{
    use WithPagination, WithFileUploads;
    public $search;
    public $editForm = array();
    public $addForm = array();
    public $newLogo;
    protected $queryString = ['search'];
    public function render()
    {
        return view('livewire.company.setting', [
            'branches' => Branch::where('name_en', 'like', "%{$this->search}%")
                ->orWhere('name_th', 'like', "%{$this->search}%")
                ->orWhere('address_th', 'like', "%{$this->search}%")
                ->orWhere('address_en', 'like', "%{$this->search}%")
                ->orWhere('tax_id', 'like', "%{$this->search}%")
                ->orWhere('branch_type', 'like', "%{$this->search}%")
                ->orWhere('code', 'like', "%{$this->search}%")
                ->paginate(10),
        ]);
    }

    public function setEditForm(Branch $branch){
        $this->editForm['id'] = $branch->id;
        $this->editForm['name_en'] = $branch->name_en;
        $this->editForm['name_th'] = $branch->name_th;
        $this->editForm['address_en'] = $branch->address_en;
        $this->editForm['address_th'] = $branch->address_th;
        $this->editForm['tax_id'] = $branch->tax_id;
        $this->editForm['branch_type'] = $branch->branch_type;
        $this->editForm['code'] = $branch->code;
        $this->editForm['email'] = $branch->email;
        $this->editForm['phone'] = $branch->phone;
        $this->editForm['fax_id'] = $branch->fax_id;
        $this->editForm['logo'] = $branch->logo;
        $this->editForm['quotation_prefix'] = $branch->quotation_prefix;
        $this->editForm['invoice_prefix'] = $branch->invoice_prefix;
        $this->editForm['receipt_prefix'] = $branch->receipt_prefix;
        $this->editForm['tax_prefix'] = $branch->tax_prefix;
        $this->editForm['bill_prefix'] = $branch->bill_prefix;
    }

    public function delete(Branch $branch){
        $branch->delete();
        $this->dispatchBrowserEvent('showAlert', [
            'icon' => 'success',
            'text' => __('Branch deleted successfully'),
            'toast' => true,
            'timer' => 3000,
            'position' => 'top-end',
            'showConfirmButton' => false,
            'timerProgressBar' => true,
        ]);
    }

    public function editSubmit(){
        if (isset($this->newLogo)) {
            $this->validate([
                'newLogo' => 'image|max:1024', // 1MB Max
            ]);
            $this->editForm['logo'] = $this->newLogo->store('branch_logo', 'public');
        }

        $branch = Branch::find($this->editForm['id']);
        $branch->name_en = $this->editForm['name_en'] ?? "";
        $branch->name_th = $this->editForm['name_th'] ?? "";
        $branch->address_en = $this->editForm['address_en'] ?? "";
        $branch->address_th = $this->editForm['address_th'] ?? "";
        $branch->tax_id = $this->editForm['tax_id'] ?? "";
        $branch->branch_type = $this->editForm['branch_type'] ?? "";
        $branch->code = $this->editForm['code'] ?? "";
        $branch->email = $this->editForm['email'] ?? "";
        $branch->phone = $this->editForm['phone'] ?? "";
        $branch->fax_id = $this->editForm['fax_id'] ?? "";
        $branch->logo = $this->editForm['logo'] ?? "";
        $branch->quotation_prefix = $this->editForm['quotation_prefix'] ?? "";
        $branch->invoice_prefix = $this->editForm['invoice_prefix'] ?? "";
        $branch->receipt_prefix = $this->editForm['receipt_prefix'] ?? "";
        $branch->tax_prefix = $this->editForm['tax_prefix'] ?? "";
        $branch->bill_prefix = $this->editForm['bill_prefix'] ?? "";
        $branch->save();
        $this->newLogo = null;
        $this->dispatchBrowserEvent('showAlert', [
            'icon' => 'success',
            'text' => __('Branch updated successfully'),
            'toast' => true,
            'timer' => 3000,
            'position' => 'top-end',
            'showConfirmButton' => false,
            'timerProgressBar' => true,
        ]);
        $this->dispatchBrowserEvent('closeModal', ['modalId' => 'edit-modal']);
    }

    public function addSubmit(){
        if (isset($this->addForm['logo'])) {
            $this->validate([
                'addForm.logo' => 'image|max:1024', // 1MB Max
            ]);
            $this->addForm['logo'] = $this->addForm['logo']->store('branch_logo', 'public');
        }

        $branch = new Branch();
        $branch->name_en = $this->addForm['name_en'] ?? "";
        $branch->name_th = $this->addForm['name_th'] ?? "";
        $branch->address_en = $this->addForm['address_en'] ?? "";
        $branch->address_th = $this->addForm['address_th'] ?? "";
        $branch->tax_id = $this->addForm['tax_id'] ?? "";
        $branch->branch_type = $this->addForm['branch_type'] ?? "";
        $branch->code = $this->addForm['code'] ?? "";
        $branch->email = $this->addForm['email'] ?? "";
        $branch->phone = $this->addForm['phone'] ?? "";
        $branch->fax_id = $this->addForm['fax_id'] ?? "";
        $branch->logo = $this->addForm['logo'] ?? "";
        $branch->quotation_prefix = $this->addForm['quotation_prefix'] ?? "";
        $branch->invoice_prefix = $this->addForm['invoice_prefix'] ?? "";
        $branch->receipt_prefix = $this->addForm['receipt_prefix'] ?? "";
        $branch->tax_prefix = $this->addForm['tax_prefix'] ?? "";
        $branch->bill_prefix = $this->addForm['bill_prefix'] ?? "";
        $branch->save();

        $this->addForm = array();

        $this->dispatchBrowserEvent('showAlert', [
            'icon' => 'success',
            'text' => __('New branch has been added successfully'),
            'toast' => true,
            'timer' => 3000,
            'position' => 'top-end',
            'showConfirmButton' => false,
            'timerProgressBar' => true,
        ]);
        $this->dispatchBrowserEvent('closeModal', ['modalId' => 'add-modal']);
    }
}
