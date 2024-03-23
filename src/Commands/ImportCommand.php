<?php

namespace Barryvdh\TranslationManager\Commands;

use Illuminate\Console\Command;
use Barryvdh\TranslationManager\Manager;
use Symfony\Component\Console\Input\InputOption;

class ImportCommand extends Command
{
    protected $name = 'translations:import';

    protected $description = 'Import translations from the PHP sources';

    public function handle(Manager $manager): void
    {
        $replace = $this->option('replace');
        $counter = $manager->importTranslations($replace);
        $this->info('Done importing, processed '.$counter.' items!');
    }

    protected function getOptions(): array
    {
        return [
            ['replace', 'R', InputOption::VALUE_NONE, 'Replace existing keys'],
        ];
    }
}
