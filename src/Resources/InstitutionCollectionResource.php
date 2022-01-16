<?php

namespace CaashApp\Plaid\Resources;

use CaashApp\Plaid\Entities\Institution;
use Spatie\DataTransferObject\DataTransferObject;

class InstitutionCollectionResource extends DataTransferObject
{
    /** @var Institution[] */
    public array $institutions;

    public ?int $total;

    public string $request_id;
}
