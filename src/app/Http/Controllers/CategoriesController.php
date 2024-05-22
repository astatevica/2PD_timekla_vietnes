<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Models\Categories;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;


class CategoriesController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            'auth',
        ];
    }


    // display all Authors
    public function list():View
    {
        $items = Categories::orderBy('name', 'asc')->get();
        return view(
            'categories.list',
            [
                'title' => 'Kategorijas',
                'items' => $items,
            ]
        );
    }

    //display new Author form
    public function create():View
    {
        return view(
            'categories.form',
            [
                'title' => 'Pievienot kategoriju',
                'categorie' => new Categories,
            ]
        );
    }

    // creates new Author data
    public function put(Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
        ]);
    
        $categorie = new Categories();
        $categorie->name = $validatedData['name'];
        $categorie->save();
    
        return redirect('/categories');
    }

    //display Author edit form
    public function update(Categories $categorie):View
    {
        return view(
            'categories.form',
            [
                'title' => 'Rediģēt kategoriju',
                'categorie' => $categorie,
            ]
        );
    }

    // update Author data
    public function patch(Categories $categorie, Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
        ]);
    
        $categorie->name = $validatedData['name'];
        $categorie->save();
    
        return redirect('/categories');
    }

    // delete Author
    public function delete(Categories $categorie): RedirectResponse
    {
        // šeit derētu pārbaude, kas neļauj dzēst autoru, ja tas piesaistīts eksistējošām grāmatām
        $categorie->delete();
        return redirect('/categories');
    }



}