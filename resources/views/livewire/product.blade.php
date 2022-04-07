<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-2">
            @foreach ($this->products as $product)
                {{ $product->name }} <hr>
            @endforeach
            {{ $this->products->onEachSide(1)->links() }}
        </div>
    </div>
</div>
