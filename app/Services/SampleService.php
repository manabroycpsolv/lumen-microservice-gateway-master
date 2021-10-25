<?php

namespace App\Services;

use App\Traits\ConsumesExternalService;
use Illuminate\Http\Request;

class SampleService
{
    use ConsumesExternalService;

    /**
     * The base uri to consume the samples service
     * @var string
     */
    public $baseUri;

    /**
     * The secret to consume the samples service
     * @var string
     */
    public $secret;

    public function __construct(Request $request)
    {
        $this->baseUri = config('services.samples.base_uri');
        $this->secret = $request->header('Authorization');
    }

    /**
     * Obtain the full list of sample from the sample service
     * @return string
     */
    public function obtainSamples()
    {
        return $this->performRequest('GET', '/samples');
    }

    /**
     * Create one sample using the sample service
     * @return string
     */
    public function createSample($data)
    {
        return $this->performRequest('POST', '/samples', $data);
    }

    /**
     * Obtain one single sample from the sample service
     * @return string
     */
    public function obtainSample($sample)
    {
        return $this->performRequest('GET', "/samples/{$sample}");
    }

    /**
     * Update an instance of sample using the sample service
     * @return string
     */
    public function editSample($data, $sample)
    {
        return $this->performRequest('PUT', "/samples/{$sample}", $data);
    }

    /**
     * Remove a single sample using the sample service
     * @return string
     */
    public function deleteSample($sample)
    {
        return $this->performRequest('DELETE', "/samples/{$sample}");
    }
}
