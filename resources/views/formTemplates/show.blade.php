@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $form->title }}</h1>

    <form id="generateFormInstance">
        @csrf
        <div class="mb-3">
            <label for="patient_name" class="form-label">Patient Name</label>
            <input type="text" class="form-control" id="patient_name" name="patient_name">
        </div>
        <button type="submit" class="btn btn-primary">Generate Form Link</button>
    </form>

    <div id="generatedLink" class="mt-3" style="display: none;">
        <p>Form Link:</p>
        <a href="#" id="formLink" target="_blank"></a>
    </div>

    <h3 class="mt-5">Form Instances</h3>
    <ul>
        @foreach($form->formInstances as $instance)
            <li>
                {{ $instance->patient_name ?? 'Unnamed' }} - 
                <a href="{{ url('/form/' . $instance->uuid) }}" target="_blank">{{ url('/form/' . $instance->uuid) }}</a>
            </li>
        @endforeach
    </ul>
</div>
@endsection

@section('scripts')
<script>
document.getElementById('generateFormInstance').addEventListener('submit', function(e) {
    e.preventDefault();

    axios.post('{{ route('formInstances.store', $form->id) }}', {
        patient_name: document.getElementById('patient_name').value,
        _token: '{{ csrf_token() }}'
    })
    .then(response => {
        const link = response.data.link;
        document.getElementById('formLink').href = link;
        document.getElementById('formLink').textContent = link;
        document.getElementById('generatedLink').style.display = 'block';
    })
    .catch(error => {
        console.error(error);
        alert('Error generating form link.');
    });
});
</script>
@endsection
