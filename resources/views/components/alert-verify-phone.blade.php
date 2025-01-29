@props(['phone'])
<div
    class="flex justify-between items-center min-h-24 gap-2 bg-[#2196F3]/10 px-4 py-6 border-[#2196F3]/15 
    border-[1px] rounded-lg">
    <img class="w-6" src="{{ asset('asset/warning.svg') }}" alt="balance">
    <div>
        <strong>ចំណាំ</strong> ៖​ លេខកូដផ្ទៀងផ្ទាត់ <strong>OTP</strong> នឹងផ្ញើទៅកាន់
        លេខទូរស័ព្ទ 
        <strong class="whitespace-nowrap">+855 
            {{ preg_replace('/(\d{2})(\d{3})(\d{4})/', '$1 $2 $3', $phone) }}</strong> ។
    </div>
    {{-- edit phone button --}}
    <button class="text-[#128DEF] font-semibold flex items-center gap-1">
        <p class="whitespace-nowrap">កែប្រែ</p>
        <img class="min-w-5" src="{{ asset('asset/edit.svg') }}" alt="edit">
    </button>
</div>
