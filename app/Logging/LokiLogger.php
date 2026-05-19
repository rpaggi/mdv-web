<?php

namespace App\Logging;

use Illuminate\Support\Facades\Http;
use Monolog\Handler\AbstractProcessingHandler;
use Monolog\Logger;
use Monolog\LogRecord;

class LokiLogger extends AbstractProcessingHandler
{
    private array $channelConfig;

    public function __construct(array $config)
    {
        parent::__construct(Logger::toMonologLevel($config['level'] ?? 'debug'));
        $this->channelConfig = $config;
    }

    protected function write(LogRecord $record): void
    {
        $endpoint = rtrim((string) ($this->channelConfig['endpoint'] ?? ''), '/');

        if (empty($endpoint)) {
            return;
        }

        $headers = array_merge(
            ['X-Scope-OrgID' => (string) ($this->channelConfig['tenant_id'] ?? 'pupila')],
            array_filter($this->channelConfig['custom_headers'] ?? [], static fn ($v) => ! empty($v)),
        );

        $timestampNs = (string) (intval(microtime(true) * 1e9));

        $logEntry = json_encode([
            'message'  => $record->message,
            'level'    => $record->level->name,
            'channel'  => $record->channel,
            'datetime' => $record->datetime->format(\DateTimeInterface::RFC3339_EXTENDED),
            'context'  => $record->context,
            'extra'    => $record->extra,
        ], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);

        $payload = [
            'streams' => [[
                'stream' => [
                    'app'     => (string) ($this->channelConfig['app_name'] ?? config('app.name')),
                    'env'     => config('app.env', 'production'),
                    'level'   => strtolower($record->level->name),
                    'channel' => $record->channel,
                    'host'    => gethostname() ?: 'unknown',
                ],
                'values' => [[$timestampNs, $logEntry !== false ? $logEntry : $record->message]],
            ]],
        ];

        Http::withHeaders($headers)
            ->timeout(3)
            ->post("{$endpoint}/loki/api/v1/push", $payload);
    }
}
