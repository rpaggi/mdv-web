<?php

namespace App\Logging;

class AppContextProcessor
{
    public function __invoke(array $record): array
    {
        if (auth()->check()) {
            $user = auth()->user();
            $record['extra']['user_id']    = (string) $user->id;
            $record['extra']['user_roles'] = $user->getRoleNames()->implode(',');
        }

        $record['extra']['request_id'] = request()->headers->get('X-Request-Id', uniqid('req_'));

        return $record;
    }
}
