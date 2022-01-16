<?php

namespace CaashApp\Plaid\Resources;

use Spatie\DataTransferObject\DataTransferObject;

class ResetItemResource extends DataTransferObject
{
    public bool $reset_login;

    public string $request_id;
}
