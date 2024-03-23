<?php

namespace Barryvdh\TranslationManager\Commands;

use Illuminate\Console\Command;
use Barryvdh\TranslationManager\Manager;

class FindCommand extends Command
{
    protected $name = 'translations:find';

    protected $description = 'Find translations in php/twig files';

    public function handle(Manager $manager): void
    {
        $counter = $manager->findTranslations();
        $this->info('Done importing, processed '.$counter.' items!');
    }
}
