<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\ChangePasswordRequest;
use App\Http\Requests\Dashboard\ProfileRequest;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function edit()
    {
        $admin = Admin::find(auth('admin')->user()->id);
        return view('admin.profile.edit', compact('admin'));
    }

    public function update(ProfileRequest $request)
    {

        $admin = Admin::find(auth('admin')->user()->id);

        $filePath = '';

            if ($request->has('image')) {
                $image_path = public_path('assets/images/profile/') . $admin->image;
                if ($admin->image != 'logo.png') {
                    unlink($image_path);
                }
                $filePath = uploadImage('profile', $request->image);
                $admin->update([
                    'name' => $request->name,
                    'email' => $request->email,
                    'image' => $filePath,
                ]);

            } else {
                $admin->update([
                    'name' => $request->name,
                    'email' => $request->email,
                ]);

            }


        $notification = array(
            'message' => 'The Personal Profile Is Updated',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);

    }

    public function changePassword()
    {
        $admin = Admin::find(auth('admin')->user()->id);
        return view('admin.profile.changePassword', compact('admin'));
    }

    public function updatePassword(ChangePasswordRequest $request)
    {
        $admin = Auth::guard('admin')->user();

        if (Hash::check($request->input('old_password'), $admin->password)) {
            $admin = Admin::where('id', $admin->id)->update([
                'password' => bcrypt($request->password)
            ]);

            $notification = array(
                'message' => 'Password changed successfully',
                'alert-type' => 'success'
            );
            return redirect()->route('admin.dashboard')->with($notification);

        } else {
            $notification = array(
                'message' => 'The old password is incorrect',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }

    }

}
