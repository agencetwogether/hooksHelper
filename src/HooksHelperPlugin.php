<?php

namespace Agencetwogether\HooksHelper;

use Agencetwogether\HooksHelper\Livewire\ToggleHooks;
use Blade;
use Closure;
use Filament\Actions\View\ActionsRenderHook;
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
    protected bool | Closure | null $alwaysEnabled = null;

    public function getId(): string
    {
        return 'hookshelper';
    }

    /**
     * By default, the plugin only activates itself when APP_ENV is "local".
     * Calling this when registering the plugin on a panel (e.g.
     * `->plugin(HooksHelperPlugin::make()->alwaysEnabled())`) overrides that
     * default entirely — the value you pass here fully decides activation,
     * in every environment, including production.
     *
     * You may also pass a Closure if you need custom, dynamic logic (e.g.
     * based on the authenticated user, a request header, a feature flag...).
     * It is re-evaluated on every call and takes full control of activation,
     * even in the local environment:
     *
     * `->alwaysEnabled(fn () => auth()->user()?->email === 'max@free.fr')`
     */
    public function alwaysEnabled(bool | Closure $condition = true): static
    {
        $this->alwaysEnabled = $condition;

        return $this;
    }

    public function isAlwaysEnabled(): bool
    {
        return $this->alwaysEnabled !== null && (bool) value($this->alwaysEnabled);
    }

    /**
     * When alwaysEnabled() has been called, its (possibly dynamic) value is
     * the sole decider, in every environment. Otherwise, the plugin is
     * active only in the "local" environment.
     */
    public function isEnabled(): bool
    {
        if ($this->alwaysEnabled !== null) {
            return (bool) value($this->alwaysEnabled);
        }

        return app()->environment('local');
    }

    public function register(Panel $panel): void
    {
        Livewire::component('hookshelper.toggle-hooks', ToggleHooks::class);

        $panel->renderHook(
            Str::start(config('hookshelper.render_hook') ?? 'global-search.before', 'panels::'),
            fn () => $this->isEnabled() ? view('hookshelper::switcher') : ''
        );
        $panel->renderHook(
            'panels::auth.login.form.before',
            fn () => $this->isEnabled() ? view('hookshelper::switcher') : ''
        );
        $panel->renderHook(
            'panels::auth.password-reset.request.form.before',
            fn () => $this->isEnabled() ? view('hookshelper::switcher') : ''
        );
        $panel->renderHook(
            'panels::auth.password-reset.reset.form.before',
            fn () => $this->isEnabled() ? view('hookshelper::switcher') : ''
        );
        $panel->renderHook(
            'panels::auth.register.form.before',
            fn () => $this->isEnabled() ? view('hookshelper::switcher') : ''
        );

        if (ToggleHooks::getShowHooks()) {
            // Panel Hooks
            $panelHooks = new ReflectionClass(PanelsRenderHook::class);
            // Table Hooks
            $tableHooks = new ReflectionClass(TablesRenderHook::class);
            // Widget Hooks
            $widgetHooks = new ReflectionClass(WidgetsRenderHook::class);
            // Action Hooks
            // Since Filament 4
            if (class_exists(ActionsRenderHook::class)) {
                $actionHooks = new ReflectionClass(ActionsRenderHook::class);
                $actionHooks = $actionHooks->getConstants();
                foreach ($actionHooks as $hook) {
                    $panel->renderHook($hook, function () use ($hook) {
                        if (! $this->isEnabled()) {
                            return '';
                        }

                        return Blade::render('<div style="border: solid red 1px; padding: 2px;">{{ $name }}</div>', [
                            'name' => $hook,
                        ]);
                    });
                }
            }

            $panelHooks = $panelHooks->getConstants();
            $tableHooks = $tableHooks->getConstants();
            $widgetHooks = $widgetHooks->getConstants();

            foreach ($panelHooks as $hook) {
                $panel->renderHook($hook, function () use ($hook) {
                    if (! $this->isEnabled()) {
                        return '';
                    }

                    return Blade::render('<div style="border: solid red 1px; padding: 2px;">{{ $name }}</div>', [
                        'name' => $hook,
                    ]);
                });
            }
            foreach ($tableHooks as $hook) {
                $panel->renderHook($hook, function () use ($hook) {
                    if (! $this->isEnabled()) {
                        return '';
                    }

                    return Blade::render('<div style="border: solid red 1px; padding: 2px;">{{ $name }}</div>', [
                        'name' => $hook,
                    ]);
                });
            }
            foreach ($widgetHooks as $hook) {
                $panel->renderHook($hook, function () use ($hook) {
                    if (! $this->isEnabled()) {
                        return '';
                    }

                    return Blade::render('<div style="border: solid red 1px; padding: 2px;">{{ $name }}</div>', [
                        'name' => $hook,
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
