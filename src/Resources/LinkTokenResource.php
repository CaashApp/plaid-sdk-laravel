<?php

namespace Indemnity83\Plaid\Resources;

use Indemnity83\Plaid\Casters\DateTimeCaster;
use DateTime;
use Spatie\DataTransferObject\Attributes\DefaultCast;
use Spatie\DataTransferObject\DataTransferObject;

#[
    DefaultCast(DateTime::class, DateTimeCaster::class)
]
class LinkTokenResource extends DataTransferObject
{
    public string $link_token;

    public DateTime $expiration;

    public string $request_id;

    public function isExpired(): bool
    {
        return $this->expiration < new DateTime;
    }
}
