<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCalculationRequest;
use App\Models\Operation;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use OpenApi\Attributes as OA;

#[OA\Info(
    version: "1.0.0",
    title: "Calculator API",
    description: "API documentation for the Calculator App Monolith"
)]
class CalculatorController extends Controller
{
    #[OA\Post(
        path: '/api/calculate',
        summary: 'Realiza un cálculo',
        tags: ['Calculator'],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                required: ['num1', 'operator', 'num2'],
                properties: [
                    new OA\Property(property: 'num1', type: 'number', example: 10),
                    new OA\Property(property: 'operator', type: 'string', example: '+'),
                    new OA\Property(property: 'num2', type: 'number', example: 5),
                ]
            )
        ),
        responses: [
            new OA\Response(
                response: 201,
                description: 'Operación exitosa',
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(property: 'id', type: 'integer', example: 1),
                        new OA\Property(property: 'num1', type: 'number', example: 10),
                        new OA\Property(property: 'operator', type: 'string', example: '+'),
                        new OA\Property(property: 'num2', type: 'number', example: 5),
                        new OA\Property(property: 'result', type: 'number', example: 15),
                        new OA\Property(property: 'created_at', type: 'string', format: 'date-time'),
                    ]
                )
            ),
            new OA\Response(response: 422, description: 'Datos inválidos o división por cero')
        ]
    )]
    public function calculate(StoreCalculationRequest $request): JsonResponse
    {
        $num1 = (float) $request->validated('num1');
        $num2 = (float) $request->validated('num2');
        $operator = $request->validated('operator');
        $result = 0.0;

        switch ($operator) {
            case '+':
                $result = $num1 + $num2;
                break;
            case '-':
                $result = $num1 - $num2;
                break;
            case '*':
                $result = $num1 * $num2;
                break;
            case '/':
                if ($num2 == 0) {
                    return response()->json([
                        'message' => 'No se permite dividir entre cero.',
                    ], 422);
                }
                $result = $num1 / $num2;
                break;
        }

        $operation = Operation::create([
            'num1' => $num1,
            'operator' => $operator,
            'num2' => $num2,
            'result' => $result,
        ]);

        return response()->json($operation, 201);
    }

    #[OA\Get(
        path: '/api/history',
        summary: 'Obtiene el historial de cálculos',
        tags: ['Calculator'],
        responses: [
            new OA\Response(
                response: 200,
                description: 'Lista de operaciones',
                content: new OA\JsonContent(
                    type: 'array',
                    items: new OA\Items(
                        properties: [
                            new OA\Property(property: 'id', type: 'integer', example: 1),
                            new OA\Property(property: 'num1', type: 'number', example: 10),
                            new OA\Property(property: 'operator', type: 'string', example: '+'),
                            new OA\Property(property: 'num2', type: 'number', example: 5),
                            new OA\Property(property: 'result', type: 'number', example: 15),
                            new OA\Property(property: 'created_at', type: 'string', format: 'date-time'),
                        ]
                    )
                )
            )
        ]
    )]
    public function history(): JsonResponse
    {
        $history = Operation::orderBy('created_at', 'desc')->take(20)->get();
        return response()->json($history);
    }
}
