<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class RoomController extends Controller
{
    public function add()
    {
        return view('admin.rooms.add.index');
    }

    public function current(Request $request)
    {
        $rooms = Room::all();
        return view('admin.rooms.current.index', compact('rooms',));
    }

    public function store(Request $request)
    {
        // dd($request);
        $validated = $request->validate([
            'room_number' => 'required|unique:rooms,room_number',
            'room_type' => 'required|string',
            'room_rate' => 'required|numeric|min:0',
            'room_description' => 'required|string',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'gallery' => 'nullable|array',
            'gallery.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'features' => 'nullable|array',
            'features.*' => 'nullable|string|min:3|max:255',
        ]);

        $profilePicturePath = $request->file('profile_picture')
            ? $request->file('profile_picture')->store('rooms', 'public')
            : null;

        // Store the gallery images if exist
        $galleryPaths = [];
        if ($request->hasFile('gallery')) {
            foreach ($request->file('gallery') as $image) {
                $galleryPaths[] = $image->store('rooms/gallery', 'public');
            }
        }

        Room::create([
            'room_number' => $validated['room_number'],
            'room_type' => $validated['room_type'],
            'rate_per_night' => $validated['room_rate'],
            'description' => $validated['room_description'],
            'profile_picture' => $profilePicturePath,
            'gallery' => json_encode($galleryPaths),
            'features' => json_encode($validated['features'] ?? []),
        ]);

        return redirect()->route('admin.rooms.current');
    }


    public function edit($id)
    {
        $room = Room::findOrFail($id);
        return view('admin.rooms.edit', compact('room'));
    }


    public function update(Request $request, $id)
    {
        $room = Room::findOrFail($id);

        // Validate the form data
        $validated = $request->validate([
            'room_number' => 'required|unique:rooms,room_number,' . $room->id,
            'room_type' => 'required|string',
            'room_rate' => 'required|numeric|min:0',
            'room_description' => 'required|string',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'gallery' => 'nullable|array',
            'gallery.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'features' => 'nullable|array',
            'features.*' => 'nullable|string|min:3|max:255',
        ]);

        // Update the profile picture if exists
        if ($request->hasFile('profile_picture')) {
            if ($room->profile_picture) {
                Storage::disk('public')->delete($room->profile_picture);
            }
            $room->profile_picture = $request->file('profile_picture')->store('rooms', 'public');
        }

        // Update the gallery images if exist
        if ($request->hasFile('gallery')) {
            if ($room->gallery) {
                $oldGallery = json_decode($room->gallery, true);
                foreach ($oldGallery as $image) {
                    Storage::disk('public')->delete($image);
                }
            }

            $galleryPaths = [];
            foreach ($request->file('gallery') as $image) {
                $galleryPaths[] = $image->store('rooms/gallery', 'public');
            }
            $room->gallery = json_encode($galleryPaths);
        }

        // Update other fields
        $room->update([
            'room_number' => $validated['room_number'],
            'room_type' => $validated['room_type'],
            'rate_per_night' => $validated['room_rate'],
            'description' => $validated['room_description'],
            'features' => json_encode($validated['features'] ?? []),
        ]);

        return redirect()->route('admin.rooms.current');
    }


    public function delete($id)
    {
        $room = Room::findOrFail($id);

        if ($room->profile_picture) {
            Storage::disk('public')->delete($room->profile_picture);
        }

        if ($room->gallery) {
            $gallery = json_decode($room->gallery);
            foreach ($gallery as $image) {
                Storage::disk('public')->delete($image);
            }
        }

        if ($room->features) {
            $features = json_decode($room->features);
        }

        $room->delete();
        return redirect()->back();
    }
}
