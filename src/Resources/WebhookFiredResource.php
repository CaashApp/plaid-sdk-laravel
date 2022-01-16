<?php

namespace CaashApp\Plaid\Resources;

use Spatie\DataTransferObject\DataTransferObject;

class WebhookFiredResource extends DataTransferObject
{
    public bool $webhook_fired;

    public string $request_id;
}
