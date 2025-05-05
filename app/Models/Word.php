declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Word extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'word',
        'phonetic',
        'audio_url'
    ];

    /**
     * Get the examples associated with the word.
     */
    public function examples(): HasMany
    {
        return $this->hasMany(Example::class);
    }

    /**
     * Get the meanings associated with the word.
     */
    public function meanings(): HasMany
    {
        return $this->hasMany(Meaning::class);
    }

    /**
     * Get the synonyms associated with the word.
     */
    public function synonyms(): HasMany
    {
        return $this->hasMany(Synonym::class);
    }

    /**
     * Get the antonyms associated with the word.
     */
    public function antonyms(): HasMany
    {
        return $this->hasMany(Antonym::class);
    }
}
