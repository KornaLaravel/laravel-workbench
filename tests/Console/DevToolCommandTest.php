<?php

namespace Orchestra\Workbench\Tests\Console;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;

class DevToolCommandTest extends CommandTestCase
{
    #[Test]
    #[DataProvider('environmentFileDataProviders')]
    public function it_can_run_devtool_command_with_installation(?string $answer, bool $createEnvironmentFile)
    {
        $this->artisan('workbench:devtool', ['--install' => true])
            ->expectsConfirmation('Prefix with `Workbench` namespace?', answer: 'yes')
            ->expectsChoice("Export '.env' file as?", $answer, [
                'Skip exporting .env',
                '.env',
                '.env.example',
                '.env.dist',
            ])
            ->expectsConfirmation('Generate `workbench/bootstrap/app.php` file?', answer: 'no')
            ->expectsConfirmation('Generate `workbench/bootstrap/providers.php` file?', answer: 'no')
            ->assertSuccessful();

        $this->assertCommandExecutedWithDevTool();
        $this->assertCommandExecutedWithInstall();
        $this->assertFromEnvironmentFileDataProviders($answer, $createEnvironmentFile);
    }

    #[Test]
    #[DataProvider('environmentFileDataProviders')]
    public function it_can_run_devtool_command_with_basic_installation(?string $answer, bool $createEnvironmentFile)
    {
        $this->artisan('workbench:devtool', ['--install' => true, '--basic' => true])
            ->expectsConfirmation('Prefix with `Workbench` namespace?', answer: 'yes')
            ->expectsChoice("Export '.env' file as?", $answer, [
                'Skip exporting .env',
                '.env',
                '.env.example',
                '.env.dist',
            ])
            ->expectsConfirmation('Generate `workbench/bootstrap/app.php` file?', answer: 'no')
            ->expectsConfirmation('Generate `workbench/bootstrap/providers.php` file?', answer: 'no')
            ->assertSuccessful();

        $this->assertCommandExecutedWithDevTool();
        $this->assertCommandExecutedWithBasicInstall();
        $this->assertFromEnvironmentFileDataProviders($answer, $createEnvironmentFile);
    }

    #[Test]
    public function it_can_run_devtool_command_without_installation()
    {
        $this->artisan('workbench:devtool', ['--no-install' => true])
            ->expectsConfirmation('Prefix with `Workbench` namespace?', answer: 'yes')
            ->assertSuccessful();

        $this->assertCommandExecutedWithDevTool();
        $this->assertCommandExecutedWithoutInstall();
    }

    #[Test]
    public function it_can_be_installed_with_no_interaction_options()
    {
        $this->artisan('workbench:devtool', ['--no-install' => true, '--no-interaction' => true])
            ->expectsConfirmation('Prefix with `Workbench` namespace?', answer: 'yes')
            ->assertSuccessful();

        $this->assertCommandExecutedWithDevTool();
        $this->assertCommandExecutedWithoutInstall();
    }

    #[Test]
    public function it_can_be_installed_with_prompt_for_missing_arguments()
    {
        $this->artisan('workbench:devtool')
            ->expectsConfirmation('Run Workbench installation?', false)
            ->expectsConfirmation('Prefix with `Workbench` namespace?', answer: 'yes')
            ->assertSuccessful();

        $this->assertCommandExecutedWithDevTool();
        $this->assertCommandExecutedWithoutInstall();
    }
}
