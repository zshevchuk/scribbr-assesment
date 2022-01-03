<?php

namespace App\Controller;

use App\Model\PredictionSearcher;
use App\Model\Scale\CelsiusBaseScale;
use App\Model\Search;
use App\Utils\ViolationConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\ConstraintViolationListInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class SearchController extends AbstractController
{
    public function __construct(protected ValidatorInterface $validator, protected PredictionSearcher $predictionSearcher, protected ViolationConverter $violationConverter) {}

    #[Route('/search', name: 'search')]
    public function searchBar(Request $request): Response
    {
        $form = $this->getForm();
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $task = $form->getData();
            $scale = $task->getScale();
            $date = $task->getDate();

            $output = $this->predictionSearcher->process($scale, $date);
        }

        return $this->render('search/search_bar.html.twig', [
            'form' => $form->createView(),
            'table' => $output ?? [],
            'scale' => $scale ?? ''
        ]);
    }

    #[Route('/api/v1/predictions', name: 'api_search')]
    public function getPredictions(Request $request): Response
    {
        $date = $this->getDate();
        $date = $request->query->get('date') ?? 'now';
        $scale = $request->query->get('scale');


        $date = new \DateTime($date);

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

    protected function getForm(): FormInterface
    {
        $search = new Search();

        return $this->createFormBuilder($search)
            ->add('date', DateType::class, [
                'widget' => 'single_text',
                'data' => new \DateTime('now')
            ])
            ->add('scale', ChoiceType::class, [
                'choices' => CelsiusBaseScale::getScalesMap(),
            ])
            ->add('submit', SubmitType::class, [
                'attr' => [
                    'class' => 'btn btn-primary'
                ]
            ])
            ->getForm();
    }
}
