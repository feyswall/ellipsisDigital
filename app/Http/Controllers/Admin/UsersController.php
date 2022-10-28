<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;



class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::role('userRole')->paginate(10);
        return view('admin.users.index')
            ->with('users', $users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     */
    public function show(User $user)
    {
        return view('admin.users.showUser')
            ->with('user', $user);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     */
    public function edit(User $user)
    {
        return view('admin.users.editUser')
            ->with('user', $user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     */
    public function update(Request $request, User $user)
    {
        $fields = [
            'name' => ['required', 'string', 'max:255'],
        ];
        $passed_fields = ['name' => $request->name, 'email' => $request->email];

        if ( $user->email != $request->email ){
            $fields['email'] = ['required', 'string', 'email', 'max:255', 'unique:users'];
        }

        if ( $request->password != null ){
            $fields['password'] = ['required', 'confirmed', Rules\Password::defaults()];
            $passed_fields['password'] = Hash::make($request->password);
        }

        $request->validate($fields);

        $user->update( $passed_fields );

        return redirect()->route('admin.user.show', $user )->with('status', 'user updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     */
    public function destroy(User $user)
    {
        $name = $user->name;
        $user->delete();
        return redirect()->route('admin.user.index')->with('status', 'User With name '.$name.' was deleted successfully');
    }
}
