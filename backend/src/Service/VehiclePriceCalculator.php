<?php 


namespace App\Service;

class VehiclePriceCalculator
{
    public function calculateBasicBuyerFee(float $vehiclePrice, string $vehicleType): float
    {
        $fee = $vehiclePrice * 0.1;
        $min = $vehicleType === 'Luxury' ? 25 : 10;
        $max = $vehicleType === 'Luxury' ? 200 : 50;
        
        return max($min, min($fee, $max));
    }

    public function calculateSpecialFee(float $vehiclePrice, string $vehicleType): float
    {
        return $vehicleType === 'Luxury' ? $vehiclePrice * 0.04 : $vehiclePrice * 0.02;
    }

    public function calculateAssociationFee(float $vehiclePrice): float
    {
        if ($vehiclePrice <= 500) {
            return 5;
        } elseif ($vehiclePrice <= 1000) {
            return 10;
        } elseif ($vehiclePrice <= 3000) {
            return 15;
        } else {
            return 20;
        }
    }

    public function calculateTotalCost(float $vehiclePrice, string $vehicleType): float
    {
        $basicBuyerFee = $this->calculateBasicBuyerFee($vehiclePrice, $vehicleType);
        $specialFee = $this->calculateSpecialFee($vehiclePrice, $vehicleType);
        $associationFee = $this->calculateAssociationFee($vehiclePrice);
        $storageFee = 100;

        return $vehiclePrice + $basicBuyerFee + $specialFee + $associationFee + $storageFee;
    }
}
