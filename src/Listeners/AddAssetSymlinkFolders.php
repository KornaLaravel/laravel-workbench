<?php

namespace Orchestra\Workbench\Listeners;

use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Orchestra\Testbench\Foundation\Events\ServeCommandStarted;
use Orchestra\Testbench\Workbench\Actions\AddAssetSymlinkFolders as Action;

/**
 * @codeCoverageIgnore
 */
class AddAssetSymlinkFolders
{
    /**
     * Handle the event.
     */
    public function handle(ServeCommandStarted $event): void
    {
        resolve(Action::class)->handle();
    }
}
