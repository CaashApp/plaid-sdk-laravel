<?php

namespace Indemnity83\Plaid\Entities;

use Indemnity83\Plaid\Casters\DateTimeCaster;
use DateTime;
use Spatie\DataTransferObject\Attributes\DefaultCast;
use Spatie\DataTransferObject\DataTransferObject;

#[
    DefaultCast(DateTime::class, DateTimeCaster::class)
]
class WebhookStatus extends DataTransferObject
{
    public ?DateTime $sent_at;

    public ?string $code_sent;
}
