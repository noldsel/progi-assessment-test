<?php 

namespace App\Service\Fee;

interface FeeCalculatorInterface
{
    public function calculate(float $vehiclePrice, string $vehicleType): float;

    public function getFeename(): string;
}