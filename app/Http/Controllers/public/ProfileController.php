<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\admin\bph\tentang_ukmbsm\ManageProfile;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        $title = 'Profile Page';
        $description = 'Discover the profile of UKMBSM ITERA, the vibrant music community at Institut Teknologi Sumatera (ITERA). Learn about our mission, vision, and the passionate members who make up our organization.';
        $keywords = 'UKMBSM, ITERA, music community, student organization, music events, ITERA music club';
        $author = 'UKMBSM ITERA';

        $profile = ManageProfile::first();

        return view('public.about.profile', compact('title', 'description', 'keywords', 'author', 'profile'));
    }
}
