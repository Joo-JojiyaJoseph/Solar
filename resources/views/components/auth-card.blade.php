<link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
<div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-green-200">
    <div>
        {{ $logo }}
    </div>

    <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-red-400 shadow-md overflow-hidden sm:rounded-lg">
        {{ $slot }}
    </div>
</div>
