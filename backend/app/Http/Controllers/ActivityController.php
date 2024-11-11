<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use Illuminate\Http\Request;
use App\Services\ActivityService;

class ActivityController extends Controller
{
    protected $activityService;

    public function __construct(ActivityService $activityService)
    {
        $this->activityService = $activityService;  // Inject ActivityService
    }

    /**
     * Show all activities for a specific guide.
     */
    public function index($guideId)
    {
        $activities = $this->activityService->getActivitiesByGuide($guideId);
        return response()->json($activities);
    }

    /**
     * Show a specific activity.
     */
    public function show($guideId, $activityId)
    {
        $activity = $this->activityService->getActivityById($guideId, $activityId);
        return response()->json($activity);
    }

    /**
     * Create a new activity for a guide.
     */
    public function store(Request $request, $guideId)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'category' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'opening_hours' => 'required|string|max:255',
            'website' => 'required|url|max:255',
            'order' => 'required|integer',
        ]);

        $activity = $this->activityService->createActivityForGuide($guideId, $validated);
        return response()->json($activity, 201);
    }

    /**
     * Update a specific activity.
     */
    public function update(Request $request, $guideId, $activityId)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'category' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'opening_hours' => 'required|string|max:255',
            'website' => 'required|url|max:255',
            'order' => 'required|integer',
        ]);

        $activity = $this->activityService->updateActivity($guideId, $activityId, $validated);
        return response()->json($activity);
    }

    /**
     * Delete an activity.
     */
    public function destroy($guideId, $activityId)
    {
        $this->activityService->deleteActivity($guideId, $activityId);
        return response()->json(['message' => 'Activity deleted successfully']);
    }
}
