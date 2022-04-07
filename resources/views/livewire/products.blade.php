<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <div class="flex items-center justify-between mr-2">
                <h1 class="font-semibold text-4xl text-gray-500 px-4 py-2">
                    Products
                </h1>
                <x-button.primary>
                    <div class="flex items-center space-x-2">
                        <x-icon.plus class="w-5 h-5"></x-icon.plus>
                        <span>New Product</span>
                    </div>
                </x-button.primary>
            </div>

            <x-jet-dialog-modal wire:model='openModalCreate'>
                <x-slot name="title">
                    {{ __('New Product') }}
                </x-slot>

                <x-slot name="content">
                    <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Eum natus nemo doloremque. Sapiente excepturi quae, ad ea porro neque magni tempore omnis praesentium alias, totam perspiciatis! Totam maiores modi unde!</p>
                </x-slot>

                <x-slot name="footer">
                    <x-jet-secondary-button>
                        {{ __('Cancel') }}
                    </x-jet-secondary-button>

                    <x-jet-button class="ml-3" wire:click="deleteUser" wire:loading.attr="disabled">
                        {{ __('Save') }}
                    </x-jet-button>
                </x-slot>
            </x-jet-dialog-modal>

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
                                    <x-button class="w-7 h-7 p-1 text-gray-500 rounded-md bg-white border-transparent hover:bg-gray-200 hover:border-gray-100">
                                        <x-icon.pencil-alt class="w-full h-full"></x-icon.pencil-alt>
                                    </x-button>
                                    <x-button class="w-7 h-7 p-1 text-red-500 rounded-md bg-white border-transparent hover:bg-red-400 hover:border-red-400 hover:text-white">
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
</div>

