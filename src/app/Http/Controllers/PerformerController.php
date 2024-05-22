<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Models\Performer;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;

class PerformerController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            'auth',
        ];
    }


    // display all Performers
    public function list():View
    {
        $items = Performer::orderBy('name', 'asc')->get();
        return view(
            'performer.list',
            [
                'title' => 'Izpildītāji',
                'items' => $items,
            ]
        );
    }

    //display new Performer form
    public function create():View
    {
        return view(
            'performer.form',
            [
                'title' => 'Pievienot izpidītāju',
                'performer' => new Performer,
            ]
        );
    }

    // creates new Performer data
    public function put(Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
        ]);
    
        $performer = new Performer();
        $performer->name = $validatedData['name'];
        $performer->save();
    
        return redirect('/performers');
    }

    //display Performer edit form
    public function update(Performer $performer):View
    {
        return view(
            'performer.form',
            [
                'title' => 'Rediģēt izpildītāju',
                'performer' => $performer,
            ]
        );
    }

    // update Performer data
    public function patch(Performer $performer, Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
        ]);
    
        $performer->name = $validatedData['name'];
        $performer->save();
    
        return redirect('/performers');
    }

    // delete Performer
    public function delete(Performer $performer): RedirectResponse
    {
        // šeit derētu pārbaude, kas neļauj dzēst autoru, ja tas piesaistīts eksistējošām grāmatām
        $performer->delete();
        return redirect('/performers');
    }



}
