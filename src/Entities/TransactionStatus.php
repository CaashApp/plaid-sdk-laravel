<?php

namespace Indemnity83\Plaid\Entities;

use Indemnity83\Plaid\Casters\DateTimeCaster;
use DateTime;
use Spatie\DataTransferObject\Attributes\DefaultCast;
use Spatie\DataTransferObject\DataTransferObject;

#[
    DefaultCast(DateTime::class, DateTimeCaster::class)
]
class TransactionStatus extends DataTransferObject
{
    public ?DateTime $last_successful_update;

    public ?DateTime $last_failed_update;
}
