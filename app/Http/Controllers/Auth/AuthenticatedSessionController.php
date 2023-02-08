<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Inertia\Inertia;
use Inertia\Testing\Concerns\Has;

class AuthenticatedSessionController extends Controller
{
  /**
   * Display the login view.
   *
   * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
   */
  public function create()
  {
    return redirect('/');
  }

  /**
   * Handle an incoming authentication request.
   *
   * @param \App\Http\Requests\Auth\LoginRequest $request
   * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
   * @throws \Illuminate\Validation\ValidationException
   */
  public function store(Request $request)
  {
    $request->validate([
      'email' => ['required', 'max:50', 'exists:App\Models\User,email'],
      'password' => ['required'],
    ]);

      $user = User::where('email', $request->email)
        ->first();

      if($user === null) {
        $user_phone = User::where('phone', $request->phone)
          ->first();

        if($user_phone !== null) {
          Auth::login($user_phone, $remember = true);

          $this->checkSession($user_phone->id);

        }
      }

      if($user !== null && Hash::check($request->password, $user->password)) {

        Auth::logoutOtherDevices(Hash::make($request->password));

        $this->checkSession($user->id);

        Auth::login($user, $remember = true);

        if(Auth::user()->role === 3) {

          return redirect()->intended(RouteServiceProvider::ADMIN);

        } elseif (Auth::user()->role === 0) {

          if(Auth::user()->checked === 1) {

            User::where('id', Auth::id())->update([
              'checked' => 0,
            ]);

            return redirect()->intended(RouteServiceProvider::HOME);

          } else {

            return redirect()->intended(RouteServiceProvider::HOUSES);

          }

        } else {

          return redirect()->intended(RouteServiceProvider::HOME);

        }

      }

  }

  /**
   * login api
   * @param Request $request
   * @return \Illuminate\Http\JsonResponse
   */

  public function loginApi(Request $request) {

    $request->validate([
      'email' => ['required', 'max:50', 'exists:App\Models\User,email'],
      'password' => ['required'],
    ]);

    $user = User::where('email', $request->email)
      ->first();

    if($user === null) {
      $user = User::where('phone', $request->phone)
        ->first();
    }

    if($user !== null && Hash::check($request->password, $user->password)) {

      $token = $this->checkSession($user->id);

      return response()->json($token, 200);

    } else {

      return response()->json(false, 401);

    }

  }

  /**
   * check auth user and delete session for other device
   * @param $id
   */

  protected function checkSession($id) {
    $session = User\SessionModel::where('user_id', $id)->get();

    if(count($session) !== 0) {
      User\SessionModel::where('user_id', $id)->delete();
    }

    $this->setSession($id);
  }

  /**
   * set session on the yourself device
   * @param $id
   */

  protected function setSession($id) {

    $session = rand(10000, 100000);

    Cookie::queue('session_key', $session);

    User\SessionModel::create([
      'session' => $session,
      'user_id' => $id,
      'active' => 1,
      'created_at' => Carbon::now()->addHour(3),
      'updated_at' => Carbon::now()->addHour(3),
    ]);

    return $this->setToken($id);

  }

  /**
   * set jwt token for user
   * @param $id
   */

  protected function setToken($id) {

    $str = rand();
    $token = hash("sha256", $str);

    User::where('id', $id)->update([
      'token' => $token,
    ]);

    return $token;

  }

  /**
   * Destroy an authenticated session.
   *
   * @param \Illuminate\Http\Request $request
   * @return \Illuminate\Http\RedirectResponse
   */
  public function destroy(Request $request)
  {
    Auth::guard('web')->logout();

    $request->session()->invalidate();

    $request->session()->regenerateToken();

    return redirect('/');
  }
}
