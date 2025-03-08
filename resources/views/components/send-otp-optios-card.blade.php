@props(['title', 'description', 'icon', 'name' => ''])
<div @click="selectedOtpOption = '{{ $name }}'"
class=" cursor-pointer flex justify-between gap-6 items-center  px-4 py-3 lg:py-4  min-h-[50px] xl:min-h-[80px]  transition duration-150 ease-in-out "
    x-bind:class="selectedOtpOption == '{{ $name }}' ? 'bg-[#2196F3]/10' : ''">
    <div class="max-w-8  rounded-lg ">
        {{ $icon }}
    </div>
    {{-- info --}}
    <div class="flex flex-col justify-start items-start w-full">
        <strong class="text-sm lg:text-md capitalize">{{ $title }}</strong>
        <p class="text-xs text-gray-500">{{ $description }}</p>
    </div>
    <button x-show="selectedOtpOption == '{{ $name }}'"
        class=" text-sm whitespace-nowrap bg-[#2196F3]/10 hover:bg-[#2196F3]/20 font-semibold text-[#2ba0ff] p-2 rounded-full flex items-center">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
            class="lucide lucide-check">
            <polyline points="20 6 9 17 4 12"></polyline>
        </svg>
    </button>
</div>
