@extends('layouts.app')

@section('title', 'Edit IKU')

@section('content')
<main class="content">
    <div class="container">
        <h2>Edit IKU</h2>
        <a href="{{ url('/form-iku?year=' . date('Y')) }}" class="btn btn-secondary mb-3">Back</a>

        <form method="POST" action="{{ route('update-iku', ['id' => $iku->id]) }}">
            @csrf
            @method('PUT')

            <input type="hidden" name="sasaran_id" value="{{ $iku->sasaran_id }}">

            <div class="card border-0 shadow">
                <div class="card-body">
                    <div class="mb-3">
                        <label for="iku_name" class="form-label">IKU Name</label>
                        <input type="text" class="form-control" id="iku_name" name="iku_name" value="{{ $iku->iku_name }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="target" class="form-label">Target</label>
                        <input type="text" class="form-control" id="target" name="target" value="{{ $iku->target }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="satuan" class="form-label">Satuan</label>
                        <input type="text" class="form-control" id="satuan" name="satuan" value="{{ $iku->satuan }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="polaritas" class="form-label">Polaritas</label>
                        <select class="form-control" id="polaritas" name="polaritas">
                            <option value="maximize" {{ $iku->polaritas == 'maximize' ? 'selected' : '' }}>Maximize</option>
                            <option value="minimize" {{ $iku->polaritas == 'minimize' ? 'selected' : '' }}>Minimize</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="bobot" class="form-label">Bobot</label>
                        <input type="number" class="form-control" id="bobot" name="bobot" value="{{ $iku->bobot }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="proker" class="form-label">Program Kerja</label>
                        <input type="text" class="form-control" id="proker" name="proker" value="{{ $iku->proker }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="pj" class="form-label">Penanggung Jawab</label>
                        <input type="text" class="form-control" id="pj" name="pj" value="{{ $iku->pj }}" required>
                    </div>

                    <h4>IKU Points</h4>
                    @foreach ($ikuPoints as $index => $point)
                        <div class="mb-3">
                            <label class="form-label">Point Name</label>
                            <input type="text" class="form-control" name="points[{{ $point->id }}][point_name]" value="{{ $point->point_name }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Base</label>
                            <input type="text" class="form-control" name="points[{{ $point->id }}][base]" value="{{ $point->base }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Stretch</label>
                            <input type="text" class="form-control" name="points[{{ $point->id }}][stretch]" value="{{ $point->stretch }}">
                        </div>
                    @endforeach

                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </div>
        </form>
    </div>
</main>
@endsection
