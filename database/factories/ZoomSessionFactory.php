<?php

namespace Database\Factories;

use App\Models\ZoomSession;
use App\Models\Course;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ZoomSessionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ZoomSession::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $name = 'Zoom Session: ' . $this->faker->sentence(3);
        $slug = Str::slug($name);
        $courseId = Course::inRandomOrder()->first()->id ?? 1;
        $releaseTime = $this->faker->dateTimeBetween('-60 days', '+30 days');
        
        return [
            'name' => $name,
            'slug' => $slug,
            'zoom_url' => 'https://zoom.us/j/' . $this->faker->numerify('##########'),
            'course_id' => $courseId,
            'release_time' => $releaseTime,
            'recording_link' => $this->faker->boolean(70) ? 'https://zoom.us/rec/' . $this->faker->uuid : null,
            'status' => $this->faker->randomElement(['scheduled', 'active', 'completed', 'cancelled']),
        ];
    }
} 