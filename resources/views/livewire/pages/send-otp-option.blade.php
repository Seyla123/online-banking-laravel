<div class="max-w-[420px] mx-auto p-4" x-data="{
    selectedOtpOption: 'phone',
    submitSendCode() {
        $wire.submitSendOtpOption(this.selectedOtpOption);
    }
}">
    <div class="flex justify-center text-sm text-center min-w-[420px] py-12 px-4 border shadow-sm rounded-2xl items-center flex-col gap-12">

        <div class="flex flex-col gap-4 justify-center items-center w-full">
            {{-- logo --}}
            <div class="max-w-40">
                <img class="w-full" src="{{ asset('asset/kess_api_logo.jpg') }}" alt="">
            </div>

            {{-- header title --}}
            <h2 class="text-2xl">{{ __('enter_verify_code') }}</h2>

            {{-- description --}}
            <p class="text-gray-500">{{ __('otp_authentication_description') }}</p>
        </div>

        {{-- info transaction --}}
        <div class="w-full space-y-4">
            {{-- amount --}}
            <div class="flex justify-between">
                <p class="text-gray-500">{{ __('amount') }}</p>
                <strong>${{ $amount }}</strong>
            </div>
            <hr>
            {{-- to account --}}
            <div class="flex justify-between">
                <p class="text-gray-500">{{ __('to_account') }}</p>
                <strong>{{ $walletNumber }}</strong>
            </div>
        </div>

        {{-- send otp options select --}}
        <div class="w-full">

            {{-- via phone --}}
            <x-send-otp-optios-card :title="$phone" name="phone" :description="__('send_otp_via_phone')">
                <x-slot:icon>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="lucide lucide-message-square-text-icon lucide-message-square-text">
                        <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z" />
                        <path d="M13 8H7" />
                        <path d="M17 12H7" />
                    </svg>
                </x-slot:icon>
            </x-send-otp-optios-card>

            {{-- via email --}}
            <x-send-otp-optios-card :title="$email" name="email" :description="__('send_otp_via_email')">
                <x-slot:icon>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="lucide lucide-mail-icon lucide-mail">
                        <rect width="20" height="16" x="2" y="4" rx="2" />
                        <path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7" />
                    </svg>
                </x-slot:icon>
            </x-send-otp-optios-card>
        </div>

        {{-- button submit send --}}
        <button type="button" @click="submitSendCode()"
            class="w-full rounded-full uppercase font-semibold hover:bg-gray-900 duration-200 items-center py-4 bg-[#394553] text-white">
            {{ __('send_button') }}
        </button>

    </div>
</div>
