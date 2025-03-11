<?php 

namespace App\Service\Fee;

class AssociationFeeCalculator implements FeeCalculatorInterface
{
    public function calculate(float $vehiclePrice, string $vehicleType): float
    {
        return match (true) {
            $vehiclePrice <= 500 => 5, // $5 for an amount between $1 and $500
            $vehiclePrice <= 1000 => 10, // $10 for an amount greater than $500 up to $1000
            $vehiclePrice <= 3000 => 15, // $15 for an amount greater than $1000 up to $3000
            default => 20, // 'default' if not matched above ($20 for an amount over $3000)
        };
    }

    public function getFeename(): string
    {
        return 'association_fee';
    }
}
