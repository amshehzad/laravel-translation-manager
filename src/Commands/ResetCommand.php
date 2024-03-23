<?php

namespace Barryvdh\TranslationManager\Commands;

use Illuminate\Console\Command;
use Barryvdh\TranslationManager\Manager;

class ResetCommand extends Command
{
    protected $name = 'translations:reset';

    protected $description = 'Delete all translations from the database';

    protected Manager $manager;

    public function handle(Manager $manager): void
    {
        $manager->truncateTranslations();
        $this->info('All translations are deleted');
    }
}
