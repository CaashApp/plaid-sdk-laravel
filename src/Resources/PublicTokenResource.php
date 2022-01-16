<?php

namespace CaashApp\Plaid\Resources;

use Spatie\DataTransferObject\DataTransferObject;

class PublicTokenResource extends DataTransferObject
{
    public string $public_token;

    public string $request_id;
}
