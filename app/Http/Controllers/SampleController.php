<?php

namespace App\Http\Controllers;

use App\sample;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Services\SampleService;

class SampleController extends Controller
{
    use ApiResponser;

    /**
     * The service to consume the sample microservice
     * @var SampleService
     */
    public $sampleService;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(SampleService $sampleService)
    {
        $this->sampleService = $sampleService;
    }

    /**
     * Return the list of sample
     * @return Illuminate\Http\Response
     */
    public function index()
    {
        return $this->successResponse($this->sampleService->obtainSamples());
    }

    /**
     * Create one new sample
     * @return Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return $this->successResponse($this->sampleService->createSample($request->all(), Response::HTTP_CREATED));
    }

    /**
     * Obtains and show one sample
     * @return Illuminate\Http\Response
     */
    public function show($sample)
    {
        return $this->successResponse($this->sampleService->obtainSample($sample));
    }

    /**
     * Update an existing sample
     * @return Illuminate\Http\Response
     */
    public function update(Request $request, $sample)
    {
        return $this->successResponse($this->sampleService->editSample($request->all(), $sample));
    }

    /**
     * Remove an existing sample
     * @return Illuminate\Http\Response
     */
    public function destroy($sample)
    {
        return $this->successResponse($this->sampleService->deleteSample($sample));
    }
}
