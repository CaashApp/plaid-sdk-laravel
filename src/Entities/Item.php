<?php

namespace Indemnity83\Plaid\Entities;

use DateTime;
use Spatie\DataTransferObject\DataTransferObject;

class Item extends DataTransferObject
{
    public string $item_id;

    public ?string $institution_id;

    public ?string $webhook;

    public ?Error $error;

    public array $available_products;

    public array $billed_products;

    public array $products;

    public ?DateTime $consent_expire_time;

    public string $update_type;
}
