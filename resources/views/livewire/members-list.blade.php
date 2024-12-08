@if($users)
    <div
        x-data="{
        isInviteModalOpen: false,
        }"
    >
        <div>
            <div
                class="flex gap-4 mt-8 mb-4"
            >
                <p class="capitalize font-bold mt-4 w-1/3">
                    Members
                </p>
                <button
                    @click="isInviteModalOpen=!isInviteModalOpen"
                    class="block w-20 rounded-md bg-cool-gray px-3 py-2 text-center text-sm font-semibold text-black shadow-sm hover:bg-cool-gray/90 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-cool-gray"
                >
                    Invite
                </button>
            </div>
            @livewire('invite-modal')
        </div>
        <ul class="flex flex-col gap-2 w-full">
            @foreach($users as $user)
                @if($user['id']!==$auth_user['id'])
                    <li class="flex items-center gap-6 mb-2">
                        <p class="w-1/3">{{$user['name']}}</p>
                        @if($auth_user['id']===$household->user_id)
                            <button
                                wire:click="removeUser({{$user['id']}})"
                                class="underline text-red-500"
                            >
                                Remove
                            </button>
                        @endif
                    </li>
                @endif
            @endforeach
        </ul>
    </div>
@endif

