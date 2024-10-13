<?php

namespace App\Services\Admin;

use App\Models\Client;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactService{
    public function index()
    {
        $records = Contact::paginate(4);
        return view('admin.contacts.index',compact('records'));
    }
    public function destroy($id)
    {
        $record = Contact::find($id);
        $record->delete();
        return redirect()->back();
    }
}
