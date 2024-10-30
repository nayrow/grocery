@props(['size' => 5, 'color' => 'currentColor', 'class' => ''])
<svg {{ $attributes->merge(['class' => 'h-' . $size . ' w-' . $size . ' ' . $class]) }} viewBox="0 0 1000 1000" xmlns="http://www.w3.org/2000/svg">
    <path d="M500 1000C223.858 1000 0 776.142 0 500S223.858 0 500 0s500 223.858 500 500-223.858 500-500 500zm193-530c-.167-.323.34-3.107 0-7v-8c.34-12.657-6.753-17.72-20-18h-44v34h13c3.971.448 6.251 2.726 6 7v66h-19v34h86v-34h-19v-21c-.381-25.23 12.284-41.934 38-42 6.2.066 10 .825 10 1v-46c0-.49-2.786-.997-6-1-21.104-.25-38.835 15.442-45 35zm125 0c-.167-.323.34-3.107 0-7v-8c.34-12.657-6.753-17.72-20-18h-44v34h13c3.971.448 6.251 2.726 6 7v66h-19v34h86v-34h-19v-21c-.381-25.23 12.284-41.934 38-42 6.2.066 10 .825 10 1v-46c0-.49-2.786-.997-6-1-20.85-.25-38.581 15.442-45 35zm-200 32c0-39.157-23.633-68-66-68-45.048 0-73 32.133-73 73 0 37.82 27.19 74 78 74 37.622 0 60.238-19.735 60-20l-17-32c-.042-.373-18.846 13.036-40 13-14.676.036-28.907-7.807-32-26h89c-.27-.024 1-9.639 1-14zm-89-12c2.516-11.012 9.057-21 22-21 10.704 0 18 9.732 18 21h-40zm-50-53h-75v34h13l-16 51c-3.235 8.492-3.994 18.654-4 19h-1c-.006-.346-.765-10.508-4-19l-16-51h13v-34h-75v34h16l39 107h55l39-107h16v-34zm-177 0H197v-7c.392-13.434 13.873-13.688 21-14 7.627.313 11.188 1.074 11 1v-37c.188.015-6.934-1-17-1-21.476 0-61.922 6.092-62 52v6h-19v34h19v73h-18v34h86v-34h-21v-73h58v73h-18v34h83v-34h-18V437zm-24-14c12.703 0 23-10.297 23-23s-10.297-23-23-23-23 10.297-23 23 10.297 23 23 23z"></path>
</svg>