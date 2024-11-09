<section
    x-data="{ items: $wire.entangle('items')}"
    class="p-48 min-h-screen bg-mindaro">

    <div class="flex w-full justify-center mb-12">
        <input
            wire:model.live="query"
            type="text"
            class="px-4 py-2 text-2xl bg-transparent outline-0 border-2 border-black rounded-xl w-1/4 placeholder-black"
            placeholder="Search Item..."
        >
    </div>

    <div x-show="!items.length && !wire.loading" x-cloak class="text-center text-xl mb-8">No items found</div>

    <div class="w-1/4 mx-auto text-2xl font-bold space-y-4">
        <template x-for="item in items" :key="item.id">
            <div class="flex gap-2 relative">
                <div
                    x-data="{showTooltip: false}"
                    class="relative"
                >
                    <x-icons.exclamation-circle
                        :size="7"
                        class="absolute h-6 text-cerise top-1/2 -translate-y-1/2 -left-8"
                        x-show="item.quantity == 0"
                        @mouseenter="showTooltip = true"
                        @mouseleave="showTooltip = false"
                    />

                    <div
                        x-show="showTooltip"
                        class="absolute bottom-3/4 mb-1 p-1 text-black text-center text-base whitespace-nowrap rounded-md -left-14"
                        x-transition:enter="transition ease-out duration-300"
                        x-transition:enter-start="opacity-0 transform scale-90"
                        x-transition:enter-end="opacity-100 transform scale-100"
                        x-transition:leave="transition ease-in duration-300"
                        x-transition:leave-start="opacity-100 transform scale-100"
                        x-transition:leave-end="opacity-0 transform scale-90"
                    >
                        Low stock
                    </div>
                </div>
                <div
                    class="w-full rounded-xl bg-cerise h-12 flex justify-between items-center px-4"
                >
                    <p x-text="item.name"></p>
                    <div class="flex gap-2">
                        <form :action="`items/${item.id}/updateQuantity`" method="POST">
                            @csrf
                            @method('PUT')
                            <input
                                type="text"
                                x-model="item.quantity"
                                name="quantity"
                                class="border-0 outline-0 bg-transparent placeholder-black w-20 text-right"
                            >
                        </form>
                        <p x-text="item.unit" class="w-6 capitalize"></p>
                    </div>
                </div>
            </div>
        </template>
    </div>
</section>



