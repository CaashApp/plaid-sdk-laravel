<?php

namespace CaashApp\Plaid\Entities;

use CaashApp\Plaid\Casters\DateTimeCaster;
use DateTime;
use Money\Money;
use Spatie\DataTransferObject\Attributes\DefaultCast;
use Spatie\DataTransferObject\DataTransferObject;

#[
    DefaultCast(DateTime::class, DateTimeCaster::class)
]
class Transaction extends DataTransferObject
{
    /** @deprecated Please use the payment_channel field */
    public string $transaction_type;

    public ?string $pending_transaction_id;

    public ?string $category_id;

    public ?array $category;

    // TODO: implement location object
    public array $location;

    // TODO: implement payment_meta
    public array $payment_meta;

    public ?string $account_owner;

    public string $name;

    public ?string $original_description;

    public string $account_id;

    public Money $amount;

    public ?string $iso_currency_code;

    public ?string $unofficial_currency_code;

    public DateTime $date;

    public bool $pending;

    public string $transaction_id;

    public ?string $merchant_name;

    public ?int $check_number;

    public string $payment_channel;

    public ?DateTime $authorized_date;

    public ?DateTime $authorized_datetime;

    public ?DateTime $datetime;

    public ?string $transaction_code;

    public ?array $personal_finance_category;
}
