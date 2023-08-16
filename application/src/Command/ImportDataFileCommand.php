<?php

namespace App\Command;

use App\Entity\CountryData;
use App\Repository\CountryDataRepository;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'ImportDataFile',
    description: 'Import data from downloaded file from remote source',
)]
class ImportDataFileCommand extends Command
{
    /** @var LoggerInterface */
    protected $logger = null;
    /** @var EntityManagerInterface */
    protected $manager = null;

    public function __construct(LoggerInterface $logger, EntityManagerInterface $manager)
    {
        parent::__construct();
        $this->logger = $logger;
        $this->manager = $manager;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $output->writeln('Extracting countries data');

        $source = 'var/countries.json';

        try {
            // load from local file
            $content = file_get_contents($source);
            if (empty($content)) {
                throw new \Exception('No data from file');
            }

            // extract JSON
            $structure = json_decode($content, true);
            if (empty($structure)) {
                throw new \Exception('Cannot extract json');
            }

            // import into DB
            foreach ($structure as $country) {
                $data = new CountryData();
                $data->setCountryCode($country['cca3']);
                $data->setJsonData($country);
                $this->manager->persist($data);
            }
            $this->manager->flush();

        } catch (\Throwable $ex) {
            $this->logger->error(sprintf('ImportDataFile error *%s* - trace: %s', $ex->getMessage(), $ex->getTraceAsString()));
            $io->error(sprintf('ImportDataFile error *%s* - trace: %s', $ex->getMessage(), $ex->getTraceAsString()));
            return Command::FAILURE;

        }

        $output->writeln('Import remote data done');
        return Command::SUCCESS;
    }
}
