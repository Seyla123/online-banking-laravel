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
        <div class="grid grid-cols-2 gap-2" x-data="{ selectedBank: true }">
            <x-bank-card :isSelected="true" :bank="'aba'" />
            <x-bank-card :isSelected="false" :bank="'wing'" />
            <x-bank-card :isSelected="false" :bank="'acleda'" />
            <x-bank-card :isSelected="false" :bank="'kess'" />
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
    <!-- Success Modal -->
    <x-modal-success namxe="success" :message="'អំណោយសូមអរគុណ!'" :isOpen="$showSuccess" />

    <!-- Error Modal -->
    <x-modal-error :message="'មានបញ្ហាក្នុងការបញ្ជាទិញ!'" x-bind:show='showError' :isOpen="$showError" name="error" />
</div>
