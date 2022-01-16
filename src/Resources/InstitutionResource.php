<?php

namespace Indemnity83\Plaid\Resources;

use Indemnity83\Plaid\Entities\Institution;
use Spatie\DataTransferObject\DataTransferObject;

class InstitutionResource extends DataTransferObject
{
    public Institution $institution;

    public string $request_id;
}
