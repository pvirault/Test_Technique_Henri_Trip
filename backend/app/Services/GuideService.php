<?php

namespace App\Services;

use App\Models\Guide;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class GuideService
{
    /**
     * Get all guides.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAllGuides()
    {
        return Guide::all();
    }

    /**
     * Get a specific guide by its ID.
     *
     * @param int $id
     * @return Guide
     * @throws ModelNotFoundException
     */
    public function getGuideById($id)
    {
        $guide = Guide::find($id);

        if (!$guide) {
            throw new ModelNotFoundException("Guide not found.");
        }

        return $guide;
    }

    /**
     * Create a new guide.
     *
     * @param array $data
     * @return Guide
     */
    public function createGuide(array $data)
    {
        return Guide::create([
            'title' => $data['title'],
            'description' => $data['description'],
            'days_count' => $data['days_count'],
            'options' => json_encode($data['options']) // Encode options as JSON
        ]);
    }

    /**
     * Update an existing guide by ID.
     *
     * @param int $id
     * @param array $data
     * @return Guide
     * @throws ModelNotFoundException
     */
    public function updateGuide($id, array $data)
    {
        $guide = Guide::find($id);

        if (!$guide) {
            throw new ModelNotFoundException("Guide not found.");
        }

        // Update the guide with new data
        $guide->update([
            'title' => $data['title'] ?? $guide->title, // Use existing value if not provided
            'description' => $data['description'] ?? $guide->description,
            'days_count' => $data['days_count'] ?? $guide->days_count,
            'options' => isset($data['options']) ? json_encode($data['options']) : $guide->options, // Only update options if provided
        ]);

        return $guide;
    }

    /**
     * Delete a guide by ID.
     *
     * @param int $id
     * @throws ModelNotFoundException
     */
    public function deleteGuide($id)
    {
        $guide = Guide::find($id);

        if (!$guide) {
            throw new ModelNotFoundException("Guide not found.");
        }

        $guide->delete();
    }

     /**
     * Search guides based on provided criteria.
     *
     * @param array $criteria
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function searchGuides(array $criteria)
    {
        
        $query = Guide::query();

        if (isset($criteria['title'])) {
            $query->where('title', 'like', '%' . $criteria['title'] . '%');
        }
        if (isset($criteria['days_count'])) {
            $query->where('days_count', $criteria['days_count']);
        }
        if (isset($criteria['options'])) {
            $query->where('options', 'like', '%' . $criteria['options'] . '%');
        }
        return $query->get();
    }
}
