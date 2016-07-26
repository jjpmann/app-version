<?php

namespace AppVersion\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ValidateCommand extends Command
{
    /**
     * configure.
     */
    protected function configure()
    {
        $this
            ->setName('validate')
            ->setDescription('Validates a composer.json')
            ->setDefinition([
                new InputArgument('file', InputArgument::OPTIONAL, 'path to composer.json file', './composer.json'),
            ])
            ->setHelp(<<<'EOT'
The validate command validates a given composer.json

Exit codes in case of errors are:
1 version and previous not defined
2 file not valid JSON
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


        if (!file_exists($file)) {
            $output->writeln('<error>'.$file.' not found.</error>');

            return 3;
        }
        if (!is_readable($file)) {
            $output->writeln('<error>'.$file.' is not readable.</error>');

            return 3;
        }

        $data = json_decode(file_get_contents($file), true);


        if (!$data) {
            $output->writeln('<error>'.$file.' is not valid JSON.</error>');

            return 2;
        }

        $extra = $data['extra'];

        if (!$extra || !$extra['version'] || !$extra['previous']) {
            $output->writeln('<error>version and/or previous not defined.</error>');

            return 1;
        }

        $output->writeln('version: <fg=green>'.$extra['version'].'</>'."\n".'previous:<fg=red> '.$extra['previous'].'</>');
    }
}
