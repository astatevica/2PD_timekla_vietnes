@extends('layout')
 
@section('content')
 
    <h1>{{ $title }}</h1>
 
    @if ($errors->any())
        <div class="alert alert-danger">Lūdzu, novērsiet radušās kļūdas!</div>
    @endif
 
    <form method="post" action="{{ $performer->exists ? '/performers/patch/' . $performer->id : '/performers/put' }}">
        @csrf
 
        <div class="mb-3">
            <label for="performer-name" class="form-label">Izpildītāja vārds</label>
 
            <input 
                type="text" 
                class="form-control @error('name') is-invalid @enderror" 
                id="performer-name" 
                name="name"
                value="{{old('name', $performer->name)}}"
            >
 
            @error('name')
                <p class="invalid-feedback">{{ $errors->first('name') }}</p>
            @enderror
 
        </div>
 
        <button type="submit" class="btn btn-primary">{{ $performer->exists ? 'Rediģēt' : 'Pievienot'}}</button> 
 
    </form>
 
@endsection

