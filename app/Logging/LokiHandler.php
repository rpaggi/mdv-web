<?php

namespace App\Logging;

use Monolog\Handler\AbstractProcessingHandler;
use Monolog\Logger;

class LokiHandler extends AbstractProcessingHandler
{
    private string $url;
    private array $labels;
    private ?string $tenantId;
    private ?string $cfClientId;
    private ?string $cfClientSecret;

    public function __construct(
        string $url,
        array $labels = [],
        ?string $tenantId = null,
        ?string $cfClientId = null,
        ?string $cfClientSecret = null,
        int $level = Logger::DEBUG
    ) {
        parent::__construct($level, true);
        $this->url            = rtrim($url, '/') . '/loki/api/v1/push';
        $this->labels         = $labels;
        $this->tenantId       = $tenantId;
        $this->cfClientId     = $cfClientId;
        $this->cfClientSecret = $cfClientSecret;
    }

    protected function write(array $record): void
    {
        $labels = array_merge($this->labels, [
            'level' => strtolower($record['level_name']),
        ]);

        $payload = json_encode([
            'streams' => [[
                'stream' => $labels,
                'values' => [[
                    (string) ($record['datetime']->getTimestamp() * 1_000_000_000),
                    $record['formatted'],
                ]],
            ]],
        ]);

        $headers = ['Content-Type: application/json'];

        if ($this->tenantId) {
            $headers[] = 'X-Scope-OrgID: ' . $this->tenantId;
        }
        if ($this->cfClientId) {
            $headers[] = 'CF-Access-Client-Id: ' . $this->cfClientId;
        }
        if ($this->cfClientSecret) {
            $headers[] = 'CF-Access-Client-Secret: ' . $this->cfClientSecret;
        }

        $ch = curl_init($this->url);
        curl_setopt_array($ch, [
            CURLOPT_POST           => true,
            CURLOPT_POSTFIELDS     => $payload,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT        => 3,
            CURLOPT_HTTPHEADER     => $headers,
        ]);
        curl_exec($ch);
        curl_close($ch);
    }
}
