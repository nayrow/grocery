@props(['size' => 5, 'color' => 'currentColor', 'class' => ''])
<svg {{ $attributes->merge(['class' => 'h-' . $size . ' w-' . $size . ' ' . $class]) }} xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 1000">
    <path d="M1000 500c0 276-224 500-500 500S0 776 0 500 224 0 500 0s500 224 500 500zM755 620h-29c-42 118-66 130-129 130H470c-34 0-54-17-54-52V518c164 0 156-7 174 84h33c-1-31-2-76-2-105 0-28 1-72 4-109h-33c-18 97-9 88-175 89V263c0-10 3-13 13-13h179c40 0 59 26 79 120h31l10-170c-79 8-134 8-230 8-97 0-179-1-270-5v39c72 8 80 18 81 50 2 44 3 132 3 206 0 75 0 164-2 209-2 32-9 42-81 50v39c42-3 150-4 248-4 35 0 102-2 257 4l20-176z"></path>
</svg>