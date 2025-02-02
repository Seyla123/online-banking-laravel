<div class="max-w-[420px]  mx-auto  p-4" x-data="{
    otpCode: '',
    timeLeft: 60,
    submitCode() {
        if (this.otpCode.length == 6) {
            $wire.submitVerifyCode(this.otpCode);
            this.otpCode = '';
        }
    },
    startTimer() {
        if (this.timeLeft > 0) {
            setTimeout(() => {
                this.timeLeft--;
                this.startTimer();
            }, 1000);
        }
    }

}" x-init="startTimer">
    <div class="flex justify-center text-sm text-center p-12 border shadow-sm rounded-2xl items-center flex-col gap-12">

        <div class="flex flex-col gap-4 justify-center items-center w-full">
            {{-- logo --}}
            <div class="max-w-40">
                <img class="w-full" src="{{ asset('asset/kess_api_logo.jpg') }}" alt="">
            </div>

            {{-- header title --}}
            <h2 class="text-2xl font-sans">Enter verify code</h2>

            {{-- description --}}
            <p class=" text-gray-500">We have sent you the verification code to this phone number 096*****86 for the
                withdrawal verification.</p>
        </div>

        {{-- input otp code --}}
        <div class="flex flex-col gap-2 justify-start items-start w-full">
            <div
                class="flex gap-2 items-center  focus:border-indigo-500 focus:ring-indigo-500  border-b-[2px] {{ $errors->has('otpCode') ? 'border-red-500' : 'border-gray-300' }} ">
                <p class="whitespace-nowrap">Code is : </p>
                <input class="w-full focus:outline-none  focus:ring-0  border-none shadow-none" type="number"
                    x-model="otpCode" placeholder="បញ្ជូលលេខកូដ" @input="submitCode()" />
            </div>
            @error('otpCode')
                <span class="text-red-400">លេខកូដមិនត្រឹមត្រូវទេ! {{$message}}</span>
            @enderror
        </div>
        {{-- resend otp --}}
        <div class="flex flex-col gap-4 justify-center items-center w-full">
            <p>Don't receive the code?</p>
            <button :disable="timeLeft > 0" :class="timeLeft > 0 ? 'text-gray-300' : ''"
                x-text="
            timeLeft > 0 ? 'Resend Code ' + timeLeft + 's' : 'Resend Code'"></button>
        </div>
    </div>
</div>
