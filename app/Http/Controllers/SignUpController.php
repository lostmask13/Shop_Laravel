<?php

namespace App\Http\Controllers;

use App\Http\Requests\SignUpRequest;
use App\Mail\EmailConfirm;
use App\Models\User;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class SignUpController extends Controller
{
    public function signUpForm()
    {
        return view('sign-up');
    }

    public function signUp(SignUpRequest $request)
    {
        $data = $request->validated();

        $user = new User($data);
        $user->save();

        Mail::to($user)->send(new EmailConfirm($user));

        session()->flash('success', 'Success!');

        return redirect()->route('main');
    }

    public function verifyEmail(int $id, string $hash, Request $request)
    {
        if (!$request->hasValidSignature()) {
            abort(403);
        }

        $user = User::query()->findOrFail($id);

        if (!hash_equals($hash, sha1($user->email))) {
            abort(403);
        }

        $user->email_verified_at = new DateTime();
        $user->save();

        return redirect()->route('main');
    }
}
