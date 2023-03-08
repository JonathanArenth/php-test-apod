<?php

namespace App\Command;

use App\Service\FetchDataService\FecthPictureNasaService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class FetchPictureNasaCommand extends Command
{
    protected static $defaultName = 'app:fetchPictureNasa';
    protected static $defaultDescription = 'get picture of the day in Nasa API';

    private $fecthPictureNasaService;
    public function __construct(FecthPictureNasaService $fecthPictureNasaService)
    {
        $this->fecthPictureNasaService = $fecthPictureNasaService;
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->setDescription(self::$defaultDescription)
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        
        $response = json_decode($this->fecthPictureNasaService->fetchPicture()->getContent(), true);

        $io->success($response['message']);

        return Command::SUCCESS;
    }
}
