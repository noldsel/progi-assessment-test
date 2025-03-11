<?php 

namespace App\Service\Fee;

class BasicBuyerFeeCalculator implements FeeCalculatorInterface
{
    public function calculate(float $vehiclePrice, string $vehicleType): float
    {
        $fee = $vehiclePrice * 0.1;
        $min = $vehicleType === 'Luxury' ? 25 : 10;
        $max = $vehicleType === 'Luxury' ? 200 : 50;

        return max($min, min($fee, $max));
    }

    public function getFeename(): string
    {
        return 'basic_buyer_fee';
    }
}
