<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Middleware;
use Stevebauman\Location\Facades\Location;
use Tightenco\Ziggy\Ziggy;

class HandleInertiaRequests extends Middleware
{
  /**
   * The root template that is loaded on the first page visit.
   *
   * @var string
   */
  protected $rootView = 'app';

  /**
   * Determine the current asset version.
   *
   * @param \Illuminate\Http\Request $request
   * @return string|null
   */
  public function version(Request $request)
  {
    return parent::version($request);
  }

  /**
   * Define the props that are shared by default.
   *
   * @param \Illuminate\Http\Request $request
   * @return mixed[]
   */
  public function share(Request $request)
  {

    $ip = $request->ip();
    $currentUserInfo = Location::get($ip);
    $check = false;

    if (Auth::check()) {
      $user = Auth::user()->openClient;
    } else {
      $user = null;
    }

    if($user === null) {
      if ($ip === '127.0.0.1') {
        $check = true;
      } else {
        if ($currentUserInfo->countryCode !== 'TR') {
          $check = true;
        }
      }
    } else {
      if ($ip === '127.0.0.1') {
        $check = true;
      } else {

        if ($user) {
          $check = true;
        } else if ($currentUserInfo->countryCode !== 'TR') {
          $check = true;
        }
      }
    }

    return array_merge(parent::share($request), [
      'check' => $check,
      'auth' => [
        'user' => $request->user(),
      ],
      'ziggy' => function () use ($request) {
        return array_merge((new Ziggy)->toArray(), [
          'location' => $request->url(),
        ]);
      },
    ]);
  }
}
