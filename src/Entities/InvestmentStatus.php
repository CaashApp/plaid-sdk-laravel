<?php

namespace CaashApp\Plaid\Entities;

use CaashApp\Plaid\Casters\DateTimeCaster;
use DateTime;
use Spatie\DataTransferObject\Attributes\DefaultCast;
use Spatie\DataTransferObject\DataTransferObject;

#[
    DefaultCast(DateTime::class, DateTimeCaster::class)
]
class InvestmentStatus extends DataTransferObject
{
    public ?DateTime $last_successful_update;

    public ?DateTime $last_failed_update;
}
