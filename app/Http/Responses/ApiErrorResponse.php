<?php
namespace App\Http\Responses;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\Response;
use Throwable;
class ApiErrorResponse implements Responsable
{
    /**
     * @param  Throwable  $e
     * @param  string  $message
     * @param  int  $code
     * @param  array  $headers
     */
    public function __construct(
        protected Throwable $e,
        // protected string $message,
        protected int $code = Response::HTTP_INTERNAL_SERVER_ERROR,
        protected array $headers = []
    ) {
    }
    /**
     * @param $request
     * @return \Illuminate\Http\JsonResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function toResponse($request)
    {
        $response = [
            'success'=>false,
            'message' => $this->e->getMessage(),
            'data' => []
        ];

        return \response()->json($response, $this->code, $this->headers);
    }


}