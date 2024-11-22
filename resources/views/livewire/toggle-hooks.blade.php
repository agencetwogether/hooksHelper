<x-filament::button
    color="danger"
    :outlined="!$isShow"
    :tooltip="__('hookshelper::hookshelper.tooltip', ['action' => $isShow ? __('hookshelper::hookshelper.deactivate') : __('hookshelper::hookshelper.activate')])"
    :icon="config('hookshelper.icon') ?? 'heroicon-m-cursor-arrow-rays'"
    wire:click="changeVisibility"
>
    @unless(config('hookshelper.tiny_toggle'))
        {{ $isShow ? __('hookshelper::hookshelper.hide') : __('hookshelper::hookshelper.show') }}
    @endif
</x-filament::button>
