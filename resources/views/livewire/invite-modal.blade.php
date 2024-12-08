<div
    x-show="isInviteModalOpen"
    x-cloak
    wire:ignore
    @click.away="isInviteModalOpen=false"
    x-data="{available_users: $wire.entangle('available_users')}"

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
                @click.away="isInviteModalOpen=!isInviteModalOpen"
                x-transition:enter="ease-out duration-300"
                x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave="ease-in duration-200"
                x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                class="relative transform overflow-hidden rounded-lg bg-white px-4 pb-4 pt-5 text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-sm sm:p-6">
                    <div class="space-y-12">
                        <h2 class="text-base/7 font-semibold text-gray-900">Invite Members</h2>
                        <input
                            wire:model.live="query"
                            type="text"
                            class="px-2 py-1 bg-transparent outline-0 border-2 border-black rounded-md w-full placeholder-black"
                            placeholder="User Email..."
                        >
                        <ul class="w-full">
                            <template x-for="available_user in available_users" :key="available_user.id">
                                <li
                                    class="flex justify-between w-full"
                                >
                                    <p x-text="available_user.email"></p>
                                    <button
                                        wire:click="sendInvitation(available_user.id)"
                                        class="block w-20 rounded-md bg-cool-gray px-3 py-2 text-center text-sm font-semibold text-black shadow-sm hover:bg-cool-gray/90 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-cool-gray"
                                    >
                                        Invite
                                    </button>
                                </li>
                            </template>
                        </ul>
                    </div>
            </div>
        </div>
    </div>
</div>
