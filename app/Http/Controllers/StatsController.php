<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StatsController extends Controller {

    /**
     * @var Profile
     */
    public $profile;

    function __construct(Profile $profile)
    {
        $this->profile = $profile;
    }

    /**
     * Fetch statistics information separated per quartile of reg date
     *
     * @return \Illuminate\View\View
     */
    public function quartile()
    {
        $stats = $this->profile
                ->select(DB::raw('QUARTER(registration_date) as quartile, count(*) as count'))
                ->groupBy(DB::raw('QUARTER(registration_date)'))
                ->get();

        return view('quartile', compact('stats'));
    }

    /**
     * Fetch statistics information separated per rating
     *
     * @return \Illuminate\View\View
     */
    public function rating()
    {
        $stats = $this->profile
                    ->select('rating', DB::raw('count(*) as count'))
                    ->groupBy('rating')
                    ->get();

        return view('rating', compact('stats'));
    }
}
