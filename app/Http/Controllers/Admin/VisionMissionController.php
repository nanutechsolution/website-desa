<?php
// app/Http/Controllers/Admin/VisionMissionController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\VisionMission;
use Illuminate\Http\Request;

class VisionMissionController extends Controller
{
    /**
     * Display the Vision & Mission page (Read).
     */
    public function index()
    {
        // We expect only one record, so try to find the first one
        $vm = VisionMission::first();
        return view('admin.vision_mission.index', compact('vm'));
    }

    /**
     * Show the form for editing the Vision & Mission (Update).
     */
    public function edit()
    {
        // Find the first (and likely only) record
        $vm = VisionMission::first();

        // If no record exists, create a new empty one to populate the form
        if (!$vm) {
            $vm = new VisionMission();
            // Initialize mission_points as an empty array for the form
            $vm->mission_points = [];
        }

        return view('admin.vision_mission.edit', compact('vm'));
    }

    /**
     * Update the Vision & Mission in storage.
     */
    public function update(Request $request)
    {
        $request->validate([
            'vision_text' => 'required|string|max:1000', // Adjust max length as needed
            'mission_points' => 'nullable|array', // Expect an array of strings
            'mission_points.*' => 'nullable|string|max:500', // Each point can be nullable string
        ]);

        // Find the first (and likely only) record, or create a new one if it doesn't exist
        $vm = VisionMission::firstOrNew([]);

        $vm->vision_text = $request->input('vision_text');

        // Filter out any empty mission points before saving
        $missionPoints = array_filter($request->input('mission_points', []), fn($value) => !is_null($value) && $value !== '');
        $vm->mission_points = array_values($missionPoints); // Re-index array

        $vm->save();

        return redirect()->route('admin.vision-mission.index')->with('success', 'Visi & Misi berhasil diperbarui.');
    }

    /**
     * Optional: Delete the Vision & Mission (use with caution).
     * For Visi & Misi, it's usually better to just update or leave empty.
     */
    // public function destroy()
    // {
    //     VisionMission::truncate(); // This will delete all records, use carefully!
    //     return redirect()->route('admin.vision-mission.index')->with('success', 'Visi & Misi berhasil dihapus.');
    // }
}