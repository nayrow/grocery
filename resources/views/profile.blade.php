@extends('layout.layout')

@section('content')
    <section x-data="{
    isCreateHouseholdModalOpen:false,
    isConfirmRemoveMemberModalOpen:false,
    }" class="p-24 md:p-32 xl:p-48 min-h-screen bg-white">
        <h1
            class="text-3xl font-bold mb-4"
        >
            Welcome, {{$user->name}}
        </h1>

        @if($user->household)
            <p class="text-xl capitalize font-bold">
                Household
            </p>
            @if($user->household->user_id===$user->id)
                <form
                    action="{{route('households.update',['household'=>$user->household])}}"
                    method="POST"
                >
                    @csrf
                    @method('PUT')
                    <div class="mt-4 flex flex-col gap-1">
                        <label for="name">Name</label>
                        <div class="flex gap-4">
                            <input value="{{$user->household->name}}" type="text" name="name" id="name"
                                   class="block w-1/3 rounded-md border-0 p-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm/6">
                            <button
                                type="submit"
                                class="block w-20 rounded-md bg-red-600 px-3 py-2 text-center text-sm font-semibold text-white shadow-sm hover:bg-red-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-red-600"
                            >
                                Change
                            </button>
                        </div>
                    </div>
                </form>
            @else
                <div class="mt-4 flex flex-col gap-1">
                    <label for="name">Name</label>
                    <div class="flex gap-4">
                        <p
                            class="w-1/3 bg-transparent border-2 border-black outline-0 px-4 p-2 rounded-md"
                        >
                            {{$user->household->name}}
                        </p>
                    </div>
                </div>
            @endif

            @livewire('members-list',['users'=>$user->household->users->toArray(),'auth_user'=>$user->toArray(),'household'=>$user->household])
        @else
            <p class="mb-8">
                You currently don't belong to a house hold, do you want to
                <span @click="isCreateHouseholdModalOpen=!isCreateHouseholdModalOpen"
                      class="border-b border-blue-500  text-blue-500">
                    create</span>
                your own household?
            </p>
        @endif

        @if($user->invitations()->where('status','pending')->first())
            <p class="text-xl mb-2">
                Household invitations
            </p>
            @foreach($user->invitations as $invitation)
                @if($invitation->status==='pending')
                    <div class="flex items-center mb-4">
                        <p>
                            You have been invited to join {{$invitation->household->name}}
                        </p>
                        <form
                            action="{{route('households.accept-invitation',['household'=>$invitation->household,'user'=>$invitation->user])}}"
                            method="POST"
                        >
                            @csrf
                            @method('PUT')
                            <button
                                type="submit"
                                class="ml-1 text-green-500 underline rounded-md"
                            > Accept
                            </button>
                        </form>
                        <form
                            action="{{route('households.reject-invitation',['household'=>$invitation->household,'user'=>$invitation->user])}}"
                            method="POST"
                        >
                            @csrf
                            @method('PUT')
                            <button
                                type="submit"
                                class="ml-1 text-red-500 underline rounded-md"
                            > Reject
                            </button>
                        </form>
                    </div>
                @endif
            @endforeach
        @endif

        <div
            x-show="isCreateHouseholdModalOpen"
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
                        @click.away="isCreateHouseholdModalOpen=!isCreateHouseholdModalOpen"
                        x-transition:enter="ease-out duration-300"
                        x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                        x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                        x-transition:leave="ease-in duration-200"
                        x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                        x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                        class="relative transform overflow-hidden rounded-lg bg-white px-4 pb-4 pt-5 text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-sm sm:p-6">
                        <form action="{{route('households.store')}}" method="POST">
                            @csrf
                            <div class="space-y-12">
                                <h2 class="text-base/7 font-semibold text-gray-900">Create Household</h2>
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
@endsection
