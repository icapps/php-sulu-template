<?php

namespace App\Command;

use Psr\Log\LoggerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class TranslationsCommand extends Command
{
    protected static $defaultName = 'icapps:admin:update:translations';

    const LANGUAGES = ['nl', 'en'];

    /**
     * @var LoggerInterface
     */
    protected $logger;

    /**
     * @var HttpClientInterface
     */
    protected $httpClient;

    /**
     * {@inheritDoc}
     */
    public function __construct(
        LoggerInterface $logger,
        HttpClientInterface $httpClient
    ) {
        parent::__construct();
        $this->logger = $logger;
        $this->httpClient = $httpClient;
    }

    /**
     * {@inheritDoc}
     */
    protected function configure()
    {
        $this->setDescription('Update translations from icapps tool.');
    }

    /**
     * {@inheritDoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln('<info>All right, let\'s start updating translations</info>');
        $this->logger->notice('Update translations job started');

        $this->updateTranslations();

        $output->writeln('<info>Boom, finished updating translations</info>');
        $this->logger->notice('Update translations job finished');

        return 0;
    }

    /**
     * Sync translations from icapps translation tool.
     *
     * @throws ClientExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     */
    private function updateTranslations(): void
    {
        foreach (self::LANGUAGES as $language) {
            // Translations endpoint.
            $endpoint = $_ENV['ICAPPS_TRANSLATIONS_TOOL'] . $language . '.json';

            try {
                // Get translations.
                $response = $this->httpClient->request('GET', $endpoint, [
                    'headers' => [
                        'Authorization' => 'Token ' . $_ENV['ICAPPS_TRANSLATIONS_TOKEN'],
                    ],
                ]);

                // Decode.
                $content = json_decode($response->getContent(), true);

                // Update project translations.
                if (isset($content['translations']) && !empty($content['translations'])) {
                    $location = 'translations/icapps/messages.' . $language . '.json';
                    file_put_contents($location, json_encode($content['translations']));
                }
            } catch (TransportExceptionInterface $e) {
                $this->logger->critical('Could not download translation files from icapps tool');
            }
        }
    }
}
