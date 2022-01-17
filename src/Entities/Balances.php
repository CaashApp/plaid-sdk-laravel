<?php

namespace CaashApp\Plaid\Entities;

use CaashApp\Plaid\Casters\DateTimeCaster;
use DateTime;
use Money\Money;
use Spatie\DataTransferObject\Attributes\DefaultCast;
use Spatie\DataTransferObject\DataTransferObject;

#[
    DefaultCast(DateTime::class, DateTimeCaster::class)
]
class Balances extends DataTransferObject
{
    public ?Money $available;

    public ?Money $current;

    public ?Money $limit;

    public ?string $iso_currency_code;

    public ?string $unofficial_currency_code;

    public ?DateTime $last_updated_datetime;
}
