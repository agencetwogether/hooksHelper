<?php

namespace Agencetwogether\HooksHelper\Livewire;

use Filament\Notifications\Notification;
use Illuminate\Contracts\View\View;
use Illuminate\Routing\Redirector;
use Livewire\Component;

class ToggleHooks extends Component
{
    public bool $isShow;

    public function mount(): void
    {
        $this->isShow = request()->hasCookie('showHooks') ?? session()->get('showHooks') ?? false;
    }

    public function changeVisibility(): Redirector
    {
        $this->isShow = ! $this->isShow;

        if ($this->isShow) {
            session()->put('showHooks', true);
            cookie()->queue(cookie()->forever('showHooks', true));
        } else {
            session()->forget('showHooks');
            cookie()->queue(cookie()->forget('showHooks'));
        }

        Notification::make()
            ->title(__('hookshelper::hookshelper.success.title', [
                'status' => $this->isShow ? __('hookshelper::hookshelper.activated') : __('hookshelper::hookshelper.deactivated'),
            ]))
            ->success()
            ->send();

        return redirect(request()->header('Referer'));
    }

    public function render(): View
    {
        return view('hookshelper::livewire.toggle-hooks');
    }

    public static function getShowHooks(): bool
    {
        return request()->hasCookie('showHooks');
    }
}
