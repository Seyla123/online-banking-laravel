<div class="max-w-2xl mx-auto ">
    {{-- header title --}}
    <x-slot name="header">
        ដកប្រាក់
    </x-slot>
    {{-- wallet section --}}
    <section class="space-y-2">
        <h2 class="font-semibold text-gray-800 leading-tight">
            កាបូបរបស់អ្នក ៖​
        </h2>
     <x-wallet-card :$walletNumber :$balance/>
    </section>
    <div class="py-12">
        <div class="">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div>
</div>
