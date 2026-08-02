<?php

declare(strict_types=1);

use Agencetwogether\HooksHelper\HooksHelperPlugin;
use Filament\Facades\Filament;

beforeEach(function () {
    $this->panel = Filament::getCurrentOrDefaultPanel();
});

it('displays the hooks switch', function () {
    $this->panel
        ->plugins([
            HooksHelperPlugin::make()
                ->alwaysEnabled(),
        ]);

    $this->get('/admin/login')
        ->assertOk()
        ->assertSee('auth-hooks-switcher');
});

it('hides the hooks switch', function () {
    $this->panel
        ->plugins([
            HooksHelperPlugin::make()
                ->alwaysEnabled(false),
        ]);

    $this->get('/admin/login')
        ->assertOk()
        ->assertDontSee('auth-hooks-switcher');
});
