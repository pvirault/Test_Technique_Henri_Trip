<?php

namespace App\Services;

use App\Models\Activity;
use App\Models\Guide;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ActivityService
{
    /**
     * Get all activities for a specific guide.
     *
     * @param int $guideId
     * @return \Illuminate\Database\Eloquent\Collection
     * @throws ModelNotFoundException
     */
    public function getActivitiesByGuide($guideId)
    {
        $guide = Guide::find($guideId);

        if (!$guide) {
            throw new ModelNotFoundException("Guide not found.");
        }

        return $guide->activities;
    }

    /**
     * Get a specific activity for a guide.
     *
     * @param int $guideId
     * @param int $activityId
     * @return Activity
     * @throws ModelNotFoundException
     */
    public function getActivityById($guideId, $activityId)
    {
        $guide = Guide::find($guideId);

        if (!$guide) {
            throw new ModelNotFoundException("Guide not found.");
        }

        $activity = $guide->activities()->find($activityId);

        if (!$activity) {
            throw new ModelNotFoundException("Activity not found.");
        }

        return $activity;
    }

    /**
     * Create a new activity for a specific guide.
     *
     * @param int $guideId
     * @param array $data
     * @return Activity
     * @throws ModelNotFoundException
     */
    public function createActivityForGuide($guideId, array $data)
    {
        $guide = Guide::find($guideId);

        if (!$guide) {
            throw new ModelNotFoundException("Guide not found.");
        }

        return $guide->activities()->create($data); // Mass-assign data based on fillable attributes
    }

    /**
     * Update an existing activity for a specific guide.
     *
     * @param int $guideId
     * @param int $activityId
     * @param array $data
     * @return Activity
     * @throws ModelNotFoundException
     */
    public function updateActivity($guideId, $activityId, array $data)
    {
        $guide = Guide::find($guideId);

        if (!$guide) {
            throw new ModelNotFoundException("Guide not found.");
        }

        $activity = $guide->activities()->find($activityId);

        if (!$activity) {
            throw new ModelNotFoundException("Activity not found.");
        }

        // Update the activity
        $activity->update([
            'name' => $data['name'] ?? $activity->name,
            'description' => $data['description'] ?? $activity->description,
            'duration' => $data['duration'] ?? $activity->duration,
        ]);

        return $activity;
    }

    /**
     * Delete an activity for a specific guide.
     *
     * @param int $guideId
     * @param int $activityId
     * @throws ModelNotFoundException
     */
    public function deleteActivity($guideId, $activityId)
    {
        $guide = Guide::find($guideId);

        if (!$guide) {
            throw new ModelNotFoundException("Guide not found.");
        }

        $activity = $guide->activities()->find($activityId);

        if (!$activity) {
            throw new ModelNotFoundException("Activity not found.");
        }

        $activity->delete();
    }
}
