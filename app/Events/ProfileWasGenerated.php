<?php namespace App\Events;

use App\Events\Event;

use Illuminate\Queue\SerializesModels;
use App\Profile;

class ProfileWasGenerated extends Event {

	use SerializesModels;

    /**
     * @var Profile
     */
    public $profile;

    /**
	 * Create a new event instance.
	 *
	 * @return void
	 */
	public function __construct(Profile $profile)
	{
        $this->profile = $profile;
    }

}
