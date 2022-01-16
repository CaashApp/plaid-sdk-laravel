<?php

namespace CaashApp\Plaid\Entities;

use CaashApp\Plaid\Casters\DateTimeCaster;
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
