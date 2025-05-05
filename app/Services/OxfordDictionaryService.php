<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class OxfordDictionaryService
{
    protected $baseUrl;
    protected $appId;
    protected $appKey;

    public function __construct()
    {
        $this->baseUrl = 'https://od-api.oxforddictionaries.com/api/v2';
        $this->appId = config('services.oxford.app_id');
        $this->appKey = config('services.oxford.app_key');
    }

    public function getWordInfo(string $word): ?array
    {
        try {
            // Chuẩn bị URL và headers
            $url = "{$this->baseUrl}/entries/en-gb/" . urlencode(strtolower($word));

            // Sử dụng Guzzle client trực tiếp để có thêm control
            $client = new \GuzzleHttp\Client([
                'verify' => false,  // Tắt SSL verification
                'timeout' => 30,    // Tăng timeout
            ]);

            $headers = [
                'Accept' => 'application/json',
                'app-id' => $this->appId,
                'app-key' => $this->appKey
            ];

            Log::info('Oxford API Request:', [
                'url' => $url,
                'headers' => $headers,
                'word' => $word
            ]);

            // Thực hiện request với Guzzle
            $response = $client->request('GET', $url, [
                'headers' => $headers
            ]);

            // Lấy response body
            $body = $response->getBody()->getContents();
            $statusCode = $response->getStatusCode();

            Log::info('Oxford API Raw Response:', [
                'status' => $statusCode,
                'headers' => $response->getHeaders(),
                'body' => $body
            ]);

            if ($statusCode === 200) {
                $data = json_decode($body, true);
                Log::info('Oxford API Parsed Response:', ['data' => $data]);

                if (!isset($data['results'][0]['lexicalEntries'][0]['entries'][0])) {
                    Log::warning('Oxford API: Missing expected data structure', ['data' => $data]);
                    return null;
                }

                $result = $this->extractWordInfo($data);
                Log::info('Final processed result:', ['result' => $result]);
                return $result;
            }

            Log::warning("Oxford API Error for word: {$word}", [
                'status' => $statusCode,
                'body' => $body,
                'headers' => $response->getHeaders()
            ]);

            return null;
        } catch (\Exception $e) {
            Log::error("Error in Oxford API call for word: {$word}", [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return null;
        }
    }

    protected function extractWordInfo(array $data): array
    {
        try {
            $result = [
                'word' => $data['word'] ?? '',
                'phonetic' => '',
                'audio_url' => '',
                'definitions' => [],
                'examples' => [],
                'pronunciations' => []
            ];

            if (isset($data['results'][0]['lexicalEntries'][0]['entries'][0])) {
                $entry = $data['results'][0]['lexicalEntries'][0]['entries'][0];

                // Log entry data for debugging
                Log::info('Processing entry data:', ['entry' => $entry]);

                // Get pronunciations
                if (isset($entry['pronunciations'])) {
                    foreach ($entry['pronunciations'] as $pronunciation) {
                        Log::info('Processing pronunciation:', ['pronunciation' => $pronunciation]);

                        // Lưu tất cả phiên âm vào mảng pronunciations
                        if (isset($pronunciation['phoneticSpelling']) || isset($pronunciation['audioFile'])) {
                            $result['pronunciations'][] = [
                                'phoneticSpelling' => $pronunciation['phoneticSpelling'] ?? '',
                                'audioFile' => $pronunciation['audioFile'] ?? '',
                                'dialects' => $pronunciation['dialects'] ?? []
                            ];

                            // Ưu tiên phiên âm British English
                            if (isset($pronunciation['phoneticSpelling'])) {
                                if (empty($result['phonetic']) ||
                                    (isset($pronunciation['dialects']) && in_array('British English', $pronunciation['dialects']))) {
                                    $result['phonetic'] = $pronunciation['phoneticSpelling'];
                                }
                            }

                            if (isset($pronunciation['audioFile'])) {
                                if (empty($result['audio_url']) ||
                                    (isset($pronunciation['dialects']) && in_array('British English', $pronunciation['dialects']))) {
                                    $result['audio_url'] = $pronunciation['audioFile'];
                                }
                            }
                        }
                    }
                }

                // Get definitions and examples
                if (isset($entry['senses'])) {
                    foreach ($entry['senses'] as $sense) {
                        if (isset($sense['definitions'])) {
                            $result['definitions'] = array_merge($result['definitions'], $sense['definitions']);
                        }
                        if (isset($sense['examples'])) {
                            foreach ($sense['examples'] as $example) {
                                $result['examples'][] = $example['text'];
                            }
                        }
                    }
                }
            }

            Log::info('Extracted word info:', ['result' => $result]);
            return $result;
        } catch (\Exception $e) {
            Log::error('Error extracting word info:', [
                'error' => $e->getMessage(),
                'data' => $data
            ]);
            return $result;
        }
    }
}
