<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $user;

    /**
     * construct method for user model
     * 
     * @param User $user
     * @return 
     */
    public function __construct(User $user)
    {
        // $this->middleware('auth')->except('/', '/store');
        $this->user = $user;
    }

    /**
     * show registraion page
     * 
     * @param
     * @return
     */
    public function create()
    {
        return view('registration');
    }

    /**
     * store registration user details
     * 
     * @param Request $request
     * @return Response json
     */
    public function store(UserRequest $request)
    {
        // dd($request->all());
        // $this->authorize('request', $request);
        $validated = $request->validated();
        $saved = $this->user->storeUser($request->all());
        if ($saved) {
            return response()->json(['message' => "Registration Successfully"]);
        }
        return response()->json(['message' => "Something went wrong"]);
    }

    /**
     * thank you page
     * 
     * @param
     * @return
     */
    public function thankyou()
    {
        return view('welcome');
    }
}
