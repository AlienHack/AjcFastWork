<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
        {{ __('Product Categories') }}
    </h2>
</x-slot>

<div>
    <div class="py-12 pb-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("You can manage product categories here") }}
                </div>
            </div>
        </div>
    </div>
    <section id="search-section">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-between">
                <input wire:model.lazy="search" type="text" placeholder="{{ __('Search Product Categories') }}" class="input w-full" />
                <x-primary-button class="ml-5">{{ __('Create Category') }}</x-primary-button>
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
                            <th>{{ __('Category Name') }}</th>
                            <th>{{ __('Detail') }}</th>
                            <th>{{ __('Price') }}</th>
                            <th>{{ __('Unit') }}</th>
                            <th>{{ __('Actions') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        <!-- row 1 -->
                        @forelse($categories as $category)
                        <tr>
                            <td>{{ \App\Helpers\StringHelper::GetTrimText($category->name, 15) }}</td>
                            <td>{{ \App\Helpers\StringHelper::GetTrimText($category->detail, 15) }}</td>
                            <td>{{ $category->price }}</td>
                            <td>{{ $category->unit }}</td>
                            <td><label wire:click="setEditForm('{{$category->id}}')" class="btn btn-warning" for="edit-modal">{{ __('Edit') }}</label><button class="btn btn-error ml-2">{{ __('Remove') }}</button></td>
                        </tr>
                        @empty
                            <td colspan="5" class="text-center">{{ __('No data found') }}</td>
                        @endforelse
                        </tbody>
                    </table>
                    <div class="pt-3">
                        {{ $categories->links() }}
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="modal-area">
        <input type="checkbox" id="edit-modal" class="modal-toggle" />
        <div class="modal">
            <div class="modal-box">
                <h3 class="font-bold text-lg">{{ __('Edit Category') }}</h3>
                <div class="mt-6 bg-gray-100 dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <div>
                            <span class="p-2">{{__('Category Name')}}</span>
                            <input type="text" required wire:model.defer="editForm.name" placeholder="Type here" class="input w-full" />
                        </div>
                        <div class="mt-3">
                            <span class="p-2">{{__('Detail')}}</span>
                            <input type="text" wire:model.defer="editForm.detail" placeholder="Type here" class="input w-full" />
                        </div>
                        <div class="mt-3">
                            <span class="p-2">{{__('Price')}}</span>
                            <input type="number" wire:model.defer="editForm.price" placeholder="Type here" class="input w-full" />
                        </div>
                        <div class="mt-3">
                            <span class="p-2">{{__('Unit')}}</span>
                            <input type="text" wire:model.defer="editForm.unit" placeholder="Type here" class="input w-full" />
                        </div>
                    </div>
                </div>
                <div class="modal-action">
                    <button wire:click="editSubmit" class="btn">{{ __('Save') }}</button>
                    <label for="edit-modal" class="btn btn-warning">{{ __('Cancel') }}</label>
                </div>
            </div>
        </div>
    </section>
</div>
