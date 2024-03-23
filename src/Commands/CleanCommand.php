<?php

namespace Barryvdh\TranslationManager\Commands;

use Illuminate\Console\Command;
use Barryvdh\TranslationManager\Manager;

class CleanCommand extends Command
{
    protected $name = 'translations:clean';

    protected $description = 'Clean empty translations';

    public function handle(Manager $manager): void
    {
        $manager->cleanTranslations();
        $this->info('Done cleaning translations');
    }
}
