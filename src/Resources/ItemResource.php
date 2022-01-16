<?php

namespace CaashApp\Plaid\Resources;

use CaashApp\Plaid\Entities\Item;
use CaashApp\Plaid\Entities\PlaidStatus;
use Spatie\DataTransferObject\DataTransferObject;

class ItemResource extends DataTransferObject
{
    public Item $item;

    public ?PlaidStatus $status;

    public string $request_id;
}
