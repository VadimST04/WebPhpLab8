<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Services\ExternalTaskService;

class ExternalApiController extends Controller
{
    protected ExternalTaskService $service;

    public function __construct(ExternalTaskService $service)
    {
        $this->service = $service;
    }

    public function posts(): JsonResponse
    {
        return response()->json(
            $this->service->getPosts()
        );
    }

    public function show($id): JsonResponse
    {
        return response()->json(
            $this->service->getPostById($id)
        );
    }

    public function store(Request $request): JsonResponse
    {
        $data = [
            'title' => $request->title,
            'body' => $request->body,
            'userId' => $request->userId
        ];

        return response()->json(
            $this->service->createPost($data)
        );
    }
}
