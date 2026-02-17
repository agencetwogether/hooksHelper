<?php

namespace Agencetwogether\HooksHelper;

use Agencetwogether\HooksHelper\Livewire\ToggleHooks;
use Blade;
use Filament\Contracts\Plugin;
use Filament\Panel;
use Filament\Tables\View\TablesRenderHook;
use Filament\View\PanelsRenderHook;
use Filament\Widgets\View\WidgetsRenderHook;
use Livewire\Livewire;
use ReflectionClass;
use Str;

class HooksHelperPlugin implements Plugin
{
    public function getId(): string
    {
        return 'hookshelper';
    }

    public function register(Panel $panel): void
    {
        Livewire::component('hookshelper.toggle-hooks', ToggleHooks::class);

        $panel->renderHook(
            Str::start(config('hookshelper.render_hook') ?? 'global-search.before', 'panels::'),
            fn () => view('hookshelper::switcher')
        );
        $panel->renderHook(
            'panels::auth.login.form.before',
            fn () => view('hookshelper::switcher')
        );
        $panel->renderHook(
            'panels::auth.password-reset.request.form.before',
            fn () => view('hookshelper::switcher')
        );
        $panel->renderHook(
            'panels::auth.password-reset.reset.form.before',
            fn () => view('hookshelper::switcher')
        );
        $panel->renderHook(
            'panels::auth.register.form.before',
            fn () => view('hookshelper::switcher')
        );

        if (ToggleHooks::getShowHooks()) {
            // Panel Hooks
            $panelHooks = new ReflectionClass(PanelsRenderHook::class);
            // Table Hooks
            $tableHooks = new ReflectionClass(TablesRenderHook::class);
            // Widget Hooks
            $widgetHooks = new ReflectionClass(WidgetsRenderHook::class);

            $panelHooks = $panelHooks->getConstants();
            $tableHooks = $tableHooks->getConstants();
            $widgetHooks = $widgetHooks->getConstants();

            foreach ($panelHooks as $hook) {
                $panel->renderHook($hook, function () use ($hook) {
                    return Blade::render('<div style="border: solid red 1px; padding: 2px;">{{ $name }}</div>', [
                        'name' => Str::of($hook)->remove('tables::'),
                    ]);
                });
            }
            foreach ($tableHooks as $hook) {
                $panel->renderHook($hook, function () use ($hook) {
                    return Blade::render('<div style="border: solid red 1px; padding: 2px;">{{ $name }}</div>', [
                        'name' => Str::of($hook)->remove('tables::'),
                    ]);
                });
            }
            foreach ($widgetHooks as $hook) {
                $panel->renderHook($hook, function () use ($hook) {
                    return Blade::render('<div style="border: solid red 1px; padding: 2px;">{{ $name }}</div>', [
                        'name' => Str::of($hook)->remove('tables::'),
                    ]);
                });
            }
        }
    }

    public function shouldShowSwitcher(): bool
    {
        return Str::of(request()->route()->getName())->contains([
            'auth.login',
            'auth.password',
            'auth.profile',
            'auth.register',
        ]);
    }

    public function boot(Panel $panel): void
    {
        //
    }

    public static function make(): static
    {
        return app(static::class);
    }

    public static function get(): static
    {
        /** @var static $plugin */
        $plugin = filament(app(static::class)->getId());

        return $plugin;
    }
}
