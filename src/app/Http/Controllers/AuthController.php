<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    // display login form
public function login(): View
{

//$2y$12$IyP1TEoDzTPOQWY8hP.8ney3OFonOvhumqkfx4PCfyzJO2Kbgq9HC
//lv: guest
//pr: guest
    return view(
        'auth.login',
        [
            'title' => 'Pieslēgties'
        ]
    );
}
 
// authenticate user
public function authenticate(Request $request): RedirectResponse
{
    $credentials = $request->only('name', 'password');
 
    if (Auth::attempt($credentials)) {
 
        $request->session()->regenerate();
 
        // Šo vēlāk nomainīsim uz /books
        return redirect('/books');
    }
 
    return back()->withErrors([
        'name' => 'Pieslēgšanās neveiksmīga',
    ]);
}

// end user session
public function logout(Request $request): RedirectResponse
{
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();

    //šeit tiek izbeigta php sesija un lietotāju pāradresē uz sākumlapu

    return redirect('/');
}

}
