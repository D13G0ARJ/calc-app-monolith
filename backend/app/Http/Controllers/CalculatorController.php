<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCalculationRequest;
use App\Models\Operation;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CalculatorController extends Controller
{
    /**
     * Realiza el cálculo y guarda en el historial.
     */
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

    /**
     * Recupera el historial de cálculos.
     */
    public function history(): JsonResponse
    {
        $history = Operation::orderBy('created_at', 'desc')->take(20)->get();
        return response()->json($history);
    }
}
