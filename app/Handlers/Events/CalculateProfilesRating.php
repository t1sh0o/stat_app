<?php namespace App\Handlers\Events;

use App\Events\ProfileWasGenerated;

use App\Rating;
use Carbon\Carbon;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldBeQueued;

class CalculateProfilesRating {
    /**
     * @var Rating
     */
    private $rating;

    /**
     * @var int
     */
    private $points = 0;

    /**
	 * Create the event handler.
	 *
	 * @return void
	 */
	public function __construct(Rating $rating)
	{
        $this->rating = $rating;
    }

	/**
	 * Handle the event.
	 *
	 * @param  ProfileWasGenerated  $event
	 * @return void
	 */
	public function handle(ProfileWasGenerated $event)
	{
        $profile = $event->profile;

        $this->rating->create([
            'profile_id' => $profile->id,
            'country_points' => $this->calculateCountryPoints($profile->country),
            'id_points' => $this->calculateIdPoints($profile->id),
            'reg_date_points' => $this->calculateRegDatePoints($profile->registration_date),
            'stat_decrease_points' => $this->calculateStatDecreasePoints($profile)
        ]);

        $profile->rating = $this->points;
        $profile->save();
	}

    /**
     * @param $country
     * @return int
     */
    private function calculateCountryPoints($country)
    {
        switch ($country) {
            case 'Bulgaria':
                $this->points += 2;
                return 2;
            case 'Germany':
                $this->points += 3;
                return 3;
            case 'France':
                $this->points += 4;
                return 4;
            case 'Russia':
                $this->points += 5;
                return 5;
            case 'Turkey':
                $this->points += 6;
                return 6;
            default:
                return 0;
        }
    }


    /**
     * @param $id
     * @return int
     */
    private function calculateIdPoints($id)
    {
        $points = 0;
        if ($id % 3 === 0) {
            $this->points += 1;
            $points += 1;
        }

        if ($id % 4 === 0) {
            $this->points += 2;
            $points += 2;
        }

        return $points;
    }

    /**
     * @param $date
     * @return mixed
     */
    private function calculateRegDatePoints($date)
    {
        $quarter = $date->quarter;
        $this->points *= $quarter;

        return $quarter;
    }

    /**
     * @param $profile
     * @return int
     */
    private function calculateStatDecreasePoints($profile)
    {
        if ($avgRating = $profile->avg('rating') == 0)
            return 0;

        if ($this->points > $avgRating) {
            $this->points -= 5;
            return 5;
        }

        return 0;
    }

}
