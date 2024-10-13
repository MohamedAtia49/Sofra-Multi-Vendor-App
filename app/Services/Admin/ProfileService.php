<?php

namespace App\Services\Admin;

use App\Http\Requests\Admin\AdminResetPasswordRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileService{

    public function index(){
        $user = Auth::user();
        return view('admin.profile.profile',compact('user'));
    }

    public function changePassword(Request $request){
        return view('admin.profile.reset_password');
    }

    public function passwordSave(AdminResetPasswordRequest $request)
    {
        $user = User::find(auth()->user()->id);
        if (!Hash::check($request->input('password-old'), $user->password)) {
            return back()->with('error', 'The old password not correct');
        } else
            $user->update([
                'password' => bcrypt($request->password),
            ]);
        return redirect()->back()->with('message','Password Changed');
    }
}
