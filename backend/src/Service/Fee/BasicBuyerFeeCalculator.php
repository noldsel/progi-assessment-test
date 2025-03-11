<?php 

namespace App\Service\Fee;

class BasicBuyerFeeCalculator implements FeeCalculatorInterface
{
    public function calculate(float $vehiclePrice, string $vehicleType): float
    {
        // NOTE: as per instruction:
        // Basic buyer fee: 10% of the price of the vehicle
        // - Common: minimum $10 and maximum $50
        // - Luxury: minimum 25$ and maximum 200$
        
        $fee = $vehiclePrice * 0.1;
        
        // There are only 2 vehicle types, 'Luxury' or 'Common'
        // If it's not 'Luxury', then it's 'Common'
        $min = $vehicleType === 'Luxury' ? 25 : 10; // Luxury: minimum 25$, Common: maximum $10
        $max = $vehicleType === 'Luxury' ? 200 : 50; // Luxury: maximum $200, Common: maximum $50

        return max($min, min($fee, $max));
    }

    public function getFeename(): string
    {
        return 'basic_buyer_fee';
    }
}
