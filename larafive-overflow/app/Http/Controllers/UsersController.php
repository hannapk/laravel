<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Symfony\Component\Console\Output\ConsoleOutput;

class UsersController extends Controller
{
    /**
     * 사용자 가입 Form View 조회
     *
     * @return Factory|Application|View
     */
    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);

        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
            'confirm_code' => str_random(60),
        ]);

        (new ConsoleOutput())->writeln(route('users.confirm', $user->confirm_code));

        return redirect('home');
    }

    public function confirm($code)
    {
        $user = User::whereConfirmCode($code)->first();

        if(! $user) {
            flash("유효하지 않은 code 입니다");
            return redirect('home');
        }

        $user->activated = 1;
        $user->confirm_code = null;
        $user->save();

        auth()->login($user);

        return redirect('home');
    }
}
