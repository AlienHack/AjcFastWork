<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
        {{ __('Settings') }}
    </h2>
</x-slot>

<div>
    <section id="header-section">
        <div class="py-12 pb-6">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <header>
                            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                {{ __('Branch Settings') }}
                            </h2>

                            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                {{ __("You can manage branches here") }}
                            </p>
                        </header>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="search-section">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-between">
                <input wire:model.lazy="search" type="text" placeholder="{{ __('Search Branches') }}"
                       class="input w-full"/>
                <label class="btn ml-3" for="add-modal" class="ml-5">{{ __('Create Branch') }}</label>
            </div>
        </div>
    </section>

    <section id="data-section">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 pt-6">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="m-3 overflow-x-auto">
                    <table class="table w-full">
                        <!-- head -->
                        <thead>
                        <tr>
                            <th>{{ __('Code') }}</th>
                            <th>{{ __('Branch Type') }}</th>
                            <th>{{ __('Branch Name (EN)') }}</th>
                            <th>{{ __('Branch Name (TH)') }}</th>
                            <th>{{ __('Branch Address (EN)') }}</th>
                            <th>{{ __('Branch Address (TH)') }}</th>
                            <th class="text-end">{{ __('Actions') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        <!-- row 1 -->
                        @forelse($branches as $branch)
                            <tr>
                                <td>{{ \App\Helpers\StringHelper::GetTrimText($branch->code, 20) }}</td>
                                <td>{{ \App\Helpers\StringHelper::GetTrimText($branch->branch_type, 20) }}</td>
                                <td>{{ $branch->name_en }}</td>
                                <td>{{ $branch->name_th }}</td>
                                <td>{{ $branch->address_en }}</td>
                                <td>{{ $branch->address_th }}</td>
                                <td class="text-end">
                                    <label wire:click="setEditForm('{{$branch->id}}')" class="btn btn-warning"
                                           for="edit-modal">{{ __('Edit') }}</label>
                                    <button onclick="confirmDelete('{{$branch->id}}')"
                                            class="btn btn-error ml-2">{{ __('Delete') }}</button>
                                </td>
                            </tr>
                        @empty
                            <td colspan="7" class="text-center">{{ __('No data found') }}</td>
                        @endforelse
                        </tbody>
                    </table>
                    <div class="pt-3">
                        {{ $branches->links() }}
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="modal-area">
        <section id="edit-modal-section">
            <input type="checkbox" id="edit-modal" class="modal-toggle"/>
            <div class="modal">
                <div class="modal-box max-w-6xl">
                    <h3 class="font-bold text-lg">{{ __('Edit Branch') }}</h3>
                    <form wire:submit.prevent="editSubmit">
                        <div class="mt-6 bg-gray-50 dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                            <div class="p-6 text-gray-900 dark:text-gray-100">
                                <div class="grid bg-gray-100 my-4 text-center justify-center sm:rounded-lg">
                                    <img class="h-52 py-3" src="{{ isset($this->editForm['logo']) && $this->editForm['logo'] != "" ? asset('storage/'.$this->editForm['logo']) : asset('images/logo.webp') }}"/>
                                </div>

                                <label class="label py-6 text-lg font-bold">{{ __('Branch Settings') }}</label>
                                <div class="bg-gray-100 sm:rounded-lg p-4">
                                    <div>
                                        <label class="label">{{ __('Logo') }}</label>
                                        <input type="file" wire:model.defer="newLogo" class="file-input file-input-bordered w-full max-w-xs"/>
                                        @error('photo') <span class="error">{{ $message }}</span> @enderror
                                    </div>
                                    <div>
                                        <label class="label">{{ __('Code') }}</label>
                                        <input type="text" required wire:model.defer="editForm.code" placeholder="0001" class="input w-full max-w-lg"/>
                                    </div>
                                    <div>
                                        <label class="label">{{ __('Tax ID') }}</label>
                                        <input type="text" wire:model.defer="editForm.tax_id" placeholder="{{__('1102033044543')}}" class="input w-full max-w-lg"/>
                                    </div>
                                    <div class="grid grid-cols-2 gap-4">
                                        <div>
                                            <label class="label pr-2">{{ __('Company Name (TH)') }}</label>
                                            <input type="text" wire:model.defer="editForm.name_th" placeholder="{{__('บริษัท เอบีซี จำกัด')}}" class="input w-full max-w-lg"/>
                                        </div>
                                        <div>
                                            <label class="label pr-2">{{ __('Company Name (EN)') }}</label>
                                            <input type="text" wire:model.defer="editForm.name_en" placeholder="{{__('ABC Company Limited')}}" class="input w-full max-w-lg"/>
                                        </div>
                                        <div>
                                            <label class="label pr-2">{{ __('Company Address (TH)') }}</label>
                                            <textarea placeholder="{{__('123 หมู่ 4')}}" wire:model.defer="editForm.address_th"
                                                      class="textarea input w-full max-w-lg h-24"></textarea>
                                        </div>
                                        <div>
                                            <label class="label pr-2">{{ __('Company Address (TH)') }}</label>
                                            <textarea placeholder="{{__('123 Moo. 4')}}" wire:model.defer="editForm.address_en"
                                                      class="textarea input w-full max-w-lg h-24"></textarea>
                                        </div>
                                    </div>
                                    <div class="grid grid-cols-3 gap-4">
                                        <div>
                                            <label class="label">{{ __('Branch Type') }}</label>
                                            <input type="text" wire:model.defer="editForm.branch_type" placeholder="{{ __('สำนักงานใหญ่') }}" class="input w-full max-w-md"/>
                                        </div>
                                        <div>
                                            <label class="label pr-2">{{ __('Phone Number') }}</label>
                                            <input type="text" wire:model.defer="editForm.phone" placeholder="{{ __('0817723432') }}" class="input w-full max-w-lg"/>
                                        </div>
                                        <div>
                                            <label class="label pr-2">{{ __('Fax Number') }}</label>
                                            <input type="text" wire:model.defer="editForm.fax_id" placeholder="{{ __('021234567') }}" class="input w-full max-w-lg"/>
                                        </div>
                                        <div>
                                            <label class="label pr-2">{{ __('Email') }}</label>
                                            <input type="text" wire:model.defer="editForm.email" placeholder="{{ __('abc@example.com') }}" class="input w-full max-w-lg"/>
                                        </div>
                                    </div>
                                </div>

                                <label class="label pt-6 text-lg font-bold">{{ __('Document Settings') }}</label>
                                <div class="bg-gray-100 sm:rounded-lg  p-4 my-4 grid grid-cols-3 gap-4">
                                    <div>
                                        <label class="label">{{ __('Vat') }}</label>
                                        <input type="number" wire:model.defer="editForm.vat" placeholder="{{ __('7') }}" class="input w-full max-w-md"/>
                                    </div>
                                    <div>
                                        <label class="label">{{ __('Quotation Prefix') }}</label>
                                        <input type="text" wire:model.defer="editForm.quotation_prefix" placeholder="{{ __('QT') }}" class="input w-full max-w-md"/>
                                    </div>
                                    <div>
                                        <label class="label pr-2">{{ __('Invoice Prefix') }}</label>
                                        <input type="text" wire:model.defer="editForm.invoice_prefix" placeholder="{{ __('INV') }}" class="input w-full max-w-lg"/>
                                    </div>
                                    <div>
                                        <label class="label pr-2">{{ __('Bill Prefix') }}</label>
                                        <input type="text" wire:model.defer="editForm.bill_prefix" placeholder="{{ __('BILL') }}" class="input w-full max-w-lg"/>
                                    </div>
                                    <div>
                                        <label class="label pr-2">{{ __('Tax Prefix') }}</label>
                                        <input type="text" wire:model.defer="editForm.tax_prefix" placeholder="{{ __('TAX') }}" class="input w-full max-w-lg"/>
                                    </div>
                                    <div>
                                        <label class="label pr-2">{{ __('Receipt Prefix') }}</label>
                                        <input type="text" wire:model.defer="editForm.receipt_prefix" placeholder="{{ __('REC') }}" class="input w-full max-w-lg"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-action">
                            <button class="btn">{{ __('Save') }}</button>
                            <label for="edit-modal" class="btn btn-ghost">{{ __('Cancel') }}</label>
                        </div>
                    </form>
                </div>
            </div>
        </section>
        <section id="add-modal-section">
            <input type="checkbox" id="add-modal" class="modal-toggle"/>
            <div class="modal">
                <div class="modal-box max-w-6xl">
                    <h3 class="font-bold text-lg">{{ __('Add New Branch') }}</h3>
                    <form wire:submit.prevent="addSubmit">
                        <div class="mt-6 bg-gray-50 dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                            <div class="p-6 text-gray-900 dark:text-gray-100">
                                <label class="label py-6 text-lg font-bold">{{ __('Branch Settings') }}</label>
                                <div class="bg-gray-100 sm:rounded-lg p-4">
                                    <div>
                                        <label class="label">{{ __('Logo') }}</label>
                                        <input type="file" wire:model.defer="addForm.logo" class="file-input file-input-bordered w-full max-w-xs"/>
                                    </div>
                                    <div>
                                        <label class="label">{{ __('Code') }}</label>
                                        <input type="text" required wire:model.defer="addForm.code" placeholder="0001" class="input w-full max-w-lg"/>
                                    </div>
                                    <div>
                                        <label class="label">{{ __('Tax ID') }}</label>
                                        <input type="text" wire:model.defer="addForm.tax_id" placeholder="{{__('1102033044543')}}" class="input w-full max-w-lg"/>
                                    </div>
                                    <div class="grid grid-cols-2 gap-4">
                                        <div>
                                            <label class="label pr-2">{{ __('Company Name (TH)') }}</label>
                                            <input type="text" wire:model.defer="addForm.name_th" placeholder="{{__('บริษัท เอบีซี จำกัด')}}" class="input w-full max-w-lg"/>
                                        </div>
                                        <div>
                                            <label class="label pr-2">{{ __('Company Name (EN)') }}</label>
                                            <input type="text" wire:model.defer="addForm.name_en" placeholder="{{__('ABC Company Limited')}}" class="input w-full max-w-lg"/>
                                        </div>
                                        <div>
                                            <label class="label pr-2">{{ __('Company Address (TH)') }}</label>
                                            <textarea placeholder="{{__('123 หมู่ 4')}}" wire:model.defer="addForm.address_th"
                                                      class="textarea input w-full max-w-lg h-24"></textarea>
                                        </div>
                                        <div>
                                            <label class="label pr-2">{{ __('Company Address (TH)') }}</label>
                                            <textarea placeholder="{{__('123 Moo. 4')}}" wire:model.defer="addForm.address_en"
                                                      class="textarea input w-full max-w-lg h-24"></textarea>
                                        </div>
                                    </div>
                                    <div class="grid grid-cols-3 gap-4">
                                        <div>
                                            <label class="label">{{ __('Branch Type') }}</label>
                                            <input type="text" wire:model.defer="addForm.branch_type" placeholder="{{ __('สำนักงานใหญ่') }}" class="input w-full max-w-md"/>
                                        </div>
                                        <div>
                                            <label class="label pr-2">{{ __('Phone Number') }}</label>
                                            <input type="text" wire:model.defer="addForm.phone" placeholder="{{ __('0817723432') }}" class="input w-full max-w-lg"/>
                                        </div>
                                        <div>
                                            <label class="label pr-2">{{ __('Fax Number') }}</label>
                                            <input type="text" wire:model.defer="addForm.fax_id" placeholder="{{ __('021234567') }}" class="input w-full max-w-lg"/>
                                        </div>
                                        <div>
                                            <label class="label pr-2">{{ __('Email') }}</label>
                                            <input type="text" wire:model.defer="addForm.email" placeholder="{{ __('abc@example.com') }}" class="input w-full max-w-lg"/>
                                        </div>
                                    </div>
                                </div>

                                <label class="label pt-6 text-lg font-bold">{{ __('Document Settings') }}</label>
                                <div class="bg-gray-100 sm:rounded-lg  p-4 my-4 grid grid-cols-3 gap-4">
                                    <div>
                                        <label class="label">{{ __('Vat') }}</label>
                                        <input type="number" wire:model.defer="addForm.vat" placeholder="{{ __('7') }}" class="input w-full max-w-md"/>
                                    </div>
                                    <div>
                                        <label class="label">{{ __('Quotation Prefix') }}</label>
                                        <input type="text" wire:model.defer="addForm.quotation_prefix" placeholder="{{ __('QT') }}" class="input w-full max-w-md"/>
                                    </div>
                                    <div>
                                        <label class="label pr-2">{{ __('Invoice Prefix') }}</label>
                                        <input type="text" wire:model.defer="addForm.invoice_prefix" placeholder="{{ __('INV') }}" class="input w-full max-w-lg"/>
                                    </div>
                                    <div>
                                        <label class="label pr-2">{{ __('Bill Prefix') }}</label>
                                        <input type="text" wire:model.defer="addForm.bill_prefix" placeholder="{{ __('BILL') }}" class="input w-full max-w-lg"/>
                                    </div>
                                    <div>
                                        <label class="label pr-2">{{ __('Tax Prefix') }}</label>
                                        <input type="text" wire:model.defer="addForm.tax_prefix" placeholder="{{ __('TAX') }}" class="input w-full max-w-lg"/>
                                    </div>
                                    <div>
                                        <label class="label pr-2">{{ __('Receipt Prefix') }}</label>
                                        <input type="text" wire:model.defer="addForm.receipt_prefix" placeholder="{{ __('REC') }}" class="input w-full max-w-lg"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-action">
                            <button class="btn">{{ __('Save') }}</button>
                            <label for="add-modal" class="btn btn-ghost">{{ __('Cancel') }}</label>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </section>

    <script>
        function confirmDelete(id) {
            Swal.fire({
                title: '{{ __('Are you sure?') }}',
                text: "{{ __('You will not be able to revert this!') }}",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: '{{ __('Yes, delete it!') }}',
            }).then((result) => {
                    if (result.isConfirmed) {
                        @this.
                        call('delete', id);
                    }
                }
            )
        }
    </script>
</div>
