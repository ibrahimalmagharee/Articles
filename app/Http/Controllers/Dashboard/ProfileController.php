<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\ProfileRequest;
use App\Models\Admin;
use Illuminate\Http\Request;

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

        if ($request->filled('password')) {
            $request->merge(['password' => bcrypt($request->password)]);
        }
        unset($request['id'], $request['password_confirmation']);
        $filePath = '';
        if ($request->password == null) {
            if ($request->has('image')) {
                $image_path = public_path('assets/images/admin/profile/') . $admin->image;
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

        } else {
            if ($request->has('image')) {
                $image_path = public_path('assets/images/admin/profile/') . $admin->image;
                if ($admin->image != 'logo.png') {
                    unlink($image_path);
                }
                $filePath = uploadImage('profile', $request->image);
                $admin->update([
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => $request->password,
                    'image' => $filePath,
                ]);

            } else {
                $admin->update([
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => $request->password,
                ]);
            }


        }


        $notification = array(
            'message' => 'The Personal Profile Is Updated',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);

    }
}
