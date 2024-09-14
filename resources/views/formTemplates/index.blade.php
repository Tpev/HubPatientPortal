@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4">Your Form Templates</h1>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Form Title</th>
                <th>Generated UUIDs</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($formTemplates as $template)
            <tr>
                <td>{{ $template->title }}</td>
                <td>
                    @if($template->formInstances->isEmpty())
                        <em>No instances generated</em>
                    @else
                        <ul>
                            @foreach($template->formInstances as $instance)
                            <li>
                                <a href="{{ url('/form/' . $instance->uuid) }}" target="_blank">{{ $instance->uuid }}</a>
                            </li>
                            @endforeach
                        </ul>
                    @endif
                </td>
                <td>
                    <!-- Button to generate form instance -->
                    <form method="POST" action="{{ route('formInstances.store', $template->id) }}" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-primary">Generate Form Instance</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
