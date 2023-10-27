<?php

namespace App\View\Composers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ProfileImageComposer
{
    protected $profile_image;

    /**
     * Create a new profile composer.
     *
     * @return void
     */
    public function __construct()
    {
        if (Auth::check()) {
            if (isset(auth()->user()->upload->file_path) && Storage::disk('public')->exists(auth()->user()->upload->file_path)) {
                $this->profile_image = asset(Storage::url(auth()->user()->upload->file_path));
            } else {
                $this->profile_image = asset('dist/img/user2-160x160.jpg');
            }
        }
    }

    /**
     * Bind data to the view.
     *
     * @param  \Illuminate\View\View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with([
            'profile_image' => $this->profile_image
        ]);
    }
}
