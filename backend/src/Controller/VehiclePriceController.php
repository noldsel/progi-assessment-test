<?php 

namespace App\Controller;

use App\Service\VehiclePriceCalculator;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class VehiclePriceController extends AbstractController
{
    private $calculator;

    public function __construct(VehiclePriceCalculator $calculator)
    {
        $this->calculator = $calculator;
    }

    /**
     * @Route("/api/calculate-vehicle-price", methods={"POST"})
     */
    public function calculate(Request $request): JsonResponse
    {
        // die('sdfsdf');
        $data = json_decode($request->getContent(), true);
        
        $vehiclePrice = $data['vehicle_price'];
        $vehicleType = $data['vehicle_type'];

        // Validate input
        if (!in_array($vehicleType, ['Common', 'Luxury'])) {
            return new JsonResponse(['error' => 'Invalid vehicle type'], 400);
        }

        $totalCost = $this->calculator->calculateTotalCost($vehiclePrice, $vehicleType);
        $basicBuyerFee = $this->calculator->calculateBasicBuyerFee($vehiclePrice, $vehicleType);
        $specialFee = $this->calculator->calculateSpecialFee($vehiclePrice, $vehicleType);
        $associationFee = $this->calculator->calculateAssociationFee($vehiclePrice);

        return new JsonResponse([
            'total_cost' => $totalCost,
            'fees' => [
                'basic_buyer_fee' => $basicBuyerFee,
                'special_fee' => $specialFee,
                'association_fee' => $associationFee,
                'storage_fee' => 100,
            ],
        ]);
    }
}
