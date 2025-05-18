<?php

declare(strict_types=1);

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class FreeDictionaryService
{
    protected $baseUrl;

    public function __construct()
    {
        $this->baseUrl = 'https://api.dictionaryapi.dev/api/v2/entries/en';
    }

    public function getWordInfo(string $word): ?array
    {
        try {
            $url = "{$this->baseUrl}/" . urlencode(strtolower($word));

            Log::info('Dictionary API Request:', [
                'url' => $url,
                'word' => $word
            ]);

            $response = Http::get($url);
            $statusCode = $response->status();
            $body = $response->json();

            Log::info('Dictionary API Response:', [
                'status' => $statusCode,
                'body' => $body
            ]);

            if ($statusCode === 200 && !empty($body)) {
                $wordData = $body[0]; // Get first result
                return $this->extractWordInfo($wordData);
            }

            Log::warning("Dictionary API Error for word: {$word}", [
                'status' => $statusCode,
                'body' => $body
            ]);

            return null;
        } catch (\Exception $e) {
            Log::error("Error in Dictionary API call for word: {$word}", [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return null;
        }
    }

    protected function extractWordInfo(array $data): array
    {
        $result = [
            'word' => $data['word'] ?? '',
            'phonetic' => $data['phonetic'] ?? '',
            'audio_url' => '',
            'definitions' => [],
            'examples' => [],
            'pronunciations' => []
        ];

        // Get audio URL and pronunciations
        if (!empty($data['phonetics'])) {
            $usPhonetic = null;
            $ukPhonetic = null;
            $defaultPhonetic = null;

            foreach ($data['phonetics'] as $phonetic) {
                // Skip empty phonetics
                if (empty($phonetic['text']) && empty($phonetic['audio'])) {
                    continue;
                }

                // Check if this is a US pronunciation
                if (!empty($phonetic['audio']) && str_contains($phonetic['audio'], '-us.mp3')) {
                    $usPhonetic = $phonetic;
                }
                // Check if this is a UK pronunciation
                else if (!empty($phonetic['audio']) && str_contains($phonetic['audio'], '-uk.mp3')) {
                    $ukPhonetic = $phonetic;
                }
                // Store the first valid phonetic as default
                else if (!$defaultPhonetic) {
                    $defaultPhonetic = $phonetic;
                }
            }

            // Prioritize US > UK > Default phonetic
            $selectedPhonetic = $usPhonetic ?? $ukPhonetic ?? $defaultPhonetic;

            if ($selectedPhonetic) {
                $result['phonetic'] = $selectedPhonetic['text'] ?? '';
                $result['audio_url'] = $selectedPhonetic['audio'] ?? '';

                if (!empty($selectedPhonetic['text'])) {
                    $result['pronunciations'][] = [
                        'phoneticSpelling' => $selectedPhonetic['text'],
                        'audioFile' => $selectedPhonetic['audio'] ?? '',
                        'dialects' => []
                    ];
                }
            }
        }

        // Get definitions and examples
        if (!empty($data['meanings'])) {
            foreach ($data['meanings'] as $meaning) {
                if (!empty($meaning['definitions'])) {
                    foreach ($meaning['definitions'] as $def) {
                        $result['definitions'][] = $def['definition'];
                        if (!empty($def['example'])) {
                            $result['examples'][] = $def['example'];
                        }
                    }
                }
            }
        }

        return $result;
    }
}
