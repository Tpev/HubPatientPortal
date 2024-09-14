<?php

namespace App\Http\Controllers;

use App\Models\FormInstance;
use App\Models\FormTemplate;
use App\Models\FormSubmission;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class FormInstanceController extends Controller
{
    public function index(FormTemplate $form)
    {
        $formInstances = $form->formInstances()->latest()->get();
        return view('formInstances.index', compact('form', 'formInstances'));
    }

	public function store(Request $request, FormTemplate $form)
	{
		// Create a new form instance (unique link)
		$formInstance = FormInstance::create([
			'form_template_id' => $form->id,
			'uuid' => Str::uuid(),
		]);

		// Generate the unique URL for the patient
		$link = url('/form/' . $formInstance->uuid);

		// Return a success message with the generated link
		return redirect()->back()->with('success', 'Form instance generated successfully! Here is the link: ' . $link);
	}


public function show($uuid)
{
    // Find the form instance by its UUID
    $formInstance = FormInstance::where('uuid', $uuid)->firstOrFail();

    // Get the form template associated with the instance
    $formTemplate = $formInstance->formTemplate;

    // Pass the form data (fields) to the view to render the form
    return view('formInstances.show', compact('formTemplate', 'formInstance'));
}


public function submit(Request $request, $uuid)
{
    // Find the form instance by its UUID
    $formInstance = FormInstance::where('uuid', $uuid)->firstOrFail();

    // Get the form template
    $formTemplate = $formInstance->formTemplate;

    // Validate the incoming data based on the form fields
    $rules = [];
    foreach (json_decode($formTemplate->fields) as $field) {
        $rules[$field->name] = $field->validation ?: 'nullable';
    }
    $validatedData = $request->validate($rules);

    // Save the submission (you might need a FormSubmission model/table)
    FormSubmission::create([
        'form_instance_id' => $formInstance->id,
        'data' => json_encode($validatedData),
    ]);

    // Redirect or show a success message
    return redirect()->back()->with('success', 'Form submitted successfully!');
}

}
