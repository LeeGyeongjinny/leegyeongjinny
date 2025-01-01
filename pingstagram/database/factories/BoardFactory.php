<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Board>
 */
class BoardFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $arrImg = [
            '/img/akdongping.png'
            ,'/img/araping.png'
            ,'/img/arongping.png'
            ,'/img/balletping.png'
            ,'/img/bbanzzakping.png'
            ,'/img/bbosongping.png'
            ,'/img/binggeulping.png'
            ,'/img/chachaping.png'
            ,'/img/chanaping.png'
            ,'/img/chocoping.png'
            ,'/img/chrongping.png'
            ,'/img/dalcomeping.png'
            ,'/img/darongping.png'
            ,'/img/ddiyongping.png'
            ,'/img/dreamping.png'
            ,'/img/fluffyping.png'
            ,'/img/hachu.png'
            ,'/img/saecomping.png'
            ,'/img/sandping.png'
            ,'/img/soljjiping.png'
            ,'/img/trustping.png'
            
        ];

        $user = User::select('user_id')->inRandomOrder()->first();
        // $date = $this->faker->dateTimeBetween($user->created_at);
        return [
            'user_id' => $user->user_id,
            'title' => $this->faker->realText(rand(10, 20)),
            'content' => $this->faker->realText(rand(10, 100)),
            'img' => Arr::random($arrImg),
            'like' => rand(1,300),
            // 'created_at' => $date,
            // 'updated_at' => $date,
        ];
    }
}
