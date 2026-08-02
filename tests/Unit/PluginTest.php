<?php

declare(strict_types=1);

use Agencetwogether\HooksHelper\HooksHelperPlugin;
use Filament\Facades\Filament;

beforeEach(function () {
    $this->panel = Filament::getCurrentOrDefaultPanel();
});

it('can register the plugin', function () {
    $this->panel
        ->plugins([
            HooksHelperPlugin::make(),
        ]);

    expect(Filament::getPlugin('hookshelper'))->toBeInstanceOf(HooksHelperPlugin::class);
});

it('sets correct visibility', function () {
    $this->panel
        ->plugins([
            HooksHelperPlugin::make()
                ->alwaysEnabled(false),
        ]);

    expect(Filament::getPlugin('hookshelper')->isAlwaysEnabled())->toBe(false);
});
