<?php

namespace App\Controller;

use App\Repository\BudgetRepository;
use App\Repository\CategorieRepository;

use App\Repository\CommentaireRepository;

use App\Repository\IngredientRepository;
use App\Repository\RecetteRepository;
use App\Repository\SaisonRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class SaisonController extends AbstractController
{
    #[Route('/saison', name: 'app_saison')]
    public function index(CategorieRepository $cr,IngredientRepository $ing, SaisonRepository $sr, BudgetRepository $br): Response
    {
        $categorie = $cr->findAll();
        $saison = $sr->findAll();
        $budget = $br->findAll();
        $ingredient = $ing->findAll();

        return $this->render('saison/index.html.twig', [
            'categorie' => $categorie,
            'saison' => $saison,
            'budget' => $budget,
            'ingredient' => $ingredient,
        ]);
    }

    #[Route('saison/show/{id}', name: 'app_saison_show')]


    public function show(CategorieRepository $cr,CommentaireRepository $cor,IngredientRepository $ing, $id, SaisonRepository $sr, BudgetRepository $br, RecetteRepository $rr): Response

    {
        $categorie = $cr->findAll();
        $saison = $sr->findAll();
        $budget = $br->findAll();
        $ingredient = $ing->findAll();
        $targetSaison = $sr->find($id);

        $recettes = $rr->findAll();

        foreach ($recettes as $recette) {
            $commentaires = $cor->findBy(['recette' => $recette]);
            $totalNotes = 0;
            $count = count($commentaires);

            foreach ($commentaires as $commentaire) {
                $totalNotes += (float)$commentaire->getNote();
            }

            $averageNotes[$recette->getId()] = $count > 0 ? $totalNotes / $count : null;
        }

       

        return $this->render('saison/show.html.twig', [
            'categorie' => $categorie,
            'saison' => $saison,
            'budget' => $budget,
            'ingredient' => $ingredient,
            'targetSaison' => $targetSaison,
            'recette' => $recettes,
            'averageNotes' => $averageNotes,            
        ]);
    }
}
