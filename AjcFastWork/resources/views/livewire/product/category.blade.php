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
                <input wire:model.lazy="search" type="text" placeholder="{{ __('Search Product Categories') }}"
                       class="input w-full"/>
                <label class="btn ml-3" for="add-modal" class="ml-5">{{ __('Create Category') }}</label>
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
                            <th class="text-end">{{ __('Actions') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        <!-- row 1 -->
                        @forelse($categories as $category)
                            <tr>
                                <td>{{ \App\Helpers\StringHelper::GetTrimText($category->name, 20) }}</td>
                                <td>{{ \App\Helpers\StringHelper::GetTrimText($category->detail, 20) }}</td>
                                <td>{{ $category->price }}</td>
                                <td>{{ $category->unit }}</td>
                                <td class="text-end">
                                    <label wire:click="setEditForm('{{$category->id}}')" class="btn btn-warning"
                                           for="edit-modal">{{ __('Edit') }}</label>
                                    <label wire:click="setProductForm('{{$category->id}}')" class="btn btn-info ml-2"
                                           for="products-modal">{{ __('Products') }}</label>
                                    <button onclick="confirmDelete('{{$category->id}}')"
                                            class="btn btn-error ml-2">{{ __('Remove') }}</button>
                                </td>
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
        <section id="add-modal-section">
            <input type="checkbox" id="add-modal" class="modal-toggle"/>
            <div class="modal">
                <div class="modal-box">
                    <h3 class="font-bold text-lg">{{ __('Add New Category') }}</h3>
                    <form wire:submit.prevent="addSubmit">
                        <div class="mt-6 bg-gray-50 dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                            <div class="p-6 text-gray-900 dark:text-gray-100">
                                <div>
                                    <span class="p-2">{{__('Category Name')}}</span>
                                    <input type="text" required wire:model.defer="addForm.name" placeholder=""
                                           required
                                           class="input w-full"/>
                                </div>
                                <div class="mt-3">
                                    <span class="p-2">{{__('Detail')}}</span>
                                    <input type="text" wire:model.defer="addForm.detail" placeholder=""
                                           class="input w-full"/>
                                </div>
                                <div class="mt-3">
                                    <span class="p-2">{{__('Price')}}</span>
                                    <input type="number" wire:model.defer="addForm.price" placeholder=""
                                           required
                                           class="input w-full"/>
                                </div>
                                <div class="mt-3">
                                    <span class="p-2">{{__('Unit')}}</span>
                                    <input type="text" wire:model.defer="addForm.unit" placeholder=""
                                           class="input w-full"/>
                                </div>
                            </div>
                        </div>
                        <div class="modal-action">
                            <button class="btn">{{ __('Save') }}</button>
                            <label for="add-modal" class="btn">{{ __('Cancel') }}</label>
                        </div>
                    </form>
                </div>
            </div>
        </section>
        <section id="edit-modal-section">
            <input type="checkbox" id="edit-modal" class="modal-toggle"/>
            <div class="modal">
                <div class="modal-box">
                    <h3 class="font-bold text-lg">{{ __('Edit Category') }}</h3>
                    <form wire:submit.prevent="editSubmit">
                        <div class="mt-6 bg-gray-50 dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                            <div class="p-6 text-gray-900 dark:text-gray-100">
                                <div>
                                    <span class="p-2">{{__('Category Name')}}</span>
                                    <input type="text" required wire:model.defer="editForm.name" placeholder=""
                                           required
                                           class="input w-full"/>
                                </div>
                                <div class="mt-3">
                                    <span class="p-2">{{__('Detail')}}</span>
                                    <input type="text" wire:model.defer="editForm.detail" placeholder=""
                                           class="input w-full"/>
                                </div>
                                <div class="mt-3">
                                    <span class="p-2">{{__('Price')}}</span>
                                    <input type="number" wire:model.defer="editForm.price" placeholder=""
                                           required
                                           class="input w-full"/>
                                </div>
                                <div class="mt-3">
                                    <span class="p-2">{{__('Unit')}}</span>
                                    <input type="text" wire:model.defer="editForm.unit" placeholder=""
                                           class="input w-full"/>
                                </div>
                            </div>
                        </div>
                        <div class="modal-action">
                            <button class="btn">{{ __('Save') }}</button>
                            <label for="edit-modal" class="btn">{{ __('Cancel') }}</label>
                        </div>
                    </form>
                </div>
            </div>
        </section>
        <section id="products-modal-section">
            <input type="checkbox" id="products-modal" class="modal-toggle"/>
            <div class="modal">
                <div class="modal-box max-w-7xl">
                    <h3 class="font-bold text-lg">{{ __('Edit Products') }}</h3>
                    <div class="mt-6 bg-gray-50 dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="grid grid-cols-3 gap-4">
                            <form wire:submit.prevent="addProduct">
                                <div class="p-6 text-gray-900 dark:text-gray-100">
                                    <div>
                                        <span class="p-2">{{__('Product Name')}}</span>
                                        <input type="text" required wire:model.defer="productForm.name"
                                               placeholder="" class="input w-full"/>
                                    </div>
                                    <div class="mt-3">
                                        <span class="p-2">{{__('Detail')}}</span>
                                        <input type="text" wire:model.defer="productForm.detail" placeholder=""
                                               class="input w-full"/>
                                    </div>
                                    <div class="mt-3">
                                        <span class="p-2">{{__('Raw Price')}}</span>
                                        <input type="number" required wire:model.defer="productForm.rawPrice" placeholder=""
                                               class="input w-full"/>
                                    </div>
                                    <div class="mt-3">
                                        <span class="p-2">{{__('Price')}}</span>
                                        <input type="number" required wire:model.defer="productForm.price" placeholder=""
                                               class="input w-full"/>
                                    </div>
                                    <div class="mt-3">
                                        <span class="p-2">{{__('Unit')}}</span>
                                        <input type="text" wire:model.defer="productForm.unit" placeholder=""
                                               class="input w-full"/>
                                    </div>
                                    <div class="mt-3 text-end">
                                        <x-primary-button>{{__('Add Product')}}</x-primary-button>
                                    </div>
                                </div>
                            </form>

                            <div class="p-6 text-gray-900 dark:text-gray-100 col-span-2">
                                <div class="m-3 overflow-x-auto">
                                    <table class="table w-full">
                                        <thead>
                                        <tr>
                                            <th>{{ __('Product Name') }}</th>
                                            <th>{{ __('Detail') }}</th>
                                            <th>{{ __('Raw Price') }}</th>
                                            <th>{{ __('Price') }}</th>
                                            <th>{{ __('Unit') }}</th>
                                            <th>{{ __('Action') }}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @forelse($productList as $product)
                                            <tr>
                                                <td>{{ $product->name }}</td>
                                                <td>{{ $product->detail }}</td>
                                                <td>{{ $product->raw_price }}</td>
                                                <td>{{ $product->price }}</td>
                                                <td>{{ $product->unit }}</td>
                                                <td>
                                                    <label for="edit-product-modal"
                                                           wire:click="setEditProductForm('{{ $product->id }}')"
                                                           class="btn btn-sm btn-warning">{{ __('Edit') }}</label>
                                                    <button wire:click="deleteProduct('{{ $product->id }}')"
                                                            class="btn btn-sm btn-error">{{ __('Delete') }}</button>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="6" class="text-center">{{ __('No data') }}</td>
                                            </tr>
                                        @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="modal-action">
                        <label for="products-modal" class="btn">{{ __('Close') }}</label>
                    </div>
                </div>
            </div>
        </section>
        <section id="edit-product-modal-section">
            <input type="checkbox" id="edit-product-modal" class="modal-toggle"/>
            <div class="modal">
                <div class="modal-box">
                    <h3 class="font-bold text-lg">{{ __('Edit Products') }}</h3>
                    <form wire:submit.prevent="editProductSubmit">
                        <div class="mt-6 bg-gray-50 dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                            <div>
                                <div class="p-6 text-gray-900 dark:text-gray-100">
                                    <div>
                                        <span class="p-2">{{__('Product Name')}}</span>
                                        <input type="text" required wire:model.defer="editProductForm.name"
                                               placeholder="" class="input w-full"/>
                                    </div>
                                    <div class="mt-3">
                                        <span class="p-2">{{__('Detail')}}</span>
                                        <input type="text" wire:model.defer="editProductForm.detail" placeholder=""
                                               class="input w-full"/>
                                    </div>
                                    <div class="mt-3">
                                        <span class="p-2">{{__('Raw Price')}}</span>
                                        <input type="number" required wire:model.defer="editProductForm.rawPrice"
                                               placeholder=""
                                               class="input w-full"/>
                                    </div>
                                    <div class="mt-3">
                                        <span class="p-2">{{__('Price')}}</span>
                                        <input type="number" required wire:model.defer="editProductForm.price"
                                               placeholder=""
                                               class="input w-full"/>
                                    </div>
                                    <div class="mt-3">
                                        <span class="p-2">{{__('Unit')}}</span>
                                        <input type="text" wire:model.defer="editProductForm.unit" placeholder=""
                                               class="input w-full"/>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="modal-action">
                            <button class="btn">{{ __('Save') }}</button>
                            <label for="edit-product-modal" class="btn">{{ __('Close') }}</label>
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
