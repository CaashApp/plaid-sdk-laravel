<?php

namespace CaashApp\Plaid\Casters;

use CaashApp\Plaid\Entities\Transaction;
use Money\Currencies\ISOCurrencies;
use Money\Currency;
use Money\Money;
use Money\Parser\DecimalMoneyParser;
use Spatie\DataTransferObject\Caster;

class TransactionCollectionCaster implements Caster
{
    public function cast(mixed $transactions): mixed
    {
        return collect($transactions)->map(function ($transaction) {
            return new Transaction(array_merge($transaction, [
                'amount' => $this->parseMoney($transaction, 'amount'),
            ]));
        });
    }

    protected function parseMoney(mixed $value, string $key): ?Money
    {
        if (! isset($value[$key]) || is_null($value[$key])) {
            return null;
        }

        $currencyCode = $value['iso_currency_code'] ?? $value['unofficial_currency_code'];
        $moneyParser = new DecimalMoneyParser(new ISOCurrencies());

        return $moneyParser->parse($value[$key], new Currency($currencyCode));
    }
}
