<?php 

namespace App\Service\Fee;

class SpecialFeeCalculator implements FeeCalculatorInterface
{
    public function calculate(float $vehiclePrice, string $vehicleType): float
    {
        return $vehicleType === 'Luxury' ? $vehiclePrice * 0.04 : $vehiclePrice * 0.02;
    }
    
    public function getFeename(): string
    {
        return 'special_fee';
    }
}
