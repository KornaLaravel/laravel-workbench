<?php

namespace Orchestra\Workbench\Tests\Actions;

use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Composer;
use Mockery as m;
use Orchestra\Workbench\Actions\DumpComposerAutoloads;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;

use function Orchestra\Testbench\join_paths;

#[Group('composer')]
class DumpComposerAutoloadsTest extends TestCase
{
    #[Test]
    public function it_can_run_dump_autoloads()
    {
        $filesystem = new Filesystem;
        $workingPath = join_paths(__DIR__, 'stubs');

        $this->instance('workbench.composer', $composer = m::mock(Composer::class, ['files' => $filesystem]));

        $composer->shouldReceive('setWorkingPath')->once()->with($workingPath)->andReturnSelf();
        $composer->shouldReceive('dumpAutoloads')->once()->andReturnNull();

        $action = new DumpComposerAutoloads($workingPath);

        $action->handle();
    }
}
