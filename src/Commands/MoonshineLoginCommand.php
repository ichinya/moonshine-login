<?php

namespace Ichinya\MoonshineLogin\Commands;

use Illuminate\Console\Command;

class MoonshineLoginCommand extends Command
{
    public $signature = 'moonshine-login';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
