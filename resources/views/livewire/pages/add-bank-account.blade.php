<div class="max-w-2xl mx-auto space-y-4">
    {{-- header title --}}
    <x-slot name="header">
        បញ្ជូលគណនី
    </x-slot>
    {{--  --}}
    <section class="space-y-2">
        <h2 class="font-semibold text-gray-800 leading-tight">
            កាបូបរបស់អ្នក ៖​
        </h2>
        <div class="grid grid-cols-2 gap-2" x-data="{ selectedBank:  @js($banks[0]->id)  }">
            @foreach ($banks as $bank)
                <x-bank-card :bank="$bank->bank_name" :bankId="$bank->id" />
            @endforeach
        </div>
    </section>
    <section class="space-y-2">
        <h2 class="font-semibold text-gray-800 leading-tight">
            សូមបញ្ជូលលេខគណនី ៖
        </h2>
        <div class="space-y-2" x-data="{ account: '' }">
            <x-input-account-number :isError="false" />
            {{-- <x-input-error :messages="'សូមបញ្ជូលលេខគណនីជាមុនសិន ! !'" class="mt-2" /> --}}
        </div>
    </section>
    <x-slot name="buttom">
        <div class="fixed bottom-0 left-0 right-0 p-4 max-w-2xl mx-auto">
            <x-primary-button class="w-full flex justify-center py-4">រក្សារទុក</x-primary-button>
        </div>
    </x-slot>
</div>
