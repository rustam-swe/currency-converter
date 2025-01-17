<?php

declare(strict_types=1);

class Currency
{
    const string CB_URL = "https://cbu.uz/uz/arkhiv-kursov-valyut/json/";
    private int $usdIndex = 0;

    public function exchange(float|int $uzs): float|int
    {
        $usd = $this->customCurrencies()['USD'];
        return $uzs / $usd;
    }

    public function getCurrencyInfo()
    {
        $currencyInfo = file_get_contents(self::CB_URL);
        return json_decode($currencyInfo);
    }

    public function customCurrencies(): array
    {
        $currencies        = (array) $this->getCurrencyInfo();
        $orderedCurrencies = [];
        foreach ($currencies as $currency) {
            $orderedCurrencies[$currency->Ccy] = $currency->Rate;
        }

        return $orderedCurrencies;
    }
}