<?php

namespace Indemnity83\Plaid\Casters;

use DateTime;
use Exception;
use Spatie\DataTransferObject\Caster;

class DateTimeCaster implements Caster
{
    /**
     * @throws Exception
     */
    public function cast(mixed $value): DateTime
    {
        return new DateTime($value);
    }
}
