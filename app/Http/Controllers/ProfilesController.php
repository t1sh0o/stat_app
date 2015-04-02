<?php namespace App\Http\Controllers;

use App\Events\ProfileWasGenerated;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Profile;
use Faker\Factory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class ProfilesController extends Controller {

    /**
     * @var Profile
     */
    private $profile;

    /**
     * @var \Faker\Generator
     */
    private $faker;

    /**
     * @var array
     */
    private $countries = ['Bulgaria', 'Germany', 'France', 'Russia', 'Turkey'];

    /**
     * @param Profile $profile
     * @param Factory $faker
     */
    function __construct(Profile $profile, Factory $faker)
    {
        $this->profile = $profile;

        $this->faker = $faker->create();
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function generate(Request $request)
    {
        $count = false === $request->has('count')? 0: $request->get('count');

        $this->generateProfiles($count);

        return Redirect::back()->with('flash-message', "{$count} profiles created");
    }

    /**
     * @param $email
     * @return mixed
     */
    public function getRating(Request $request)
    {
        $email = $request->get('email');

        try {
            $profile = $this->profile->where('email', $email)->with('ratingRules')->firstOrFail();
        } 
        catch (\Exception $e) {
            return Redirect::back()->with('flash-message', "{$email} not found");
        }

        return view('profile', compact('profile'));
    }

    /**
     * Loops count times and generates profiles
     *
     * @param $count
     */
    private function generateProfiles($count)
    {
        for($i = 0; $i < $count; $i++)
        {
            $this->generateProfile();
        }
    }

    /**
     * Generate and save user in the database
     *
     * Fires event ProfileWasGenerated
     */
    private function generateProfile()
    {
        $profile = $this->profile->create([
            'username' => $this->faker->userName,
            'password' => $this->faker->word,
            'email' => $this->faker->email,
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'country' => $this->faker->randomElement($this->countries),
            'registration_date' => $this->faker->dateTimeBetween('2014-01-01', '2014-12-31'),
            'is_active' => true,
            'rating' => 0,
        ]);

        \Event::fire(new ProfileWasGenerated($profile));
    }

}
