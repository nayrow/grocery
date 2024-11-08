@extends('layout.layout')

@section('content')
    <section class="p-24 bg-mindaro h-screen">
        <h1 class="text-center text-6xl font-extrabold mb-24">
            Welcome to THE grocery list
        </h1>
        @if(Auth::user())
            <div class="w-full flex justify-center">
                <a href="{{route('list')}}" class="px-12 py-4 text-2xl font-bold bg-cerise rounded-md">
                    Dashboard
                </a>
            </div>
        @else
            <div
                x-data="{
                isLoginFormOpen : false,
                isRegisterFormOpen : false,
                switchForms() {
                    this.isLoginFormOpen = !this.isLoginFormOpen
                    this.isRegisterFormOpen = !this.isRegisterFormOpen
                }
                }"
            >
                <p class="text-center text-2xl font-bold mb-4">
                    Please login to continue
                </p>
                <p
                    x-show="isLoginFormOpen"
                    x-cloak
                    class="text-center font-bold opacity-75 mb-4">
                    If you don't have an account,
                    <button @click="switchForms" class="underline text-blue-700">register</button>
                </p>
                <p
                    x-show="isRegisterFormOpen"
                    x-cloak
                    class="text-center font-bold opacity-75 mb-4">
                    If you have an account,
                    <button @click="switchForms" class="underline text-blue-700">login</button>
                </p>
                <form
                    method="POST"
                    action="{{ route('login') }}"
                    x-show="isLoginFormOpen"
                    x-transition:enter="transition ease-in duration-500 transform"
                    x-transition:enter-start="opacity-0 scale-90"
                    x-transition:enter-end="opacity-100 scale-100"
                    x-cloak
                    class="text-center my-8"
                >
                    @csrf
                    <div class="flex flex-col items-start mx-auto w-1/4 gap-2 mb-4">
                        <label for="email" class="text-2xl">Email</label>
                        <input
                            type="email"
                            id="email"
                            name="email"
                            class="p-4 w-full rounded-md border-2 border-black outline-0 bg-transparent"
                        >
                    </div>
                    <div class="flex flex-col items-start mx-auto w-1/4 gap-2 mb-8">
                        <label for="password" class="text-2xl">Password</label>
                        <input
                            type="password"
                            id="password"
                            name="password"
                            class="p-4 w-full rounded-md border-2 border-black outline-0 bg-transparent"
                        >
                    </div>
                    <button
                        type="submit"
                        class="px-12 py-4 text-2xl font-bold bg-cerise rounded-md"
                    >
                        Login
                    </button>
                </form>
                <form
                    method="POST"
                    action="{{ route('register') }}"
                    x-show="isRegisterFormOpen"
                    x-transition:enter="transition ease-in duration-500 transform"
                    x-transition:enter-start="opacity-0 scale-90"
                    x-transition:enter-end="opacity-100 scale-100"
                    x-cloak
                    class="text-center my-8"
                >
                    @csrf
                    <div class="flex flex-col items-start mx-auto w-1/4 gap-2 mb-4">
                        <label for="name" class="text-2xl">Name</label>
                        <input
                            type="text"
                            id="name"
                            name="name"
                            class="p-4 w-full rounded-md border-2 border-black outline-0 bg-transparent"
                        >
                    </div>
                    <div class="flex flex-col items-start mx-auto w-1/4 gap-2 mb-4">
                        <label for="email" class="text-2xl">Email</label>
                        <input
                            type="email"
                            id="email"
                            name="email"
                            class="p-4 w-full rounded-md border-2 border-black outline-0 bg-transparent"
                        >
                    </div>
                    <div class="flex flex-col items-start mx-auto w-1/4 gap-2 mb-8">
                        <label for="password" class="text-2xl">Password</label>
                        <input
                            type="password"
                            id="password"
                            name="password"
                            class="p-4 w-full rounded-md border-2 border-black outline-0 bg-transparent"
                        >
                    </div>
                    <div class="flex flex-col items-start mx-auto w-1/4 gap-2 mb-8">
                        <label for="password_confirmation" class="text-2xl">Confirm Password</label>
                        <input
                            type="password"
                            id="password_confirmation"
                            name="password_confirmation"
                            class="p-4 w-full rounded-md border-2 border-black outline-0 bg-transparent"
                        >
                    </div>
                    <button
                        type="submit"
                        class="px-12 py-4 text-2xl font-bold bg-cerise rounded-md"
                    >
                        Register
                    </button>
                </form>
                <div class="w-full flex justify-center">
                    <button
                        @click="isLoginFormOpen=true"
                        x-show="!isLoginFormOpen && !isRegisterFormOpen"
                        class="px-12 py-4 text-2xl font-bold bg-cerise rounded-md"
                    >
                        Login
                    </button>
                </div>
            </div>
        @endif
    </section>
@endsection
