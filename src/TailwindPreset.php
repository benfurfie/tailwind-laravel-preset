<?php

namespace BenFurfie\Tailwind;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\File;
use Illuminate\Foundation\Console\Presets\Preset;

class TailwindPreset extends Preset
{
    public static function install()
    {
        static::removeNodeModules();
        static::updatePackages();
        static::cleanDirectories();
        static::bootstrap();
    }

    public static function cleanDirectories()
    {
        File::deleteDirectory(resource_path('sass'));
        File::cleanDirectory(resource_path('js'));
        File::cleanDirectory(public_path('css/app.css'));
        File::cleanDirectory(public_path('js/app.js'));
    }

    public static function bootstrap()
    {
        // package.json
        copy(__DIR__ . '/tailwind-stubs/package.json', base_path('package.json'));

        // Mix Config
        copy(__DIR__ . '/tailwind-stubs/webpack.mix.js', base_path('webpack.mix.js'));

        // TailwindCSS Config
        copy(__DIR__ . '/tailwind-stubs/tailwind.config.js', base_path('tailwind.config.js'));

        // CSS
        if (!File::isDirectory(resource_path('css'))) {
            File::makeDirectory(resource_path('css'), 0755, true);
        }
        if (!File::isDirectory(resource_path('css/base'))) {
            File::makeDirectory(resource_path('css/base'), 0755, true);
        }
        if (!File::isDirectory(resource_path('css/components'))) {
            File::makeDirectory(resource_path('css/components'), 0755, true);
        }

        copy(__DIR__ . '/tailwind-stubs/css/app.css', resource_path('css/app.css'));
        copy(__DIR__ . '/tailwind-stubs/css/base/all.css', resource_path('css/base/all.css'));
        copy(__DIR__ . '/tailwind-stubs/css/base/typography.css', resource_path('css/base/typography.css'));
        copy(__DIR__ . '/tailwind-stubs/css/base/media.css', resource_path('css/base/media.css'));
        copy(__DIR__ . '/tailwind-stubs/css/components/all.css', resource_path('css/components/all.css'));

        // JS

        if (!File::isDirectory(resource_path('js/components'))) {
            File::makeDirectory(resource_path('js/components'), 0755, true);
        }
        copy(__DIR__ . '/tailwind-stubs/js/app.js', resource_path('js/app.js'));
        copy(__DIR__ . '/tailwind-stubs/js/components/.gitkeep', resource_path('js/components/.gitkeep'));
    }

    protected static function updatePackageArray(array $packages)
    {
        return array_merge([
            'laravel-mix' => '^5.0.0',
            'laravel-mix-purgecss' => '^4.2.0',
            'postcss-import' => '^12.0.1',
            'postcss-nested' => '^4.1.2',
            'postcss-sorting' => '^5.0.1',
            'tailwindcss' => '^1.1.2',
            'vue-template-compiler' => '^2.6.10'
        ], Arr::except($packages, [
            'bootstrap',
            'bootstrap-sass',
            'popper.js',
            'laravel-mix',
            'jquery',
        ]));
    }

    /**
     * Checks if an option has been set on the command line.
     *
     * @param string $name
     * @return boolean
     */
    protected static function hasOption($name)
    {
        return isset(static::$options[$name]) && static::$options[$name] === true;
    }

}
