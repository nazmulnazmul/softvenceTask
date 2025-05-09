<?php

namespace App\Http\Controllers\Course;

use App\Models\Course;
use App\Models\Module;
use App\Models\Content;
use Illuminate\Http\Request;

class CourseController {
    public function index()
    {
        return view('welcome');
    }

    public function store(Request $request)
    {
        $request->validate([
            'course_title' => 'required|string|max:255',
            'feature_video' => 'nullable|string|max:255',
        ]);

        
        $course = Course::create([
            'title' => $request->input('course_title'),
            'feature_video' => $request->input('feature_video'),
        ]);

        foreach ($request->input('module_title', []) as $index => $moduleTitle) {
            $module = Module::create([
                'title' => $moduleTitle,
                'course_id' => $course->id,
            ]);

            $contents = $request->input("content_title.$index.contents", []);
            $videoTypes = $request->input("vedio_source_type.$index.contents", []);
            $videoUrls = $request->input("vedio_url.$index.contents", []);
            $videoLengths = $request->input("vedio_length.$index.contents", []);

            foreach ($contents as $i => $contentTitle) {
                Content::create([
                    'module_id' => $module->id,
                    'title' => $contentTitle,
                    'video_source_type' => $videoTypes[$i] ?? null,
                    'video_url' => $videoUrls[$i] ?? null,
                    'video_length' => $videoLengths[$i] ?? null,
                ]);
            }
        }

        return redirect()->back()->with('success', 'Course created successfully.');
    }
}
