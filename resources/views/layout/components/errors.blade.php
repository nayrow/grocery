@if ($errors->any())
    <div
        x-data="{ show: false, progress: 100 }"
        x-init="
        setTimeout(() => {
            show = true;

            let duration = 10000;
            let leaveAnimationDuration = 300;

            setTimeout(() => {
                show = false;
            }, duration);

            let decrement = 100 / duration * 10;
            let interval = setInterval(() => {
                if (progress > 0) {
                    progress -= decrement;
                } else {
                    clearInterval(interval);
                }
            }, 10);
        }, 200);
        "
        x-show="show"
        @click.away="show=false"
        x-transition:enter="ease-out duration-300"
        x-transition:enter-start="opacity-0 translate-y-2"
        x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="ease-in duration-300"
        x-transition:leave-start="opacity-100 translate-y-0"
        x-transition:leave-end="opacity-0 translate-y-2"
        class="fixed inset-0 flex justify-center items-start z-50 w-full h-fit"
        x-cloak
    >
        <div    @class([
                "w-fit bg-white shadow-lg rounded-lg p-4 transition-transform transform",
                "mt-24" => !request()->is('dashboard*'),
                "mt-4" => request()->is('dashboard*')
                ])>
            <div class="flex items-center">
                <div class="bg-white text-red-500 font-bold text-xl p-1 rounded-full">
                    <x-icons.exclamation class="h-6" />
                </div>
                <div class="ml-3">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li class="text-black">{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="relative mt-2 h-1 w-full bg-gray-200 rounded-full">
                <div class="absolute h-full bg-red-500 rounded-full" :style="{ width: progress + '%' }"></div>
            </div>
        </div>
    </div>
@endif
