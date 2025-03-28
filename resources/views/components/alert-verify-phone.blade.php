@props(['phone'])
<div
    class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 p-5 bg-blue-50/50 border-l-4 border-blue-500 rounded-lg shadow-sm">
    <div class="flex items-center gap-3">
        <div class="bg-blue-100 p-2 rounded-full">
            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
            </svg>
        </div>
        <div class="text-start">
            <p class="text-sm text-gray-800">
                <span class="font-semibold text-blue-600">{{ __('note') }}:</span>
                {{ __('otp_description') }}
                <span class="font-medium text-blue-600 whitespace-nowrap">
                    +855 {{ preg_replace('/(\d{2})(\d{3})(\d{4})/', '$1 $2 $3', $phone) }}
                </span>
                {{ __('.') }}
            </p>
        </div>
    </div>
    <a
        class="cursor-pointer flex items-center gap-1.5 px-3 py-2 bg-white text-blue-600 font-medium text-sm rounded-md hover:bg-blue-50 transition-colors shadow-sm border border-blue-100">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d=" M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828
            15H9v-2.828l8.586-8.586z" />
        </svg>
        <span>{{ __('edit') }}</span>
    </a>
</div>
