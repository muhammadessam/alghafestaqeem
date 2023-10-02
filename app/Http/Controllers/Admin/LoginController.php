<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\RateRequest;
use App\Helpers\Constants;
use Illuminate\Http\Request;
use App\Http\Requests\AdminRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function __construct()
    {
       // $this->middleware('auth')->except(['showLoginForm','postLogin']);

        // $this->middleware('checkPermission:dashboard.index')->only(['home']);
    }

    public function showLoginForm()
    {
        return view('admin.login');
    }

    public function postLogin(LoginRequest $request)
    {
        $user = auth()->attempt(['email' => $request->email, 'password' => $request->password], 1);
        if ($user) {
            return redirect()->route('admin.home');
        }

        return back()->withErrors(['message' => 'E-mail or password is wrong'])->withInput($request->only('email', 'remember'));
    }

    public function logout()
    {
        auth()->logout();

        return redirect()->route('admin.home');
    }

    public function home()
    {

        $result['totalRequests'] = RateRequest::count();
        $result['totalCancelledRequests'] = RateRequest::Refused()->count();
        $result['totalSuccessRequests'] = RateRequest::Contacted()->count();
        $result['totalPendingRequests'] = RateRequest::Pending()->count();
        $result['totalInReviewRequests'] = RateRequest::InReview()->count();
        $result['items'] = RateRequest::recent()->take(3)->get();
        $result['statuses'] = Constants::Statuses;

        return view('admin.home', compact('result'));
    }

    public function getProfile()
    {
        $item = User::find(auth()->user()->id);
        return view('admin.profile', compact('item'));
    }

    //

    public function updateProfile(AdminRequest $request)
    {
        $data = $request->all();
        $user = User::find(auth()->user()->id);

        if(! $request->password ){
            $data = $request->except(['_token', '_method','password' ]);
        }
        $user->update($data);
        return redirect()->route('admin.profile')
            ->with('message', __('admin.UpdatedMessage'));
    }
}
