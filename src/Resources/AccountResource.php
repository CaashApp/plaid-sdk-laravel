<?php

namespace CaashApp\Plaid\Resources;

use CaashApp\Plaid\Entities\Account;
use CaashApp\Plaid\Entities\Item;
use Spatie\DataTransferObject\DataTransferObject;

class AccountResource extends DataTransferObject
{
    /** @var Account[] */
    public array $accounts;

    public Item $item;

    public string $request_id;
}
