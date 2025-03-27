<div class="max-w-md mx-auto p-4 w-full">
    <div class="bg-white shadow-xl rounded-2xl overflow-hidden">
        <!-- Header with decorative accent -->
        <div class="bg-green-600 py-4 px-6">
            <div class="flex justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-white" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
            <h1 class="text-center text-2xl font-bold text-white mt-2">
                {{ __('payment_success') }}
            </h1>
        </div>

        <!-- Body Content -->
        <div class="p-6">
            <!-- Transaction Summary -->
            <div class="mb-8">
                <h2 class="text-lg font-semibold text-gray-800 mb-4 border-b pb-2">
                    {{ __('transaction_details') }}
                </h2>

                <div class="space-y-3 text-sm">
                    <div class="flex justify-between">
                        <span class="text-gray-600 ">{{ __('customer_name') }}</span>
                        <span class="text-gray-900 font-medium">{{ $transaction->user->name }}</span>
                    </div>

                    <div class="flex justify-between items-center">
                        <span class="text-gray-600">{{ __('transaction_id') }}</span>
                        <span class="text-xs text-gray-600">{{ $transaction->reference_code }}</span>
                    </div>

                    <div class="flex justify-between">
                        <span class="text-gray-600">{{ __('date_time') }}</span>
                        <span>{{ $transaction->created_at->format('d M Y, h:i A') }}</span>
                    </div>
                </div>
            </div>

            <!-- Amount Highlight -->
            <div class="bg-gray-50 rounded-lg p-4 mb-6">
                <div class="flex justify-between items-center">
                    <span class="text-gray-600">{{ __('amount') }}</span>
                    <span class="text-2xl font-bold text-green-600">${{ number_format($transaction->amount, 2) }}</span>
                </div>
            </div>

            <!-- Payment Method (if available) -->
            @if ($paymentMethod)
                <div class="mb-6">
                    <h3 class="text-sm font-medium text-gray-500 mb-1">{{ __('payment_method') }}</h3>
                    <div class="flex items-center">
                        <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm uppercase">
                            {{ $paymentMethod }}
                        </span>
                    </div>
                </div>
            @endif

            <!-- Actions -->
            <div class="flex flex-col space-y-3 mt-8">
                <a href="{{ route('withdraw') }}"
                    class="bg-gray-900 hover:bg-gray-800 text-white py-3 px-6 rounded-lg text-center font-medium transition-colors">
                    {{ __('finish_button') }}
                </a>
                <a href="#" class="text-center text-gray-600 hover:text-gray-900 text-sm underline">
                    {{ __('download_receipt') }}
                </a>
            </div>
        </div>

        <!-- Footer -->
        <div class="bg-gray-50 px-6 py-4 text-center text-xs text-gray-500">
            {{ __('footer_note') }}
        </div>
    </div>
</div>
