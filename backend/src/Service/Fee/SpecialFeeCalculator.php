<?php 

namespace App\Service\Fee;

class SpecialFeeCalculator implements FeeCalculatorInterface
{
    public function calculate(float $vehiclePrice, string $vehicleType): float
    {
        // Note: as per instruction:
        // The seller's special fee:
        // - Common: 2% of the vehicle price
        // - Luxury: 4% of the vehicle price

        // There are only 2 vehicle types, 'Luxury' or 'Common'
        // If it's not 'Luxury', then it's 'Common'
        return $vehicleType === 'Luxury' ? ($vehiclePrice * 0.04) : ($vehiclePrice * 0.02);
    }
    
    public function getFeename(): string
    {
        return 'special_fee';
    }
}
