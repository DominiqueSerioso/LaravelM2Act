<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contact;
use App\Http\Resources\ContactResource;
use App\Http\Resources\ContactResourceCollection;
use App\Http\Controllers\Controller;
class ContactController extends Controller
{
    /**
     * @param Contact $contact
     * @return ContactResource
     *  */    
    public function show(Contact $contact):ContactResource
    {
        return new ContactResource($contact);
    }

    /**
     * 
     */
    public function index(): ContactResourceCollection
    {
        return new ContactResourceCollection(Contact::paginate());
    }

    /**
     * 
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'email' => 'required',
        ]);
        
        $contact = Contact::create($request->all());

        return new ContactResource($contact);
    }

    /**
     * 
     */
    public function update (Contact $contact, Request $request): ContactResource
    {   
        $contact->update($request->all());

        return new ContactResource($contact);
    }

    public function destroy(Contact $contact)
    {
        $contact->delete();

        return response()->json();
    }
}
