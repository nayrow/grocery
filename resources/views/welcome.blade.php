@extends('layout.layout')

@section('content')
    <section class="p-48 bg-mindaro h-screen">
        <h1 class="text-center text-6xl font-extrabold mb-24">
            Welcome to THE grocery list
        </h1>
        @if(Auth::user())
            <div class="w-full flex justify-center">
                <button class="px-12 py-4 text-2xl font-bold bg-cerise rounded-md">
                    Dashboard
                </button>
            </div>
        @else
            <p class="text-center text-2xl font-bold mb-4">
                Please login to continue
            </p>
            <div class="w-full flex justify-center">
                <button class="px-12 py-4 text-2xl font-bold bg-cerise rounded-md">
                    Login
                </button>
            </div>
        @endif
    </section>
@endsection
