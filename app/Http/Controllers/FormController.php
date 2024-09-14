<?php

namespace App\Http\Controllers;

use App\Models\Form;
use App\Models\FormSubmission;
use Illuminate\Http\Request;

class FormController extends Controller
{
    // Show form creation page
    public function create()
    {
        return view('forms.create');
    }

    // Store new form
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'fields' => 'required|array',
            'fields.*.label' => 'required|string',
            'fields.*.name' => 'required|string',
            'fields.*.type' => 'required|string',
            'fields.*.placeholder' => 'nullable|string',
            'fields.*.default' => 'nullable|string',
            'fields.*.validation' => 'nullable|string',
            'fields.*.options' => 'nullable|string',
        ]);

        Form::create([
            'title' => $data['title'],
            'fields' => json_encode($data['fields']),
        ]);

        return response()->json(['message' => 'Form created successfully!']);
    }

    // Display the form to users
    public function show(Form $form)
    {
        $fields = json_decode($form->fields, true);
        return view('forms.show', compact('form', 'fields'));
    }

    // Handle form submission
    public function submit(Request $request, Form $form)
    {
        $fields = json_decode($form->fields, true);

        // Build validation rules based on form fields
        $rules = [];
        foreach ($fields as $field) {
            $validationRules = $field['validation'] ?? 'nullable';
            if ($field['type'] === 'file') {
                $validationRules .= '|file';
            }
            $rules[$field['name']] = $validationRules;
        }

        $validatedData = $request->validate($rules);

        // Handle file uploads
        foreach ($fields as $field) {
            if ($field['type'] === 'file' && $request->hasFile($field['name'])) {
                $file = $request->file($field['name']);
                $path = $file->store('uploads', 'public');
                $validatedData[$field['name']] = $path;
            }
        }

        // Store the submission data
        FormSubmission::create([
            'form_id' => $form->id,
            'data' => json_encode($validatedData),
        ]);

        return response()->json(['message' => 'Form submitted successfully!']);
    }

    // Display form submissions
    public function submissions(Form $form)
    {
        $submissions = $form->submissions()->latest()->get();
        return view('forms.submissions', compact('form', 'submissions'));
    }
}
