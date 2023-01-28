<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
        {{ __('Quotations') }}
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
                                {{ __('Quotations List') }}
                            </h2>

                            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                {{ __("You can manage quotations here") }}
                            </p>
                        </header>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="search-section">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-between gap-4">
                <select wire:model.lazy="selectedBranch" placeholder="{{ __('Select Branch') }}"
                       class="input w-1/3">
                    <option value="">{{ __('All') }}</option>
                    @foreach($branches as $branch)
                        <option value="{{ $branch->id }}">{{ $branch->name_th }}</option>
                    @endforeach
                </select>
                <input wire:model.lazy="search" type="text" placeholder="{{ __('Search Quotation') }}"
                       class="input w-full"/>
                <a href="{{ route('documents.quotations.create') }}" class="btn ml-3" for="add-modal" class="ml-5">{{ __('Create Quotation') }}</a>
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
                            <th>{{ __('Branch') }}</th>
                            <th>{{ __('Quotation No.') }}</th>
                            <th>{{ __('Project Name') }}</th>
                            <th>{{ __('Quote Date') }}</th>
                            <th>{{ __('Customer Name') }}</th>
                            <th class="text-end">{{ __('Actions') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        <!-- row 1 -->
                        @forelse($quotations as $quotation)
                            <tr>
                                <td>{{ $quotation->branch_name_th }}</td>
                                <td>{{ $quotation->quote_no }}</td>
                                <td>{{ $quotation->quote_project_name }}</td>
                                <td>{{ $quotation->quote_date }}</td>
                                <td>{{ $quotation->customer_name }}</td>
                                <td class="text-end">
                                    <a href="{{ route('documents.quotations.edit', $quotation->id) }}" class="btn btn-warning"
                                           for="edit-modal">{{ __('Edit') }}</a>
                                    <button onclick="confirmDelete('{{$quotation->id}}')"
                                            class="btn btn-error ml-2">{{ __('Delete') }}</button>
                                </td>
                            </tr>
                        @empty
                            <td colspan="7" class="text-center">{{ __('No data found') }}</td>
                        @endforelse
                        </tbody>
                    </table>
                    <div class="pt-3">
                        {{ $quotations->links() }}
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
        function confirmDelete(id) {
            Swal.fire({
                title: '{{ __('Are you sure?') }}',
                text: '{{ __('You will not be able to recover this data!') }}',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: '{{ __('Yes, delete it!') }}',
                cancelButtonText: '{{ __('Cancel') }}'
            }).then((result) => {
                if (result.isConfirmed) {
                    @this.call('delete', id)
                }
            })
        }
    </script>
</div>
