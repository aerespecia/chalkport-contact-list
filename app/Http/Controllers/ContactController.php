<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $inputs = $request->all();

        $user = new User();
        $user->name = $inputs["name"];
        $user->email = $inputs["email"];
        $user->contact_number = $inputs["contactNumber"];
        $user->address = $inputs["address"];
        $user->notes = $inputs["notes"];
        $user->save();

        return $request->input("name");

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $contact = User::findOrFail($id);
        return $contact;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $req, $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $inputs = $request->all();

        $contact = User::findOrFail($id);
        $contact->name = $inputs["name"];
        $contact->email = $inputs["email"];
        $contact->contact_number = $inputs["contactNumber"];
        $contact->address = $inputs["address"];
        $contact->notes = $inputs["notes"];
        $contact->save();

        return $contact->name;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }

    public function softDelete($id)
    {
        $contact = User::findOrFail($id);
        $contact->is_deleted = 1;
        $contact->save();

        return $contact->name;
    }

    public function showAllContacts(){

        $contactList = User::where('is_deleted','!=',1)->get();

        return collect(["data"=>$contactList]);
   }
}
