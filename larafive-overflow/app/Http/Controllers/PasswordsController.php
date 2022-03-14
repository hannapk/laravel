<?php

namespace App\Http\Controllers;

use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Console\Output\ConsoleOutput;

class PasswordsController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function getRemind() {
        return view('passwords.remind');
    }

    public function postRemind(Request $request)
    {
        $this->validate($request, [
           'email' => 'required|email|exists:users'
        ]);
        $email = $request->get('email');
        $token = str_random(64);
        DB::table('password_resets')->insert([
            'email' => $email,
            'token' => $token,
            'created_at' => Carbon::now()->toDateTimeString()
        ]);

        (new ConsoleOutput())->writeln(route('reset.create', $token));

        return redirect('home');
    }

    public function getReset($token = null)
    {
        return view('passwords.reset', compact('token'));
    }

    public function postReset(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email|exists:users',
            'password' => 'required|confirmed',
            'token' => 'required',
        ]);

        $token = $request->get('token');

        (new ConsoleOutput())->writeln($token);

        if (! DB::table('password_resets')->where('token', '=', $token)->first())
        {
            flash('잘못된 패스워드 변경 요청입니다');
            return redirect('home');
        }
        (new ConsoleOutput())->writeln('found');

        $user = User::whereEmail($request->get('email'))->first();
        $user->update([
            'password' => bcrypt($request->input('password'))
        ]);

        DB::table('password_resets')->where('token', '=', $token)->delete();

        return redirect('home');
    }
}
