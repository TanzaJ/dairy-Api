<?php

namespace Vanier\Api\Models;
use Vanier\Api\Helpers\WebServiceInvoker;

class RecipesModel
{
    public function fetchRecipes(array $filters): mixed
    {
        $finalRecipes = array();
        $ws_invoker = new WebServiceInvoker([]);
        $uri = "https://api.spoonacular.com/recipes/findByIngredients?apiKey=52f98e558d7a4e0182e8352289235bdf";

        if(isset($filters['ingredients']) && strlen($filters['ingredients']) > 0)
        {
            $ingredients = explode(',', $filters['ingredients']);
            $uri .= "&ingredients=";
            foreach($ingredients as $ingredient){
                $uri .= $ingredient;
                if ($ingredient !== array_key_last($ingredients)) {
                    $uri .= ",+";
                }
            }
        }
        if(isset($filters['recipesMaxNum']) && $filters['recipesMaxNum'] > 0)
        {
            $uri .= "&number=" . $filters['recipesMaxNum'];
        }

        $recipes = $ws_invoker->invokeUri($uri);

        if ($recipes != null){
            foreach ($recipes as $recipe) {
                $finalRecipe = $this->getRecipeById($recipe->id);

                if ($finalRecipe === null){
                    continue;
                }
                else{
                    array_push($finalRecipes, $finalRecipe);
                }
            }            
        }
        return $finalRecipes;
    }

    public function getRecipeById($id){
        $ws_invoker = new WebServiceInvoker([]);
        $uri = "https://api.spoonacular.com/recipes/" . $id . "/information?apiKey=52f98e558d7a4e0182e8352289235bdf";
        $recipe = $ws_invoker->invokeUri($uri);

        if($recipe === null){
            return null;
        }
        else{
            return $recipe;
        }

    }
}
