<?php

namespace Indemnity83\Plaid\Entities;

use Indemnity83\Plaid\Casters\DateTimeCaster;
use DateTime;
use Spatie\DataTransferObject\Attributes\DefaultCast;
use Spatie\DataTransferObject\DataTransferObject;

#[
    DefaultCast(DateTime::class, DateTimeCaster::class)
]
class Balances extends DataTransferObject
{
    public ?float $available;

    public ?float $current;

    public ?float $limit;

    public ?string $iso_currency_code;

    public ?string $unofficial_currency_code;

    public ?DateTime $last_updated_datetime;
}
