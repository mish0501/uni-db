<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function update(ProfileUpdateRequest $request)
    {
        dd($request->all());
    }
}
