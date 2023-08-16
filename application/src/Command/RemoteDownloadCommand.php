<?php

namespace App\Command;

use Psr\Log\LoggerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Filesystem\Filesystem;

#[AsCommand(
    name: 'RemoteDownload',
    description: 'Download country file from github',
)]
class RemoteDownloadCommand extends Command
{
    /** @var LoggerInterface */
    protected $logger = null;

    public function __construct(LoggerInterface $logger)
    {
        parent::__construct();
        $this->logger = $logger;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $this->logger->info('Downloading country data');
        $output->writeln('Downloading country data');

        $file = 'var/countries.json';
        $link = 'https://raw.githubusercontent.com/mledoze/countries/master/countries.json';

        $io = new SymfonyStyle($input, $output);
        $filesystem = new Filesystem();

        try {
            if (!$filesystem->exists($file)) {
                // source is online

                $content = file_get_contents($link);
                if (false !== $content) {
                    $filesystem->dumpFile($file, $content);
                } else {
                    $this->logger->error('Cannot get country file');
                    $io->error('Cannot get country file');
                    return Command::FAILURE;
                }
            }
        } catch (\Throwable $ex) {
            $this->logger->error(sprintf('RemoteDownload error *%s* - trace: %s', $ex->getMessage(), $ex->getTraceAsString()));
            $io->error(sprintf('RemoteDownload error *%s* - trace: %s', $ex->getMessage(), $ex->getTraceAsString()));
            return Command::FAILURE;
        }

        return Command::SUCCESS;
    }
}
