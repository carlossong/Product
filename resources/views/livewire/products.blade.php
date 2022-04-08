<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <div class="flex items-center justify-between mr-2">
                @if (session()->has('message'))
                    <h1 class="font-semibold text-4xl text-green-600 px-4 py-2">
                        {{ session('message') }}
                    </h1>
                @else
                    <h1 class="font-semibold text-4xl text-gray-500 px-4 py-2">
                        {{__('Products')}}
                    </h1>
                @endif
                <x-button.primary wire:click='newProduct'>
                    <div class="flex items-center space-x-2">
                        <x-icon.plus class="w-5 h-5"></x-icon.plus>
                        <span>New Product</span>
                    </div>
                </x-button.primary>
            </div>
            <div class="rounded-xl overflow-hidden shadow bg-white">
                <table class="min-w-full divide-y divide-gray-400 w-full">
                    <thead>
                        <th class="text-left text-xs uppercase bg-gray-100 text-gray-400 px-4 py-2">
                            {{__('id')}}
                        </th>
                        <th class="text-left text-xs uppercase bg-gray-100 text-gray-400 px-4 py-2">
                            {{__('Product')}}
                        </th>
                        <th class="text-left text-xs uppercase bg-gray-100 text-gray-400 px-4 py-2">
                            {{__('Price')}}
                        </th>
                        <th class="text-left text-xs uppercase bg-gray-100 text-gray-400 px-4 py-2">
                            {{__('Created_at')}}
                        </th>
                        <th class="text-left text-xs uppercase bg-gray-100 text-gray-400 px-4 py-2">
                            {{__('Updated_at')}}
                        </th>
                        <th class="text-left text-xs uppercase bg-gray-100 text-gray-400 px-4 py-2">
                            {{__('Actions')}}
                        </th>
                    </thead>

                    <tbody>
                        @forelse ($this->products as $product)

                        <tr class="odd:bg-gray-50">
                            <td class="px-4 py-2">
                                {{ $product->id }}
                            </td>
                            <td class="text-gray-900 px-4 py-2">
                                <div class="font-semibold capitalize">
                                    {{ $product->name }}
                                </div>
                                <div class="text-xs text-gray-500">
                                    {{ $product->description }}
                                </div>
                            </td>
                            <td class="text-gray-500 text-center px-4 py-2">
                                <span class="whitespace-pre">$ {{ $product->price / 100 }}</span>
                            </td>
                            <td class="text-gray-500 text-center px-4 py-2">
                                <span class="whitespace-pre">{{ $product->created_at->toFormattedDateString() }}</span>
                            </td>
                            <td class="text-gray-500 text-center px-4 py-2">
                                <span class="whitespace-pre">{{ $product->updated_at->toFormattedDateString() }}</span>
                            </td>
                            <td class="text-gray-500 text-center px-4 py-2">
                                <div class="flex intems-center space-x-1">
                                    <x-button wire:click="edit({{ $product->id }})" class="w-7 h-7 p-1 text-gray-500 rounded-md bg-white border-transparent hover:bg-gray-200 hover:border-gray-100">
                                        <x-icon.pencil-alt class="w-full h-full"></x-icon.pencil-alt>
                                    </x-button>
                                    <x-button wire:click="confirmingProductDeletion({{ $product->id }})" class="w-7 h-7 p-1 text-red-500 rounded-md bg-white border-transparent hover:bg-red-400 hover:border-red-400 hover:text-white">
                                        <x-icon.trash class="w-full h-full"></x-icon.trash>
                                    </x-button>
                                </div>
                            </td>
                        </tr>
                        @empty
                            Empty
                        @endforelse
                    </tbody>
                </table>
                <div class="p-2">
                    {{ $this->products->onEachSide(1)->links() }}
                </div>
            </div>
        </div>
    </div>

    <!-- New Product Modal -->
    <x-jet-dialog-modal wire:model="openModalCreate">
        <x-slot name="title">
            {{ __('New Product Form') }}
        </x-slot>

        <x-slot name="content">

            <div class="space-y-4">

                <!-- Name -->
            <div class="mt-2">
                <x-jet-label for="form.name" value="{{ __('Name') }}" />
                <x-jet-input id="form.name" type="text" class="block w-full" wire:model.defer="form.name" autocomplete="form.name" placeholder="Product name" />
                <x-jet-input-error for="form.name" class="mt-2" />
            </div>

            <!-- Price -->
            <div class="mt-2">
                <x-jet-label for="form.price" value="{{ __('Price') }}" />
                <x-jet-input id="form.price" type="number" step="1" min="0" class="block w-full" wire:model.defer="form.price" autocomplete="form.price" placeholder="Product price" />
                <x-jet-input-error for="form.price" class="mt-2" />
            </div>

            <!-- Description -->
            <div class="mt-2">
                <x-jet-label for="form.description" value="{{ __('Description') }}" />
                <textarea rows="3" id="form.description" class="w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" wire:model.defer="form.description" autocomplete="form.description" placeholder="Product description"></textarea>
                <x-jet-input-error for="form.description" class="mt-2" />
            </div>

        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$toggle('openModalCreate')" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-jet-secondary-button>

            <x-button.primary class="ml-3" wire:click="save" wire:loading.attr="disabled">
                {{ __('Save') }}
            </x-button.primary>

            </div>

        </x-slot>
    </x-jet-dialog-modal>

    <!-- Delete Product Confirmation Modal -->
    <x-jet-dialog-modal wire:model="openModalDelete">
        <x-slot name="title">
            {{ __('Please Confirm') }}
        </x-slot>

        <x-slot name="content">
            @if ($productToRemove)
                <p>Are you sure you want to delete <b class="capitalize">{{ $productToRemove->name }}</b>?</p>
            @endif


        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$toggle('openModalDelete')" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-jet-secondary-button>

            <x-jet-danger-button class="ml-3" wire:click="remove" wire:loading.attr="disabled">
                {{ __('Yes, I´m sure!') }}
            </x-jet-danger-button>
        </x-slot>
    </x-jet-dialog-modal>

</div>

