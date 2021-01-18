<?php


namespace App\Helpers;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Exceptions\HttpResponseException;

/**
 * @author Ryan Deng
 * @copyright NOT FREE, NOT OPEN SOURCE, NOT USED FOR COMMERCIAL WITHOUT CONSENT
 * Class ApiFormRequest
 * @package App\Modules\Core
 */
class ApiFormRequest extends FormRequest
{
    use ApiStructureTrait;

    const INVALID = 'INVALID';

    /**
     * Format web response as a JSON response
     * @param Validator $validator
     */
    protected function failedValidation(Validator $validator)
    {
        $errors = (new ValidationException($validator))->errors();

        $firstError = collect($errors)->values()->first()[0];

        throw new HttpResponseException(
            $this->sendError(
                [
                    'message' => $firstError,
                    'errors' => $errors
                ],
                self::INVALID,
                JsonResponse::HTTP_OK
            )
        );
    }
}
