<div class="max-w-[420px]  mx-auto  p-4" x-data="{
    selectedOtpOption: 'phone',
    submitSendCode() {
        $wire.submitSendOtpOption(this.selectedOtpOption);
    }
}" >
    <div class="flex justify-center text-sm text-center min-w-[420px] py-12 px-4 border shadow-sm rounded-2xl items-center flex-col gap-12">

        <div class="flex flex-col gap-4 justify-center items-center w-full">
            {{-- logo --}}
            <div class="max-w-40">
                <img class="w-full" src="{{ asset('asset/kess_api_logo.jpg') }}" alt="">
            </div>

            {{-- header title --}}
            <h2 class="text-2xl font-sans">Enter verify code</h2>

            {{-- description --}}
            <p class=" text-gray-500">We need to send OTP to authenticate your withdrawal request.</p>
        </div>

        {{-- info transaction --}}
        <div class="w-full space-y-4">
            {{-- amount --}}
            <div class="flex justify-between">
                <p class="text-gray-500">Amount</p>
                <strong>$1.00</strong>
            </div>
            <hr>
            {{-- to account --}}
            <div class="flex justify-between">
                <p class="text-gray-500">To Account</p>
                <strong>7000****850</strong>
            </div>
        </div>

        {{-- send otp options select --}}
        <div class="w-full">

            {{-- vai phone --}}
            <x-send-otp-optios-card title="096******95" name="phone" description="Send OTP via phone number">
                <x-slot:icon>
                    <i data-lucide="message-square-text"></i>
                </x-slot:icon>
            </x-send-otp-optios-card>

            {{-- vai email --}}
            <x-send-otp-optios-card title="******758@gmail.com" name="email" description="Send OTP via email">
                <x-slot:icon>
                    <i data-lucide="mail"></i>
                </x-slot:icon>
            </x-send-otp-optios-card>
        </div>

        {{-- button submit send --}}
        <button type="button" @click="submitSendCode()" class=" w-full rounded-full uppercase font-semibold hover:bg-gray-900 duration-200 items-center  py-4 bg-[#394553] text-white">
            send
        </button>
        
    </div>
</div>
