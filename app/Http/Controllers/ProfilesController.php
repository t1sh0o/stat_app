<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Profile;
use App\Rating;
use Faker\Factory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class ProfilesController extends Controller {


    private $generatedProfiles;

    private $profile;

    private $rating;

    private $faker;

    private $countries = ['Bulgaria', 'Germany', 'France', 'Russia', 'Turkey'];

    function __construct(Profile $profile, Rating $rating, Factory $faker)
    {
        $this->profile = $profile;

        $this->rating = $rating;

        $this->faker = $faker->create();
    }

     public function generate(Request $request)
    {
        $count = false === $request->has('count')? 0: $request->get('count');

        $this->generateProfiles($count);

        return Redirect::back()->with('flash-message', "{$count} profiles created");
    }

    private function generateProfiles($count)
    {
        for($i = 0; $i < $count; $i++)
        {
            $profile = $this->generateProfile();
        }
    }

    private function generateProfile()
    {
    
        $this->profile->create([
            'username' => $this->faker->userName,
            'password' => $this->faker->word,
            'email' => $this->faker->email,
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'country' => $this->faker->randomElement($this->countries),
            'registration_date' => $this->faker->dateTimeBetween('2014-01-01', '2014-12-31'),
            'is_active' => true,
            'rating' => $this->calculateRating($this->profile)
        ]);
        

    }

    private function calculateRating($profile)
    {
        $rating = $this->rating->create([
            'profile_id' => $profile->id? : 0,
            'country_points' => $this->calculateCountryPoints($profile->country),
            'id_points' => $this->calculateIdPoints($profile->id),
            'reg_date_points' => $this->calculateRegDatePoints($profile->registration_date),
            'stat_decrease_points' => $this->calculateStatDecrasePoints()
        ]);

        return  $this->sumPoints($rating);
    }

    private function sumPoints($rating)
    {
        return  $rating['country_points'] + 
                $rating['id_points'] + 
                $rating['reg_date_points'] + 
                $rating['stat_decrease_points'];
    }

    private function calculateCountryPoints($country)
    {
        switch ($country) {
            case 'Bulgaria':
                return 2;
            case 'Germany':
                return 3;
            case 'France':
                return 4;
            case 'Russia':
                return 5;
            case 'Turkey':
                return 6;
            default:
                return 0;
        }
    }


    private function calculateIdPoints($id)
    {
        if ($id % 3 === 0) {
            return 1;
        }

        
        if ($id % 4 === 0) {
            return 2;
        }

        return 0;
    }

    private function calculateRegDatePoints($date)
    {
        return 0;
    }


    private function calculateStatDecrasePoints()
    {
        return 0;
    }

}
