<section
    x-data="{ items: $wire.entangle('items'),
     get checkedItemsCount() {
            return this.items.filter(item => item.checked).length;
        }
        }"
    class="p-48 min-h-screen bg-mindaro">

    <!-- Search Input -->
    <div class="flex w-full justify-center mb-12">
        <input
            wire:model.live="query"
            type="text"
            class="px-4 py-2 text-2xl bg-transparent outline-0 border-2 border-black rounded-xl w-1/4 placeholder-black"
            placeholder="Search Item..."
        >
    </div>

    <form
        action="{{route('items.destroy')}}"
        method="POST"
        @submit.prevent="submitForm($event)"
        class="text-red-600 text-center font-bold text-2xl mb-4 cursor-pointer"
        x-show="checkedItemsCount"
    >
        @csrf
        @method('DELETE')
        <button type="submit">
            Remove checked item<span x-show="checkedItemsCount > 1">s</span>
        </button>
    </form>

    <div x-show="!items.length && !wire.loading" class="text-center text-xl">No items found</div>

    <div class="w-1/4 mx-auto text-2xl font-bold space-y-4">
        <form
            @keydown.enter.prevent="submitForm($event)"
            action="{{ route('items.store') }}"
            method="POST"
            x-ref="form"
            class="w-full rounded-xl bg-cerise h-12 flex justify-between items-center px-4"
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
                <select name="grammage" id="grammage" class="bg-transparent outline-0 text-right">
                    <option value="kg">Kg</option>
                    <option value="g">g</option>
                    <option value="piece">Pc</option>
                </select>
            </div>
        </form>
        <template x-for="item in items" :key="item.id">
            <div
                class="w-full rounded-xl bg-cerise h-12 flex justify-between items-center px-4"
            >
                <p x-text="item.name"></p>
                <div class="flex gap-2">
                    <p x-text="item.quantity + ' ' + item.grammage + (item.quantity > 1 && item.grammage == 'piece' ? 's' : '')"></p>
                    <div
                        @click="item.checked = !item.checked"
                        wire:click="checkItem(item.id)"
                        class="h-8 aspect-square rounded-md border-2 border-black cursor-pointer"
                        :class="{'bg-green-700': item.checked, 'bg-transparent': !item.checked}"
                    >
                    </div>
                </div>
            </div>
        </template>
    </div>
</section>



