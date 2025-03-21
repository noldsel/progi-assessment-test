<?php 


namespace App\Service;

use App\Service\Fee\FeeCalculatorInterface;

class VehiclePriceCalculator
{
    public function __construct(private array $feeCalculators, private float $storageFee = 100.00)
    {
    }

    public function calculateTotalCost(float $vehiclePrice, string $vehicleType): array
    {
        $fees = [];

        // the first 3 fees are dynamic, so we need to calculate them
        foreach ($this->feeCalculators as $calculator) {
            $feeName = $calculator->getFeeName();
            $fees[$feeName] = $calculator->calculate($vehiclePrice, $vehicleType);
        }

        // storage fee is fixed, no need to calculate
        $fees['storage_fee'] = $this->storageFee;

        return [
            'total_cost' => $vehiclePrice + array_sum($fees),
            'fees' => $fees,
        ];
    }
}
