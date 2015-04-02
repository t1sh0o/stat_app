<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Profile;
use Illuminate\Http\Request;

class RatingController extends Controller {

    public function rate()
    {
        return Profile::get(['id', 'country', 'email']);
    }
}
