<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2 bg-[#394553] border border-transparent rounded-lg font-semibold  text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none  transition ease-in-out duration-150 ']) }}>
    {{ $slot }}
</button>


