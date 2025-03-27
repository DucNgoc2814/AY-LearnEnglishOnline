<?php

namespace Database\Factories;

use App\Models\Resource;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\LessonVideo;
use Illuminate\Database\Eloquent\Factories\Factory;

class ResourceFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Resource::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $resourceableTypes = [
            Course::class,
            Lesson::class,
        ];
        
        $resourceableType = $this->faker->randomElement($resourceableTypes);
        $resourceableId = null;
        
        if ($resourceableType === Course::class) {
            $resourceableId = Course::inRandomOrder()->first()->id ?? 1;
        } else {
            $resourceableId = Lesson::inRandomOrder()->first()->id ?? 1;
        }
        
        $fileExtensions = [
            'video' => ['mp4', 'webm', 'mov'], 
            'pdf' => ['pdf'],
            'doc' => ['doc', 'docx'],
            'ppt' => ['ppt', 'pptx'],
            'audio' => ['mp3', 'wav', 'ogg'],
            'image' => ['jpg', 'png', 'gif']
        ];
        
        // Chỉ sử dụng những key có trong $fileExtensions để đảm bảo không có lỗi
        $fileTypes = array_keys($fileExtensions);
        $fileType = $this->faker->randomElement($fileTypes);
        
        $extension = $this->faker->randomElement($fileExtensions[$fileType]);
        
        return [
            'title' => $this->faker->sentence(4),
            'description' => $this->faker->paragraph(),
            'file_path' => 'resources/' . $this->faker->uuid . '.' . $extension,
            'file_type' => $fileType,
            'file_size' => $this->faker->numberBetween(100000, 10000000),
            'file_extension' => $extension,
            'file_url' => $this->faker->url,
            'external_url' => $this->faker->boolean(30) ? $this->faker->url : null,
            'duration' => $fileType === 'video' ? $this->faker->numberBetween(60, 3600) : null,
            'preview_path' => $this->faker->boolean(50) ? 'previews/' . $this->faker->uuid . '.jpg' : null,
            'resourceable_id' => $resourceableId,
            'resourceable_type' => $resourceableType,
            'category' => $this->faker->randomElement(['lecture', 'assignment', 'reading', 'exercise', 'reference']),
            'is_downloadable' => $this->faker->boolean(70),
            'is_active' => $this->faker->boolean(90),
            'is_featured' => $this->faker->boolean(20),
            'order' => $this->faker->numberBetween(1, 20),
            'resource_level' => $this->faker->randomElement(['beginner', 'intermediate', 'advanced']),
            'access_type' => $this->faker->randomElement(['free', 'enrolled', 'premium']),
            'original_lesson_video_id' => $fileType === 'video' ? LessonVideo::inRandomOrder()->first()->id ?? null : null,
        ];
    }
} 