<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use App\Models\UserRole;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $roles=UserRole::all();
        return view('auth.register' ,["roles"=>$roles]);
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'username' =>['required', 'string', 'max:255', 'unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        if($request->role == '3')
        {
            $user = User::create([
                'name' => $request->name,
                'username'=> $request->username,
                'role'=>$request->role,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'activated' => 1,
            ]);
        }
        else
        {$user = User::create([
            'name' => $request->name,
            'username'=> $request->username,
            'role'=>$request->role,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
    }
        event(new Registered($user));
if($request->role =='3')
        {Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
        }
        return redirect()-> route('blog.index');
    }
}
