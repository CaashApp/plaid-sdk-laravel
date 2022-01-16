<?php

namespace CaashApp\Plaid\Resources;

use CaashApp\Plaid\Entities\Institution;
use Spatie\DataTransferObject\DataTransferObject;

class InstitutionResource extends DataTransferObject
{
    public Institution $institution;

    public string $request_id;
}
