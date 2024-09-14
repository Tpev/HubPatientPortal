@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1>{{ $formTemplate->title }}</h1>
    
    <form method="POST" action="{{ route('formInstances.submit', $formInstance->uuid) }}">
        @csrf

        <!-- Loop through the form fields and render them -->
        @foreach(json_decode($formTemplate->fields) as $field)
        <div class="mb-3">
            <label class="form-label">{{ $field->label }}</label>

            <!-- Render different input types based on field type -->
            @if($field->type === 'text' || $field->type === 'email' || $field->type === 'number')
            <input 
                type="{{ $field->type }}" 
                name="{{ $field->name }}" 
                placeholder="{{ $field->placeholder }}" 
                value="{{ old($field->name, $field->default) }}" 
                class="form-control" 
                required="{{ strpos($field->validation, 'required') !== false }}">
            @elseif($field->type === 'checkbox')
            <input type="checkbox" name="{{ $field->name }}" class="form-check-input">
            @elseif($field->type === 'radio')
            @foreach(explode(',', $field->options) as $option)
            <div class="form-check">
                <input 
                    type="radio" 
                    name="{{ $field->name }}" 
                    value="{{ trim($option) }}" 
                    class="form-check-input">
                <label class="form-check-label">{{ trim($option) }}</label>
            </div>
            @endforeach
            @endif
        </div>
        @endforeach

        <!-- Submit Button -->
        <button type="submit" class="btn btn-success">Submit Form</button>
    </form>
</div>
@endsection
