<?php

namespace CaashApp\Plaid\Entities;

use Spatie\DataTransferObject\DataTransferObject;

class PlaidStatus extends DataTransferObject
{
    public ?InvestmentStatus $investments;

    public ?TransactionStatus $transactions;

    public ?WebhookStatus $last_webhook;
}
