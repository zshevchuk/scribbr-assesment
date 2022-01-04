<?php

namespace App\Controller;

use App\Model\PredictionSearcher;
use App\Model\Search;
use App\Utils\ViolationConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class SearchController extends AbstractController
{
    public function __construct(
        protected ValidatorInterface $validator,
        protected PredictionSearcher $predictionSearcher,
        protected ViolationConverter $violationConverter,
    ) {}

    #[Route('/api/v1/predictions', name: 'api_search')]
    public function getPredictions(Request $request): Response
    {
        $date = $request->query->get('date') ;
        $scale = $request->query->get('scale');

        $search = new Search($date, $scale);
        $violations = $this->validator->validate($search);

        if (count($violations) > 0) {
            return $this->json($this->violationConverter->violationsToArray($violations), RESPONSE::HTTP_UNPROCESSABLE_ENTITY);
        }

        $output = $this->predictionSearcher->process($scale, $date);

        return $this->json([
            'input_date' => [
                'scale' => $scale,
                'date' => $date,
            ],
            'results' => $output,
        ]);
    }
}
