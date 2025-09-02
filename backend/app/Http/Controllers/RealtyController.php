<?php

namespace App\Http\Controllers;

use App\Models\Realty;
use App\Services\RealtyService;
use Illuminate\Http\Request;

class RealtyController extends Controller
{
    /**
     * @var RealtyService
     */
    protected $realtyService;

    public function __construct(RealtyService $realtyService)
    {
        $this->realtyService = $realtyService;
    }

    /**
     * Search for realty based on request parameters.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function search(Request $request): JsonResponse
    {
        $params = $request->all();
        $realties = $this->realtyService->searchRealty($params);

        // API should return JSON with pure numeric data
        $realties->transform(function ($item, $key) {
            return [
                'id'        => (int) $item->id,
                'name'      => $item->name,
                'price'     => (int) $item->price,
                'bedrooms'  => (int) $item->bedrooms,
                'bathrooms' => (int) $item->bathrooms,
                'storeys'   => (int) $item->storeys,
                'garages'   => (int) $item->garages,
            ];
        });

        return response()->json($realties);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $realties = $this->realtyService->getAllRealty();
        return response()->json($realties);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name'      => 'required|string|max:255',
            'price'     => 'required|numeric',
            'bedrooms'  => 'required|integer',
            'bathrooms' => 'required|integer',
            'storeys'   => 'required|integer',
            'garages'   => 'required|integer',
        ]);

        $realty = $this->realtyService->createRealty($validatedData);
        return response()->json($realty, 201); // 201 Created
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $realty = $this->realtyService->getRealtyById($id);

        if (!$realty) {
            return response()->json(['message' => 'Not found'], 404);
        }

        return response()->json($realty);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'name'      => 'sometimes|required|string|max:255',
            'price'     => 'sometimes|required|numeric',
            'bedrooms'  => 'sometimes|required|integer',
            'bathrooms' => 'sometimes|required|integer',
            'storeys'   => 'sometimes|required|integer',
            'garages'   => 'sometimes|required|integer',
        ]);

        $realty = $this->realtyService->updateRealty($id, $validatedData);

        if (!$realty) {
            return response()->json(['message' => 'Not found'], 404);
        }

        return response()->json($realty);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $deleted = $this->realtyService->deleteRealty($id);

        if (!$deleted) {
            return response()->json(['message' => 'Not found'], 404);
        }

        return response()->json(null, 204); // 204 No Content
    }
}
