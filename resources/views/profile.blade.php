@extends('layout.layout')

@section('content')
    <section x-data="{isCreateHouseholdModalOpen:false}" class="p-24 md:p-32 xl:p-48 min-h-screen bg-mindaro">
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
                                   class="w-1/3 bg-transparent border-2 border-black outline-0 px-4 p-2 rounded-md">
                            <button
                                type="submit"
                                class="px-6 py-2 font-bold bg-cerise text-black rounded-md"
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
            class="fixed inset-0 bg-black bg-opacity-50 z-40 h-screen w-screen"
        >
            <div
                @click.away="isCreateHouseholdModalOpen=false"
                class="w-[24rem] md:w-[32rem] lg:w-[40rem] h-fit py-8 px-16 rounded-xl fixed shadow-sm shadow-gray bg-white dark:bg-black text-dark dark:text-white  left-1/2 top-1/2 z-50 transform -translate-x-1/2 -translate-y-1/2"
            >
                <form
                    action="{{route('households.store')}}"
                    method="POST"
                    class="flex flex-col items-end w-full"
                >
                    @csrf
                    <div class="w-full h-full flex justify-between items-center mb-8">
                        <h1 class="text-2xl font-bold">
                            Create your Household
                        </h1>
                        <button
                            type="button"
                            @click.prevent="isCreateHouseholdModalOpen = false"
                        >
                            <x-icons.x :size="12" class="bg-cerise text-black rounded-full p-3"/>
                        </button>
                    </div>
                    <div class="mb-8 w-full">
                        <label for="name">
                            Name
                        </label>
                        <input type="text" name="name" id="name"
                               class="w-full outline-0 px-4 py-2 rounded-md bg-white text-black">
                    </div>
                    <button
                        type="submit"
                        class="px-6 py-2 font-bold bg-cerise text-black rounded-md"
                    >
                        Create
                    </button>
                </form>
            </div>
        </div>
    </section>
@endsection
