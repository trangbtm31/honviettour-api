<?php

namespace Honviettour\Traits;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthenticationException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;
use Honviettour\Exceptions\LogicException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;

trait ExceptionTrait
{
    /**
     * Returns json response for generic error response.
     *
     * @param \Exception $e
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function handleApiException(\Exception $e)
    {

        if ($e instanceof NotFoundHttpException) {
            return $this->responseJsonException('Page not found', Response::HTTP_NOT_FOUND);
        }

        if ($e instanceof MethodNotAllowedHttpException) {
            return $this->responseJsonException('Method not allowed', $e->getStatusCode());
        }

        if ($e instanceof HttpException) {
            return $this->responseJsonException($e->getMessage(), $e->getStatusCode());
        }

        if ($e instanceof ModelNotFoundException) {
            return $this->responseJsonException('Resource not found', Response::HTTP_NOT_FOUND);
        }

        if ($e instanceof AuthenticationException) {
            return $this->responseJsonException($e->getMessage(), Response::HTTP_UNAUTHORIZED);
        }

        if ($e instanceof AuthorizationException) {
            return $this->responseJsonException($e->getMessage(), Response::HTTP_FORBIDDEN);
        }

        if ($e instanceof ValidationException) {
            return $this->responseJsonException($e->getMessage(), $e->status, $e->errors());
        }

        if ($e instanceof LogicException) {
            return $this->responseJsonException($e->getMessage(), $e->getStatusCode(), $e->getErrors());
        }
    }

    /**
     * Format json response error
     *
     * @param mixed $message
     * @param int   $statusCode
     * @param array $errors
     * @return \Illuminate\Http\JsonResponse
     */
    public function responseJsonException($message, int $statusCode = 500, array  $errors = [])
    {
        $formatter = [
            'status' => 'error',
            'message' => $message,
            'code' => $statusCode
        ];

        if ($errors) {
            $formatter['errors'] = $errors;
        }

        return response()->json($formatter, $statusCode);
    }

}