<?php 

namespace App\Controller;

use App\Service\VehiclePriceCalculator;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class VehiclePriceController extends AbstractController
{
    

    public function __construct(private VehiclePriceCalculator $calculator) {}

    // NOTE: for some reasons, I could not get the annotation to work properly,
    // so, i define the routes in config/routes.yaml instead
    // I would have prefered to use annotation for better readability and maintanability

    // /**
    //  * @Route("/api/calculate-vehicle-price", methods={"POST"})
    //  */
    public function calculate(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        
        $vehiclePrice = $data['vehicle_price'];
        $vehicleType = $data['vehicle_type'];

        // NOTE: These validation should be using a proper request validator
        // but in these coding challenge, I am more focused on implementing 
        // best programming practices like DRY, SOLID, etc)
        if (!in_array($vehicleType, ['Common', 'Luxury'])) {
            return new JsonResponse(['error' => 'Invalid vehicle type'], 400);
        }

        $result = $this->calculator->calculateTotalCost($vehiclePrice, $vehicleType);

        return new JsonResponse($result);
    }
}
