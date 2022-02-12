<?php

namespace CaashApp\Plaid\Casters;

use CaashApp\Plaid\Entities\Balances;
use Money\Currencies\ISOCurrencies;
use Money\Currency;
use Money\Money;
use Money\Parser\DecimalMoneyParser;
use Spatie\DataTransferObject\Caster;

class BalanceCaster implements Caster
{
    public function cast(mixed $value): mixed
    {
        return new Balances(array_merge($value, [
            'available' => $this->parseMoney($value, 'available'),
            'current' => $this->parseMoney($value, 'current'),
            'limit' => $this->parseMoney($value, 'limit'),
        ]));
    }

    protected function parseMoney(mixed $value, string $key): ?Money
    {
        if (! isset($value[$key]) || is_null($value[$key])) {
            return null;
        }

        $currencyCode = $value['iso_currency_code'] ?? $value['unofficial_currency_code'];
        $moneyParser = new DecimalMoneyParser(new ISOCurrencies());

        return $moneyParser->parse((string) $value[$key], new Currency($currencyCode));
    }
}
