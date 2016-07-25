<?php

namespace Composer\Command;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class ValidateCommand extends BaseCommand
{
    /**
     * configure
     */
    protected function configure()
    {
        $this
            ->setName('validate')
            ->setDescription('Validates a composer.json and composer.lock')
            ->setDefinition(array(
                new InputOption('no-check-all', null, InputOption::VALUE_NONE, 'Do not make a complete validation'),
                new InputOption('no-check-lock', null, InputOption::VALUE_NONE, 'Do not check if lock file is up to date'),
                new InputOption('no-check-publish', null, InputOption::VALUE_NONE, 'Do not check for publish errors'),
                new InputOption('with-dependencies', 'A', InputOption::VALUE_NONE, 'Also validate the composer.json of all installed dependencies'),
                new InputOption('strict', null, InputOption::VALUE_NONE, 'Return a non-zero exit code for warnings as well as errors'),
                new InputArgument('file', InputArgument::OPTIONAL, 'path to composer.json file', './composer.json'),
            ))
            ->setHelp(<<<EOT
The validate command validates a given composer.json and composer.lock

Exit codes in case of errors are:
1 validation warning(s), only when --strict is given
2 validation error(s)
3 file unreadable or missing

EOT
            );
    }

    /**
     * @param InputInterface  $input
     * @param OutputInterface $output
     *
     * @return int
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $file = $input->getArgument('file');
        $io = $this->getIO();

        if (!file_exists($file)) {
            $io->writeError('<error>' . $file . ' not found.</error>');

            return 3;
        }
        if (!is_readable($file)) {
            $io->writeError('<error>' . $file . ' is not readable.</error>');

            return 3;
        }

        die('done');

    }
}
