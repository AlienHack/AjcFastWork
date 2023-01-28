<?php

namespace App\Http\Livewire\Quotation;

use Livewire\Component;
use Livewire\WithPagination;

class Quotation extends Component
{
    use WithPagination;

    public $search;
    public $selectedBranch;
    protected $queryString = ['search', 'selectedBranch'];
    public function render()
    {
        return view('livewire.quotation.quotation', [
            'quotations' => \App\Models\Quotation::where('branch_id', 'like', "%{$this->selectedBranch}%")
                ->where(
                    function($query) {
                        $query->where('quote_no', 'like', "%{$this->search}%")
                            ->orWhere('quote_project_name', 'like', "%{$this->search}%")
                            ->orWhere('customer_code', 'like', "%{$this->search}%")
                            ->orWhere('customer_name', 'like', "%{$this->search}%");
                    }
                )
                ->paginate(10),
            'branches' => \App\Models\Branch::all(),
        ]);
    }

    public function delete(\App\Models\Quotation $quotation)
    {
        $quotation->delete();
        $this->dispatchBrowserEvent('showAlert', [
            'icon' => 'success',
            'text' => __('Quotation deleted successfully'),
            'toast' => true,
            'timer' => 3000,
            'position' => 'top-end',
            'showConfirmButton' => false,
            'timerProgressBar' => true,
        ]);
    }
}
