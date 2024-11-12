<?php

namespace App\Controller;

use App\Repository\BudgetRepository;
use App\Repository\CategorieRepository;
use App\Repository\CommentaireRepository;
use App\Repository\IngredientRepository;
use App\Repository\SaisonRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class CategorieController extends AbstractController
{ //Affichage des categories
    #[Route('/categorie', name: 'app_categorie')]
    public function index(CategorieRepository $cr): Response
    {
        // Variable pour afficher totutes les catégories
        $categorie = $cr->findAll();

        return $this->render('categorie/index.html.twig', [
            'categorie' => $categorie,
        ]);
    }
    
    #[Route('/categorie/{id}', name: 'app_categorie_show')]
    public function show(CategorieRepository $cr,CommentaireRepository $cor, $id): Response
    {
       
        $categorieId = $cr->find($id);
<<<<<<< HEAD
        $saison = $sr->findAll();
        $budget = $br->findAll();
        $ingredient = $ing->findAll();
        $recettes = $categorieId->getRecettes();dump($recettes);
=======
        $recettes = $categorieId->getRecettes();
>>>>>>> refs/remotes/origin/alex
        $averageNotes = [];
        // Retourner si aucune recette n'est trouvée
        if ($recettes[0] != null){
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
            'categorieId' => $categorieId,
            'recettes' => $recettes,
            ]);
        }else{
            return  $this->render('categorie/recetteNull.html.twig', [
            
                'averageNotes' => $averageNotes,
                'categorieId' => $categorieId,
                'recettes' => $recettes,
                ]);
       
        }
    }
}