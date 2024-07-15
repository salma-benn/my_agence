<?php

namespace App\Command;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\Serializer\SerializerInterface;

#[AsCommand(
    name: 'app:export-destinations',
    description: 'Export all destinations to a CSV file',
)]
class ExportDestinationsCommand extends Command
{
    private $serializer;

    public function __construct(SerializerInterface $serializer)
    {
        parent::__construct();
        $this->serializer = $serializer;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $output->writeln('Fetching destinations...');

        $client = HttpClient::create();
        $response = $client->request('GET', 'http://localhost:8000/api/destinations/');

        if ($response->getStatusCode() !== 200) {
            $output->writeln('<error>Failed to fetch destinations</error>');
            return Command::FAILURE;
        }
        $destinations = $response->toArray();

        $output->writeln('Exporting destinations to CSV...');

        $csvData = $this->serializer->serialize($destinations, 'csv', [
//            'csv_headers' => ['id','Name', 'Description', 'Picture','Price','Duration'],
            'csv_delimiter' => ',',
        ]);

        $directory = 'public/csv';
        if (!is_dir($directory)) {
            if (!mkdir($directory, 0777, true)) {
                $output->writeln("<error>Failed to create directory: $directory</error>");
                return Command::FAILURE;
            }
        }

        $filename = $directory . '/destinations_export_' . date('Y-m-d_His') . '.csv';
        if (file_put_contents($filename, $csvData) === false) {
            $output->writeln("<error>Failed to write to file: $filename</error>");
            return Command::FAILURE;
        }

        $output->writeln("<info>Destinations exported successfully to $filename</info>");

        return Command::SUCCESS;
    }
}
