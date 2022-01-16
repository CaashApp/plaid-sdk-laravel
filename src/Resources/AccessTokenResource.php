<?php

namespace CaashApp\Plaid\Resources;

use Spatie\DataTransferObject\DataTransferObject;

class AccessTokenResource extends DataTransferObject
{
    public string $access_token;

    public string $item_id;

    public string $request_id;
}
