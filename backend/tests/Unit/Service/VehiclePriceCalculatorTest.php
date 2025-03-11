<?php 

namespace App\Tests\Unit\Service;

use App\Service\VehiclePriceCalculator;
use App\Service\Fee\BasicBuyerFeeCalculator;
use App\Service\Fee\SpecialFeeCalculator;
use App\Service\Fee\AssociationFeeCalculator;
use PHPUnit\Framework\TestCase;

class VehiclePriceCalculatorTest extends TestCase
{
    public function testCalculateTotalCost()
    {
        // Arrange
        $basicBuyerFeeCalculator = $this->createMock(BasicBuyerFeeCalculator::class);
        $specialFeeCalculator = $this->createMock(SpecialFeeCalculator::class);
        $associationFeeCalculator = $this->createMock(AssociationFeeCalculator::class);

        // Define the behavior
        $basicBuyerFeeCalculator->method('calculate')->willReturn(39.800000000000004);
        $basicBuyerFeeCalculator->method('getFeeName')->willReturn('basic_buyer_fee');

        $specialFeeCalculator->method('calculate')->willReturn(7.96);
        $specialFeeCalculator->method('getFeeName')->willReturn('special_fee');

        $associationFeeCalculator->method('calculate')->willReturn(5.00);
        $associationFeeCalculator->method('getFeeName')->willReturn('association_fee');

        // Instantiate the class under test
        $calculator = new VehiclePriceCalculator(
            [$basicBuyerFeeCalculator, $specialFeeCalculator, $associationFeeCalculator],
            100 // storage fee
        );

        // Act: Call the method to test
        $result = $calculator->calculateTotalCost(398, 'Common');

        // Assert: Verify the result
        $this->assertEquals(550.76, $result['total_cost']);
        $this->assertEquals([
            'basic_buyer_fee' => 39.800000000000004,
            'special_fee' => 7.96,
            'association_fee' => 5.00,
            'storage_fee' => 100
        ], $result['fees']);
    }
}
