<?php 

namespace App\Service\Fee;

class AssociationFeeCalculator implements FeeCalculatorInterface
{
    public function calculate(float $vehiclePrice, string $vehicleType): float
    {
        return match (true) {
            $vehiclePrice <= 500 => 5,
            $vehiclePrice <= 1000 => 10,
            $vehiclePrice <= 3000 => 15,
            default => 20,
        };
    }

    public function getFeename(): string
    {
        return 'association_fee';
    }
}
