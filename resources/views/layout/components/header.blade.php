<nav
    x-data="{
    isProfileDropDownOpen: false,
    }"
    class="bg-transparent fixed py-8 px-24 w-full flex items-center justify-between"
>
    <img src="{{asset('apple.svg')}}" alt="" class="h-12">
    <div class="relative">
        <button @click="isProfileDropDownOpen=!isProfileDropDownOpen"
                class="text-xl font-bold">{{Auth::user()->name}}</button>
        <div
            x-show="isProfileDropDownOpen"
            x-cloak
            class="absolute w-full flex flex-col items-center top-full left-1/2 -translate-x-1/2">
            <ul class="py-2 w-fit px-4 bg-white rounded-md mt-2 text-center space-y-2">
                <li class="font-bold whitespace-nowrap">
                    My account
                </li>
                <hr class="border-black"/>
                <li>
                    <form
                        action="{{route('logout')}}"
                        method="POST"
                    >
                        @csrf
                        <button type="submit" class="font-bold">Logout</button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</nav>
