<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Symfony\Component\Console\Output\ConsoleOutput;

class SessionsController extends Controller
{
    public function __construct()
    {
        $this->addAuthorization();
    }

    protected function addAuthorization()
    {
        $this->middleware('guest', [
            'except' => 'destroy'
        ]);
    }

    /**
     * 로그인 Form View 반환
     *
     * @return Factory|Application|View
     */
    public function create()
    {
        return view('sessions.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        if (!auth()->attempt($request->only('email', 'password'), $request->has('remember'))) {
            flash('로그인에 실패했습니다');
            return back()->withInput();
        }

        if (!auth()->user()->activated) {
            flash('가입이 인증되지 않았습니다');
            auth()->logout();
            return redirect('home');
        }

        return redirect()->intended('home');
    }

    public function destroy()
    {
        auth()->logout();
        return redirect('home');
    }
}
