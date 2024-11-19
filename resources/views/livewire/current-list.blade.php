<section
    x-data="{ items: $wire.entangle('items'),
     get checkedItemsCount() {
            return this.items.filter(item => item.checked).length;
        }
        }"
    class="p-24 md:p-32 xl:p-48 min-h-screen bg-mindaro">
    <div class="relative">
        <form
            action="{{route('items.updateCheckedItems')}}"
            method="POST"
            @submit.prevent="submitForm($event)"
            class="absolute left-1/2 -translate-x-1/2 -top-16 text-red-600 text-center font-bold text-2xl mb-4 cursor-pointer"
            x-show="checkedItemsCount"
            x-cloak
        >
            @csrf
            @method('PUT')
            <button type="submit">
                Remove checked item<span x-show="checkedItemsCount > 1" x-cloak>s</span>
            </button>
        </form>
    </div>

    <div class="flex w-full justify-center mb-12">
        <input
            wire:model.live="query"
            type="text"
            class="px-4 py-2 text-2xl bg-transparent outline-0 border-2 border-black rounded-xl w-full xl:w-1/2 2xl:w-1/4 placeholder-black"
            placeholder="Search Item..."
        >
    </div>

    <div x-show="!items.length && !wire.loading" x-cloak class="text-center text-xl mb-8">No items found</div>

    <div class="w-full xl:w-1/2 2xl:w-1/4 mx-auto font-bold">
        <h2 class="text-base">{{ __("Add a new item") }}</h2>
        <p class="mb-4 text-sm">{{ __("Enter the name of the item and it's weight") }}</p>
        <form
            @keydown.enter.prevent="submitForm($event)"
            action="{{ route('items.store') }}"
            method="POST"
            x-ref="form"
            class="w-full rounded-xl shadow-lg bg-cerise transition-all h-12 flex justify-between items-center px-4 mb-4"
        >
            @csrf
            <input
                id="name"
                type="text"
                class="border-0 outline-0 bg-transparent placeholder-black min-w-9"
                placeholder="..."
                name="name"
            >
            <div class="flex w-fit">
                <input
                    id="quantity"
                    class="border-0 outline-0 bg-transparent placeholder-black w-20 text-right"
                    type="number"
                    placeholder="..."
                    name="quantity"
                >
                <select
                    name="unit"
                    id="unit"
                    class="bg-transparent outline-0 text-right"
                >
                    <option value="kg">Kg</option>
                    <option value="l">L</option>
                </select>
            </div>
        </form>
        <template x-for="item in items" :key="item.id">
            <div
                class="w-full rounded-xl bg-cerise h-12 flex justify-between items-center px-4"
            >
                <p x-text="item.name"></p>
                <div class="flex items-center gap-2">
                    <p x-text="item.quantity + ' ' + item.unit"></p>
                    <div
                        @click="item.checked = !item.checked"
                        wire:click="checkItem(item.id)"
                        class="h-6 aspect-square rounded-md border-2 border-black cursor-pointer"
                        :class="{'bg-green-700': item.checked, 'bg-transparent': !item.checked}"
                    >
                    </div>
                </div>
            </div>
        </template>
    </div>
</section>



