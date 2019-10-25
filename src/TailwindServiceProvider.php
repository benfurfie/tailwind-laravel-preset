<?php

namespace BenFurfie\Tailwind;

use BenFurfie\Tailwind\TailwindPreset;
use Illuminate\Support\ServiceProvider;
use Illuminate\Foundation\Console\PresetCommand;

class TailwindServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        PresetCommand::macro('tailwind', function ($command) {
            TailwindPreset::install();
        });
    }
}
