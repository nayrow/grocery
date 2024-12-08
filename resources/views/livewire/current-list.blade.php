<section
    x-data="{ items: $wire.entangle('items'),
    addItem:false,
     get checkedItemsCount() {
            return this.items.filter(item => item.checked).length;
        }
        }"
    class="p-12 md:p-24 xl:p-48 min-h-screen">
    <div class="flex w-1/3 mx-auto justify-center mb-12">
        <input
            wire:model.live="query"
            type="text"
            class="block w-full rounded-md border-0 p-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm/6"
            placeholder="Search Item..."
        >
    </div>

    <div class="px-4 sm:px-6 lg:px-8 mx-auto w-full lg:w-1/2">
        <div class="sm:flex sm:justify-between mx-auto w-full sm:items-center">
            <div class="sm:flex-auto">
                <h1 class="text-base font-semibold text-gray-900">Shopping List</h1>
            </div>
            <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none flex gap-4">
                <form
                    action="{{route('items.updateCheckedItems')}}"
                    method="POST"
                    @submit.prevent="submitForm($event)"
                    x-show="checkedItemsCount"
                    x-cloak
                >
                    @csrf
                    @method('PUT')
                    <button type="submit"
                            class="block rounded-md bg-red-600 px-3 py-2 text-center text-sm font-semibold text-white shadow-sm hover:bg-red-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-red-600">
                        Remove Checked Items
                    </button>
                </form>
                <button type="button"
                        @click="addItem=true"
                        class="block rounded-md bg-indigo-600 px-3 py-2 text-center text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                    Add Item
                </button>
            </div>
        </div>
        <div x-show="!items.length && !wire.loading" x-cloak class="text-center text-xl mb-8">No items found</div>
        <div
            x-show="items.length"
            class="flex justify-center w-full">
            <div class="mx-4 mt-10 ring-1 w-full ring-gray-300 sm:mx-0 sm:rounded-lg">
                <table class="min-w-full divide-y divide-gray-300">
                    <thead>
                    <tr>
                        <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">
                            Item Name
                        </th>
                        <th scope="col"
                            class="hidden px-3 py-3.5 text-left text-sm font-semibold text-gray-900 sm:table-cell">
                            Quantity
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    <template x-for="item in items" :key="item.id">
                        <tr>
                            <td class="relative py-4 pl-4 pr-3 text-sm sm:pl-6">
                                <div class="font-medium text-gray-900 capitalize" x-text="item.name"></div>
                                <div class="mt-1 text-gray-500 block sm:hidden">
                                    <span x-text="item.quantity"></span>
                                </div>
                            </td>
                            <td x-text="item.quantity" class="hidden px-3 py-3.5 text-sm text-gray-500 sm:table-cell">
                            </td>

                            <td class="relative py-3.5 pl-3 pr-4 text-right text-sm font-medium sm:pr-6">
                                <div class="flex gap-4 justify-end">
                                    <button type="button"
                                            @click="item.checked = !item.checked; $wire.checkItem(item.id)"
                                            :class="
                                        [
                                            'inline-flex items-center rounded-md bg-gray-200 px-2.5 py-1.5 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray hover:bg-gray-300',
                                            item.checked ? 'bg-green-500 hover:bg-green-400 text-gray-900' : ''
                                        ]
                                        "
                                    >
                                        <span class="sr-only">Check</span>
                                        <span x-show="!item.checked">Mark as checked</span>
                                        <span x-show="item.checked">Checked</span>
                                    </button>
                                    <form :action="`items/${item.id}`+
                                   " method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="block rounded-md bg-red-600 px-3 py-2 text-center text-sm font-semibold text-white shadow-sm hover:bg-red-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-red-600">
                                            <span class="sr-only">Check</span>
                                            <span>Remove</span>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    </template>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div
        x-show="addItem"
        x-cloak
        class="relative z-10" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div
            x-transition:enter="ease-out duration-300"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="ease-in duration-200"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            class="fixed inset-0 bg-gray-500/75 transition-opacity" aria-hidden="true"></div>

        <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
            <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                <div
                    @click.away="addItem=!addItem"
                    x-transition:enter="ease-out duration-300"
                    x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                    x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                    x-transition:leave="ease-in duration-200"
                    x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                    x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                    class="relative transform overflow-hidden rounded-lg bg-white px-4 pb-4 pt-5 text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-sm sm:p-6">
                    <form action="{{route('items.store')}}" method="POST">
                        @csrf
                        <div class="space-y-12">
                            <h2 class="text-base/7 font-semibold text-gray-900">Add Item</h2>
                            <div class="mt-5 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                                <div class="sm:col-span-6">
                                    <label for="name" class="block text-sm/6 font-medium text-gray-900">Name</label>
                                    <div class="mt-2">
                                        <div
                                            class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
                                            <input type="text" name="name" id="name" autocomplete="name"
                                                   class="block flex-1 border-0 bg-transparent py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm/6"
                                            >
                                        </div>
                                    </div>
                                </div>
                                <div class="sm:col-span-6">
                                    <label for="quantity"
                                           class="block text-sm/6 font-medium text-gray-900">Quantity</label>
                                    <div class="mt-2">
                                        <div
                                            class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
                                            <input type="text" name="quantity" id="quantity" autocomplete="quantity"
                                                   class="block flex-1 border-0 bg-transparent py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm/6"
                                            >
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-6 flex items-center justify-end gap-x-6">
                                <button type="button" class="text-sm/6 font-semibold text-gray-900">Cancel
                                </button>
                                <button type="submit"
                                        class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                                    Save
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>



