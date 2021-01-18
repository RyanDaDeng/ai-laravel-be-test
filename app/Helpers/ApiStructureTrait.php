<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Response;

/**
 * @author Ryan Deng
 * @copyright NOT FREE, NOT OPEN SOURCE, NOT USED FOR COMMERCIAL WITHOUT CONSENT
 * Trait ApiStructureTrait
 * @package App\Modules\Core
 */
trait ApiStructureTrait
{

    /**
     * @param array $data
     * @param string $systemCode
     * @param int $httpCode
     * @return \Illuminate\Http\JsonResponse
     */
    public function sendSuccess($data = [], $systemCode = '', $httpCode = 200)
    {
        return $this->sendResponse('success', $data, $systemCode, $httpCode);
    }

    /**
     * @param array $data
     * @param string $systemCode
     * @param int $httpCode
     * @return \Illuminate\Http\JsonResponse
     */
    public function sendError($data = [], $systemCode = '', $httpCode = 400)
    {
        return $this->sendResponse('error', $data, $systemCode, $httpCode);
    }

    /**
     * @param $status
     * @param array $data
     * @param string $systemCode
     * @param int $httpCode
     * @return \Illuminate\Http\JsonResponse
     */
    public function sendResponse($status, $data = [], $systemCode = '', $httpCode = 200)
    {
        $response = [
            'status' => $status,
        ];

        if (!empty($systemCode)) {
            $response['code'] = $systemCode;
        }

        if (!empty($data)) {
            $response = array_merge($response, $data);
        }
        return Response::json($response, $httpCode);
    }
}
