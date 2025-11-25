<x-layouts.app :title="__('Mining')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <div class="grid auto-rows-min gap-4 md:grid-cols-4">
            <div class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700 flex flex-col">
                <div class="px-2 pt-2 text-center">
                    <h3 class="text-sm font-semibold" data-item-name="coal">Coal</h3>
                    <p class="text-xs text-neutral-500" data-item-time="coal">9s</p>
                </div>
                <div class="flex-1 flex items-center justify-center">
                    <div class="w-28 h-28 rounded-full border-4 border-neutral-200 dark:border-neutral-700 flex items-center justify-center bg-white dark:bg-neutral-900 shadow-sm">
                        <!-- Use same inventory images (images/items/{item}.png) -->
                        <img src="{{ asset('images/items/coal_ore.png') }}" alt="Coal" class="w-16 h-16 object-contain" />
                    </div>
                </div>
                <x-progress-bar class=" relative bottom-0 inset-x-0" id="coalBar" />
                <form id="mineCoalForm" method="POST" action="{{ route('mine.item', ['item' => 'coal']) }}" data-item-identifier="coal_ore" data-duration-seconds="9">
                    @csrf
                    <button type="button" class="w-full px-4 py-2 rounded-b-md bg-slate-600 text-white text-center" id="coalButton">Mine</button>
                </form>
            </div>
            <div class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700 flex flex-col">
                <div class="px-2 pt-2 text-center">
                    <h3 class="text-sm font-semibold" data-item-name="tin">Tin</h3>
                    <p class="text-xs text-neutral-500" data-item-time="tin">11s</p>
                </div>
                <div class="flex-1 flex items-center justify-center">
                    <div class="w-28 h-28 rounded-full border-4 border-neutral-200 dark:border-neutral-700 flex items-center justify-center bg-white dark:bg-neutral-900 shadow-sm">
                        <img src="{{ asset('images/items/tin_ore.png') }}" alt="Tin" class="w-16 h-16 object-contain" />
                    </div>
                </div>
                <x-progress-bar class=" relative bottom-0 inset-x-0" id="tinBar" />
                <form id="mineTinForm" method="POST" action="{{ route('mine.item', ['item' => 'tin']) }}" data-item-identifier="tin_ore" data-duration-seconds="11">
                    @csrf
                    <button type="button" class="w-full px-4 py-2 rounded-b-md bg-slate-600 text-white text-center" id="tinButton">Mine</button>
                </form>
            </div>
            <div class="relative aspect-video overflow-hidden rounded-m border border-neutral-200 dark:border-neutral-700">
                <x-placeholder-pattern class="absolute inset-0 size-full stroke-gray-900/20 dark:stroke-neutral-100/20" />
            </div>
            <div class="relative aspect-video overflow-hidden rounded-m border border-neutral-200 dark:border-neutral-700">
                <x-placeholder-pattern class="absolute inset-0 size-full stroke-gray-900/20 dark:stroke-neutral-100/20" />
            </div>
        </div>
        <div class="relative h-full flex-1 overflow-hidden rounded-m border border-neutral-200 dark:border-neutral-700">
            <x-placeholder-pattern class="absolute inset-0 size-full stroke-gray-900/20 dark:stroke-neutral-100/20" />
        </div>
    </div>
</x-layouts.app>
