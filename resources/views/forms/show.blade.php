@extends('layouts.app')

@section('content')
    <form-renderer :form='@json($form)' :fields='@json($fields)'></form-renderer>
@endsection
