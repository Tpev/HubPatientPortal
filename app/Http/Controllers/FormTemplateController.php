<?php

namespace App\Http\Controllers;

use App\Models\FormTemplate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FormTemplateController extends Controller
{
    // Show form creation page
    public function create()
    {
        return view('formTemplates.create');
    }

    // Store new form template
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'fields' => 'required|array',
            // Add validation for fields
        ]);

        FormTemplate::create([
            'title' => $data['title'],
            'fields' => json_encode($data['fields']),
            'user_id' => Auth::id(),
        ]);

        return response()->json(['message' => 'Form template created successfully!']);
    }

public function index()
{
    // Fetch all form templates along with their instances
    $formTemplates = FormTemplate::with('formInstances')->where('user_id', auth()->id())->get();

    // Return the view and pass the form templates
    return view('formTemplates.index', compact('formTemplates'));
}


}
