<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{

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
