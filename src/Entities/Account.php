<?php

namespace CaashApp\Plaid\Entities;

use CaashApp\Plaid\Casters\BalanceCaster;
use Spatie\DataTransferObject\Attributes\CastWith;
use Spatie\DataTransferObject\DataTransferObject;

class Account extends DataTransferObject
{
    public string $account_id;

    #[CastWith(BalanceCaster::class)]
    public Balances $balances;

    public ?string $mask;

    public string $name;

    public ?string $official_name;

    public string $type;

    public ?string $subtype;

    public ?string $verification_status;
}
