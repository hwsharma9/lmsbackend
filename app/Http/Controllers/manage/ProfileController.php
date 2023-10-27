<?php

namespace App\Http\Controllers\manage;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateAdminProfileRequest;
use App\Http\Requests\UpdateProfileImageRequest;
use App\Http\traits\FileUpload;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Str;

class ProfileController extends Controller
{
    use FileUpload;
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function show(Admin $admin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function edit(Admin $admin)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Admin $admin)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function destroy(Admin $admin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function profile()
    {
        $admin = auth()->user();
        // $image = $admin->avatar;
        // if ($image) {
        //     echo Storage::url($image->file_path);
        //     Storage::disk('public')->delete($image->file_path);
        //     dd($image);
        // }
        // die('here');
        return view('admin.profile.profile', compact('admin'));
    }

    public function updateProfile(UpdateAdminProfileRequest $request, Admin $admin)
    {
        $admin->load('upload');
        $admin->fill($request->validated());
        $admin->save();
        return back()->with('success', 'Password updated Successfully');
    }

    public function uploadProfileImage(UpdateProfileImageRequest $request, Admin $admin)
    {
        $path = '';
        if ($request->hasFile('image_file')) {
            $image = $admin->upload;
            $folder = 'admin_profile_images';
            if ($image) {
                Storage::disk('public')->delete($image->file_path);
                $image->delete();
            }
            $path = $this->UploadFile($request->file('image_file'), $folder);
            if (!empty($path)) {
                $admin->upload()->create([
                    'folder' => $folder,
                    'file_path' => $path,
                    'original_name' => $request->file('image_file')->getClientOriginalName(),
                ]);
            }
        }
        return back()->with('image_uploaded', 'Profile Image Uploaded Successfully');
    }

    public function changePassword()
    {
        return view('admin.profile.change-password');
    }

    public function updatePassword(Request $request, Admin $admin)
    {
        $validated = $request->validate([
            'current_password' => ['required', 'current_password'],
            'password' => ['required', Password::defaults(), 'confirmed'],
        ]);

        $admin->update([
            'password' => Hash::make($validated['password']),
        ]);

        return back()->with('success', 'Password updated Successfully');
    }
}
