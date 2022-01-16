<?php

namespace Indemnity83\Plaid\Resources;

use Indemnity83\Plaid\Entities\Item;
use Indemnity83\Plaid\Entities\PlaidStatus;
use Spatie\DataTransferObject\DataTransferObject;

class ItemResource extends DataTransferObject
{
    public Item $item;

    public ?PlaidStatus $status;

    public string $request_id;
}
