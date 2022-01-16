<?php

namespace Indemnity83\Plaid\Resources;

use Indemnity83\Plaid\Entities\Account;
use Indemnity83\Plaid\Entities\Item;
use Spatie\DataTransferObject\DataTransferObject;

class AccountResource extends DataTransferObject
{
    /** @var Account[] */
    public array $accounts;

    public Item $item;

    public string $request_id;
}
