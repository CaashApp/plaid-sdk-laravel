<?php

namespace CaashApp\Plaid\Resources;

use CaashApp\Plaid\Casters\AccountCollectionCaster;
use CaashApp\Plaid\Entities\Account;
use CaashApp\Plaid\Entities\Item;
use Illuminate\Support\Collection;
use Spatie\DataTransferObject\Attributes\CastWith;
use Spatie\DataTransferObject\DataTransferObject;

class AccountsResource extends DataTransferObject
{
    /** @var Account[] */
    #[CastWith(AccountCollectionCaster::class)]
    public Collection $accounts;

    public Item $item;

    public string $request_id;
}
