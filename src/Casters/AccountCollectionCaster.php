<?php

namespace CaashApp\Plaid\Casters;

use CaashApp\Plaid\Entities\Account;
use Spatie\DataTransferObject\Caster;

class AccountCollectionCaster implements Caster
{
    public function cast(mixed $accounts): mixed
    {
        return collect($accounts)->map(function ($account) {
            return new Account($account);
        });
    }
}
