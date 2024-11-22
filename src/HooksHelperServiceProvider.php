<?php

namespace Agencetwogether\HooksHelper;

use Spatie\LaravelPackageTools\Commands\InstallCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class HooksHelperServiceProvider extends PackageServiceProvider
{
    public static string $name = 'hookshelper';

    public static string $viewNamespace = 'hookshelper';

    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package->name(static::$name)
            ->hasConfigFile()
            ->hasTranslations()
            ->hasViews(static::$viewNamespace)
            ->hasInstallCommand(function (InstallCommand $command) {
                $command
                    ->publishConfigFile()
                    ->askToStarRepoOnGitHub('agencetwogether/hookshelper');
            });
    }

    public function packageRegistered(): void {}

    public function packageBooted(): void {}
}
