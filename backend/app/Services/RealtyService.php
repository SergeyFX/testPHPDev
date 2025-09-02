<?php

namespace App\Services;

use App\Models\Realty;
use Illuminate\Database\Eloquent\Collection;

class RealtyService
{
    /**
     * Get all real estate records.
     *
     * @return Collection
     */
    public function getAllRealty(): Collection
    {
        return Realty::all();
    }

    /**
     * Find a property record by ID.
     *
     * @param int $id
     * @return Realty|null
     */
    public function getRealtyById(int $id): ?Realty
    {
        return Realty::find($id);
    }

    /**
     * Create a new property record.и.
     *
     * @param array $data
     * @return Realty
     */
    public function createRealty(array $data): Realty
    {
        return Realty::create($data);
    }

    /**
     * Update an existing property record.
     *
     * @param int $id
     * @param array $data
     * @return Realty|null
     */
    public function updateRealty(int $id, array $data): ?Realty
    {
        $realty = $this->getRealtyById($id);
        if ($realty) {
            $realty->update($data);
            return $realty;
        }
        return null;
    }

    /**
     * Delete a property record.
     *
     * @param int $id
     * @return bool
     */
    public function deleteRealty(int $id): bool
    {
        $realty = $this->getRealtyById($id);
        if ($realty) {
            return $realty->delete();
        }
        return false;
    }
    /**
     * Search for realty based on multiple optional criteria.
     *
     * @param array $params
     * @return Collection
     */
    public function searchRealty(array $params): Collection
    {
        $query = Realty::query();

        // Search by Name (partial match)
        if (isset($params['name'])) {
            $query->where('name', 'like', '%' . $params['name'] . '%');
        }

        // Exact matches
        if (isset($params['bedrooms'])) {
            $query->where('bedrooms', (int) $params['bedrooms']);
        }
        if (isset($params['bathrooms'])) {
            $query->where('bathrooms', (int) $params['bathrooms']);
        }
        if (isset($params['storeys'])) {
            $query->where('storeys', (int) $params['storeys']);
        }
        if (isset($params['garages'])) {
            $query->where('garages', (int) $params['garages']);
        }

        // Price range
        if (isset($params['price_min'])) {
            $query->where('price', '>=', (float) $params['price_min']);
        }
        if (isset($params['price_max'])) {
            $query->where('price', '<=', (float) $params['price_max']);
        }

        return $query->get();
    }
}
