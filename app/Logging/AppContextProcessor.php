<?php

namespace App\Logging;

use Illuminate\Support\Facades\Auth;
use Monolog\LogRecord;
use Monolog\Processor\ProcessorInterface;

class AppContextProcessor implements ProcessorInterface
{
    public function __invoke(LogRecord $record): LogRecord
    {
        $extra = $record->extra;

        if (Auth::check()) {
            /** @var \App\Models\User $user */
            $user = Auth::user();
            $extra['user_id']    = (string) $user->id;
            $extra['user_roles'] = $user->getRoleNames()->implode(',');
        }

        $extra['request_id'] = request()->headers->get('X-Request-Id', uniqid('req_'));

        return $record->with(extra: $extra);
    }
}
