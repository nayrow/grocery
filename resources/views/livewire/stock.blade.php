<section
    x-data="{ items: $wire.entangle('items')}"
    class="p-24 md:p-32 xl:p-48 min-h-screen bg-white">

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
                <h1 class="text-base font-semibold text-gray-900">Household Stock</h1>
            </div>
            <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none flex gap-4">
                <a      href="{{route('list')}}"
                        @click="addItem=true"
                        class="block rounded-md bg-indigo-600 px-3 py-2 text-center text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                    Add Item
                </a>
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
                                    <form :action="`items/${item.id}`"
                                          method="POST">
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
</section>



