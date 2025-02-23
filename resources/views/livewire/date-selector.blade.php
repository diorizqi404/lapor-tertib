<div class="flex justify-center items-center space-x-2">
    <select wire:model.live="dateType"
        class="py-3 h-12 px-4 pe-9 block w-auto border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500">
        <option value="date">Harian</option>
        <option value="week">Mingguan</option>
        <option value="month">Bulanan</option>
    </select>

    <input wire:model.live="value" type="{{ $dateType }}"
        class="py-3 px-4 block w-auto border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500" />
</div>
