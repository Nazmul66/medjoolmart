<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\HomeSetting;
use App\Traits\ImageUploadTraits;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class EssentialSettingController extends Controller
{
    use ImageUploadTraits;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $time_schedule  =  HomeSetting::where('key', 'time_schedule_section')->first();
        $website_rules  =  HomeSetting::where('key', 'website_rules')->first();
        return view('backend.pages.essential_setting.index', [
            'time_schedule'   => $time_schedule,
            'website_rules'   => $website_rules,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function timeScheduleSection(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'day.*'          => ['required', 'string'],
            'start_time.*'   => ['required', 'date_format:H:i'],
            'end_time.*'     => ['required', 'date_format:H:i', 'after:start_time.*'],
        ]);

        $data = [];

        foreach ($request->day as $index => $day) {
            // Ensure end_time is after start_time
            if (strtotime($request->end_time[$index]) <= strtotime($request->start_time[$index])) {
                return back()->withErrors(['end_time.' . $index => 'End time must be after start time.']);
            }

            $data[] = [
                'day'        => $day,
                'start_time' => $request->start_time[$index],
                'end_time'   => $request->end_time[$index],
            ];
        }

        HomeSetting::updateOrCreate(
            [
                'key' => 'time_schedule_section',
            ],
            [
                'value' => json_encode($data)
            ],
        );

        Toastr::success('Update Successfully', 'Success', ["positionClass" => "toast-top-right"]);
        return redirect()->back();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function websiteRules(Request $request)
    {
       // dd($request->all());
       $request->validate([
            'title.*'   => ['required', 'string', function ($attribute, $value, $fail) use ($request) {
                if (count(array_keys($request->title, $value)) > 1) {
                    $fail('The title "' . $value . '" must be unique.');
                }
            }],
            'content.*' => ['required', 'string'], 
            'image'     => ['nullable'], 
            'image.*'   => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:3072'],
        ]);

        // Fetch existing data
        $existingData = HomeSetting::where('key', 'website_rules')->first();
        $existingImages = $existingData ? json_decode($existingData->value, true) : [];

        // Process images, keeping old ones
        $finalImages = $existingImages; // Preserve existing data

        if ($request->hasFile('image')) {
            foreach ($request->file('image') as $index => $imageFile) {
                $oldImage = $existingImages[$index]['image'] ?? null;

                // Upload new image and update its path
                $finalImages[$index]['image'] = $this->deleteImageAndUpload($request, 'image.' . $index, 'website_rules', $oldImage);
            }
        }

        // Prepare data for saving
        $data = [];
        foreach ($request->title as $index => $title) {
            $data[] = [
                'title'   => $title,
                'content' => $request->content[$index],
                'image'   => $finalImages[$index]['image'] ?? null, // Use the updated image
            ];
        }

        HomeSetting::updateOrCreate(
            [
                'key' => 'website_rules',
            ],
            [
                'value' => json_encode($data)
            ],
        );

        Toastr::success('Update Successfully', 'Success', ["positionClass" => "toast-top-right"]);
        return redirect()->back();
    }
}
