<?php

namespace App\Logging;

use Monolog\Logger;
use Monolog\Processor\MemoryPeakUsageProcessor;
use Monolog\Processor\WebProcessor;

class CreateLokiLogger
{
    public function __invoke(array $config): Logger
    {
        $handler = new LokiLogger($config);

        $logger = new Logger('loki', [$handler]);
        $logger->pushProcessor(new AppContextProcessor);
        $logger->pushProcessor(new MemoryPeakUsageProcessor(useFormatting: true, realUsage: true));
        $logger->pushProcessor(new WebProcessor);

        return $logger;
    }
}
