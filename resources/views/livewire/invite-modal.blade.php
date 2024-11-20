<div
    x-data="{available_users: $wire.entangle('available_users')}"
    x-show="isInviteModalOpen"
    x-cloak
    wire:ignore
    @click.away="isInviteModalOpen=false"
    class="w-72"
>
    <div class="relative w-full">
        <input
            wire:model.live="query"
            type="text"
            class="px-2 py-1 bg-transparent outline-0 border-2 border-black rounded-md w-full placeholder-black"
            placeholder="User Email..."
        >
        <ul class="absolute w-full -bottom-10">
            <template x-for="available_user in available_users" :key="available_user.id">
                <li
                    class="flex justify-between w-full"
                >
                    <p x-text="available_user.email"></p>
                    <button
                        wire:click="sendInvitation(available_user.id)"
                    >
                        Invite
                    </button>
                </li>
            </template>
        </ul>
    </div>
</div>
