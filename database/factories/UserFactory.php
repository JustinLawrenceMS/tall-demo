<?php

namespace Database\Factories;

use Carbon\Carbon;
use App\Models\Team;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Laravel\Jetstream\Features;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /* 
     *
     * setDateArray
     *
     * This sets the date array and returns 
     *
     * the last 48 months in Y-m format.
     *
     * */

    public function setDateArray(){

	    $dates = [];

	    for($i=47; $i>=0; $i--){
		    
		    $dates[] = Carbon::today()->startOfMonth()->subMonth($i)->format('Y-m');

	    }

	    return $dates;

    }

    public function setCustomerDetails($dates){

	    /* I usually use Big O notation but this is just
	     * for setting up test env
	     * */

	    $spend = [];

	    for($i=0; $i<48; $i++){

		    $spend_entry = $this->faker->randomFloat(4,
		    
		    					0,
		    
		    					1000);

		    $spend[$dates[$i]] = $spend_entry;

	    }
		
	    $customer_details = [
		    'admin' => false,
		    'browser' => $this->faker->userAgent(),
		    'point-of-sale' => $this->faker->domainName,
		    'cardDetails' => $this->faker->creditCardDetails,
		    'spend' => $spend
	    ];

	    return $customer_details;
    
    }
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

	$dates = $this->setDateArray();

	$customer_details = $this->setCustomerDetails($dates);

        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
	    'email_verified_at' => now(),
	    'telephone' => $this->faker->unique()->phoneNumber(),
	    'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
	    'customer_details' => $customer_details,
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }

    /**
     * Indicate that the user should have a personal team.
     *
     * @return $this
     */
    public function withPersonalTeam()
    {
        if (! Features::hasTeamFeatures()) {
            return $this->state([]);
        }

        return $this->has(
            Team::factory()
                ->state(function (array $attributes, User $user) {
                    return ['name' => $user->name.'\'s Team', 'user_id' => $user->id, 'personal_team' => true];
                }),
            'ownedTeams'
        );
    }
}
