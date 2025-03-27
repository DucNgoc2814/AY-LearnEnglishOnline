<?php

namespace Database\Factories;

use App\Models\VideoRecord;
use App\Models\ZoomSession;
use Illuminate\Database\Eloquent\Factories\Factory;

class VideoRecordFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = VideoRecord::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'zoom_session_id' => ZoomSession::inRandomOrder()->first()->id ?? 1,
            'link_video' => 'https://storage.googleapis.com/learning-english/' . $this->faker->uuid . '.mp4',
            'upload_date' => $this->faker->dateTimeBetween('-1 year', 'now'),
        ];
    }
} 