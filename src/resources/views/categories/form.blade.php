@extends('layout')
 
@section('content')
 
    <h1>{{ $title }}</h1>
 
    @if ($errors->any())
        <div class="alert alert-danger">Lūdzu, novērsiet radušās kļūdas!</div>
    @endif
 
    <form method="post" action="{{ $categorie->exists ? '/categories/patch/' . $categorie->id : '/categories/put' }}">
        @csrf
 
        <div class="mb-3">
            <label for="categories-name" class="form-label">Kategorijas nosaukums</label>
 
            <input 
                type="text" 
                class="form-control @error('name') is-invalid @enderror" 
                id="categories-name" 
                name="name"
                value="{{old('name', $categorie->name)}}"
            >
 
            @error('name')
                <p class="invalid-feedback">{{ $errors->first('name') }}</p>
            @enderror
 
        </div>
 
        <button type="submit" class="btn btn-primary">{{ $categorie->exists ? 'Rediģēt' : 'Pievienot'}}</button> 
 
    </form>
 
@endsection

