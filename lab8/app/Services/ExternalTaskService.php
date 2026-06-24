<?php

declare(strict_types=1);

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ExternalTaskService
{
    private string $baseUrl = 'https://jsonplaceholder.typicode.com';

    public function getPosts()
    {
        $start = microtime(true);

        $response = Http::get($this->baseUrl . '/posts');

        $this->logRequest('GET /posts', $response, $start);

        if ($response->successful()) {
            return $response->json();
        }

        return ['error' => 'Не вдалося отримати список записів'];
    }

    public function getPostById($id)
    {
        $start = microtime(true);

        $response = Http::get($this->baseUrl . '/posts/' . $id);

        $this->logRequest('GET /posts/' . $id, $response, $start);

        if ($response->successful()) {
            return $response->json();
        }

        return ['error' => 'Запис не знайдено'];
    }

    public function createPost(array $data)
    {
        $start = microtime(true);

        $response = Http::post($this->baseUrl . '/posts', $data);

        $this->logRequest('POST /posts', $response, $start);

        if ($response->successful()) {
            return $response->json();
        }

        return ['error' => 'Помилка створення запису'];
    }

    private function logRequest($action, $response, $startTime)
    {
        $executionTime = round((microtime(true) - $startTime) * 1000, 2);

        if ($response->successful()) {
            Log::info('HTTP Request Success', [
                'action' => $action,
                'status' => $response->status(),
                'time_ms' => $executionTime
            ]);
        } else {
            Log::error('HTTP Request Failed', [
                'action' => $action,
                'status' => $response->status(),
                'time_ms' => $executionTime
            ]);
        }
    }
}
