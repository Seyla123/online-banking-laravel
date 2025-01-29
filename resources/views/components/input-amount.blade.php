@props([
    'isError'=>false
])
<div class="flex gap-2 items-center  focus:border-indigo-500 focus:ring-indigo-500 rounded-md border-[1px] px-4 py-2 {{$isError ? 'border-red-500' : 'border-gray-300'}}">
    $
    <input type="number" x-model="amount" placeholder="ចំនួនទឹកប្រាក់" class="w-full focus:outline-none 
    focus:ring-0
    border-none shadow-none"/>
</div>