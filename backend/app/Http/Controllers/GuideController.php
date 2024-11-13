<?php

namespace App\Http\Controllers;

use App\Models\Guide;
use Illuminate\Http\Request;
use App\Services\GuideService;

class GuideController extends Controller
{
    protected $guideService;

    public function __construct(GuideService $guideService)
    {
        $this->guideService = $guideService;  // Inject GuideService
    }

    /**
     * Show all guides.
     */
    public function index()
    {
        $guides = $this->guideService->getAllGuides();
        return response()->json($guides);
    }

    /**
     * Show a specific guide by ID.
     */
    public function show($id)
    {
        $guide = $this->guideService->getGuideById($id);
        return response()->json($guide);
    }

    /**
     * Create a new guide.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'days_count' => 'required|integer',
            'options' => 'required|json',  // Ensure the options field is in JSON format
        ]);

        $guide = $this->guideService->createGuide($validated);
        return response()->json($guide, 201);
    }

    /**
     * Update a guide by ID.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'days_count' => 'required|integer',
            'options' => 'required|json',
        ]);

        $guide = $this->guideService->updateGuide($id, $validated);
        return response()->json($guide);
    }

    /**
     * Delete a guide by ID.
     */
    public function destroy($id)
    {
        $this->guideService->deleteGuide($id);
        return response()->json(['message' => 'Guide deleted successfully']);
    }

     /**
     * Search a guide by title, days_count, options.
     */
     public function search(Request $request)
     {

         $criteria = $request->only(['title', 'days_count', 'options']);
 
         $guides = $this->guideService->searchGuides($criteria);
 
         return response()->json($guides);
     }
}
