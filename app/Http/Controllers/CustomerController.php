<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use App\Models\User;
use App\Mail\UserCreated;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('Customer/CustomerRegister');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         $validateData = $request->validate([
            'first_name' => 'required|min:3|string',
            'last_name' => 'required|min:3|string',
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::create([
            'first_name' => $validateData['first_name'],
            'last_name' => $validateData['last_name'],
            'email' => $validateData['email'],
            'password' => bcrypt($validateData['password']),
            'role' => 'customer',
            'isVerified' => false
        ]);

        $password = $request->password;
        $mailMessage = Mail::to($user)->send(new UserCreated($user, $password));

        if($mailMessage) {
            \Log::info("Mail sent successfully.");
        } else {
            \Log::info("Mail sending error.");
        }

        return redirect()->route('customer.register')->with('success', 'Customer Register Successful. Please check your mail for verification!');

    }

    public function verification($id) {
        $user = User::where('id', $id)->first();
        if($user) {
            $user->isVerified = true;
            $user->save();
            return Inertia::render('Verification');
        } else {
            return Redirect('/');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
