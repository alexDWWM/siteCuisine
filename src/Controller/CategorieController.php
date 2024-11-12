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

class CategorieController extends AbstractController
{
    #[Route('/categorie', name: 'app_categorie')]
    public function index(CategorieRepository $cr,IngredientRepository $ing, SaisonRepository $sr, BudgetRepository $br): Response
    {
        $categorie = $cr->findAll();
        $saison = $sr->findAll();
        $budget = $br->findAll();
        $ingredient = $ing->findAll();

        return $this->render('categorie/index.html.twig', [
            'controller_name' => 'CategorieController',
            'categorie' => $categorie,
            'saison' => $saison,
            'budget' => $budget,
            'ingredient' => $ingredient,
        ]);
    }
    
    #[Route('/categorie/{id}', name: 'app_categorie_show')]
    public function show(CategorieRepository $cr,CommentaireRepository $cor, $id, SaisonRepository $sr,IngredientRepository $ing, BudgetRepository $br ): Response
    {
        $categorie = $cr->findAll();
        $categorieId = $cr->find($id);
        $saison = $sr->findAll();
        $budget = $br->findAll();
        $ingredient = $ing->findAll();
        $recettes = $categorieId->getRecettes();dump($recettes);
        $averageNotes = [];

        //affichage de la note
        foreach ($recettes as $recette) {
            $commentaires = $cor->findBy(['recette' => $recette]);
            $totalNotes = 0;
            $count = count($commentaires);

            foreach ($commentaires as $commentaire) {
                $totalNotes += (float)$commentaire->getNote();
            }

            $averageNotes[$recette->getId()] = $count > 0 ? $totalNotes / $count : null;
        }

        return $this->render('categorie/show.html.twig', [
            
            'averageNotes' => $averageNotes,
            'categorie' => $categorie,
            'categorieId' => $categorieId,
            'saison' => $saison,
            'budget' => $budget,
            'ingredient' => $ingredient,
            'recettes' => $recettes,
            ]);
    }

}