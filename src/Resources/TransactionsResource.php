<?php

namespace CaashApp\Plaid\Resources;

use CaashApp\Plaid\Casters\AccountCollectionCaster;
use CaashApp\Plaid\Casters\TransactionCollectionCaster;
use CaashApp\Plaid\Entities\Account;
use CaashApp\Plaid\Entities\Item;
use CaashApp\Plaid\Entities\Transaction;
use Illuminate\Support\Collection;
use Spatie\DataTransferObject\Attributes\CastWith;
use Spatie\DataTransferObject\DataTransferObject;

class TransactionsResource extends DataTransferObject
{
    /** @var Collection<Account> */
    #[CastWith(AccountCollectionCaster::class)]
    public Collection $accounts;

    /** @var Collection<Transaction> */
    #[CastWith(TransactionCollectionCaster::class)]
    public Collection $transactions;

    public int $total_transactions;

    public Item $item;
}
