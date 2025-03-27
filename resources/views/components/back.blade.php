<button {{ $attributes->merge([
    '@click' => $click,
]) }}
    class="text-sm flex gap-1 items-center hover:text-black hover:font-semibold transition-transform duration-300 transform hover:scale-105">

    <svg class="text-gray-500" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
        class="lucide lucide-move-left">
        <path d="M6 8L2 12L6 16" />
        <path d="M2 12H22" />
    </svg>
    ត្រឡប់ក្រោយ
</button>
