<?php

namespace CaashApp\Plaid\Resources;

use Spatie\DataTransferObject\DataTransferObject;

class ItemRemoveResource extends DataTransferObject
{
    public string $request_id;
}
