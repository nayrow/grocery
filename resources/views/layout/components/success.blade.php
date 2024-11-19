@if (session('success')||session('error'))
    <div
        x-data="{ show: false, progress: 100 }"
        x-init="
        setTimeout(() => {
            show = true;

            let duration = 4000;
            let leaveAnimationDuration = 300;

            setTimeout(() => {
                show = false;

                setTimeout(() => {
                    progress = 100;
                }, leaveAnimationDuration);

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
        class="fixed inset-0 flex justify-center items-start z-50 w-full h-fit"
        x-transition:enter="ease-out duration-300"
        x-transition:enter-start="opacity-0 translate-y-2"
        x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="ease-in duration-300"
        x-transition:leave-start="opacity-100 translate-y-0"
        x-transition:leave-end="opacity-0 translate-y-2"
        x-cloak
    >
        <div @class([
          "w-fit bg-white shadow-lg rounded-lg p-4 transition-transform transform",
          "mt-24" => !request()->is('dashboard*'),
          "mt-4" => request()->is('dashboard*')
        ])>
            <div class="flex items-center">
                @if(session('success'))
                    <x-icons.check :size="6" class="bg-green-500 font-bold text-xl p-1 rounded-full" />
                @else
                    <x-icons.exclamation :size="6" class="bg-red-500 font-bold text-xl p-1 rounded-full" />
                @endif
                <div class="ml-3 text-black">
                    {{ session('success') }}
                    {{ session('error') }}
                </div>
            </div>
            <div class="relative mt-2 h-1 w-full bg-gray-200 rounded-full">
                <div @class([
                    "absolute h-full bg-green-500 rounded-full",
                    "bg-red-500"=> session('error'),
                    "bg-green-500"=> session('success')
                ])
                     :style="{ width: progress + '%' }"></div>
            </div>
        </div>
    </div>
@endif
