<?php

namespace Indemnity83\Plaid\Resources;

use Spatie\DataTransferObject\DataTransferObject;

class NewAccessTokenResource extends DataTransferObject
{
    public string $new_access_token;

    public string $request_id;
}
