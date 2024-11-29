<?php

namespace Orchestra\Workbench\Listeners;

use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Collection;
use Orchestra\Testbench\Foundation\Events\ServeCommandEnded;
use Orchestra\Testbench\Workbench\Actions\RemoveAssetSymlinkFolders as Action;

/**
 * @codeCoverageIgnore
 */
class RemoveAssetSymlinkFolders
{
    /**
     * Handle the event.
     */
    public function handle(ServeCommandEnded $event): void
    {
        resolve(Action::class)->handle();
    }
}
