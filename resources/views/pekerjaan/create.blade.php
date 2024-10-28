@extends('adminlte::page')
@section('title', 'Tambah Harga Satuan Pekerjaan')
@section('content')
<div class="container">
    <form action="{{ route('pekerjaan.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" name="title" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="satuan">Satuan</label>
            <input type="text" name="satuan" class="form-control" required>
        </div>

        <h4>Details</h4>

        {{-- UPAH Section --}}
        <h5>UPAH</h5>
        <table class="table table-bordered" id="upahDetailsTable">
            <thead>
                <tr>
                    <th>Uraian</th>
                    <th>Harga Satuan</th>
                    <th>Koefisien</th>
                    <th>Total Harga</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="upahDetails"></tbody>
        </table>
        <button type="button" class="btn btn-secondary mt-2" onclick="addDetail('upah')">Add UPAH</button>

        {{-- BAHAN Section --}}
        <h5>BAHAN</h5>
        <table class="table table-bordered" id="bahanDetailsTable">
            <thead>
                <tr>
                    <th>Uraian</th>
                    <th>Harga Satuan</th>
                    <th>Koefisien</th>
                    <th>Total Harga</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="bahanDetails"></tbody>
        </table>
        <button type="button" class="btn btn-secondary mt-2" onclick="addDetail('bahan')">Add BAHAN</button>

        {{-- ALAT Section --}}
        <h5>ALAT</h5>
        <table class="table table-bordered" id="alatDetailsTable">
            <thead>
                <tr>
                    <th>Uraian</th>
                    <th>Harga Satuan</th>
                    <th>Koefisien</th>
                    <th>Total Harga</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="alatDetails"></tbody>
        </table>
        <button type="button" class="btn btn-secondary mt-2" onclick="addDetail('alat')">Add ALAT</button>

        <button type="submit" class="btn btn-primary mt-3">Save</button>
    </form>
</div>

<script>
    function addDetail(type) {
        const container = document.getElementById(`${type}Details`);
        const index = container.children.length;

        const newDetail = `
            <tr class="detail-item">
                <td>
                    <select name="details[${type}][${index}][harga_satuan_id]" class="form-control" onchange="updateHarga(this)">
                        ${document.getElementById(`${type}Options`).innerHTML}
                    </select>
                </td>
                <td><input type="text" name="details[${type}][${index}][harga]" class="form-control harga" readonly></td>
                <td><input type="number" name="details[${type}][${index}][koefisien]" class="form-control" placeholder="Koefisien" oninput="calculateTotal(this)" required></td>
                <td><input type="text" name="details[${type}][${index}][total_harga]" class="form-control total_harga" readonly></td>
                <td><button type="button" class="btn btn-danger remove-button">Remove</button></td>
            </tr>
        `;
        container.insertAdjacentHTML('beforeend', newDetail);
    }

    function updateHarga(select) {
        const harga = select.options[select.selectedIndex].dataset.harga;
        const row = select.closest('tr');
        row.querySelector('.harga').value = harga;
        calculateTotal(row.querySelector('[name*="[koefisien]"]'));
    }

    function calculateTotal(input) {
        const row = input.closest('tr');
        const harga = parseFloat(row.querySelector('.harga').value) || 0;
        const koefisien = parseFloat(input.value) || 0;
        const total = harga * koefisien;
        row.querySelector('.total_harga').value = total.toFixed(2);
    }

    document.addEventListener('click', function(event) {
        if (event.target.classList.contains('remove-button')) {
            event.target.closest('.detail-item').remove();
        }
    });
</script>

{{-- Hidden select options for UPAH, BAHAN, and ALAT --}}
<select id="upahOptions" class="d-none">
    @foreach($upahList as $upah)
        <option value="{{ $upah->id }}" data-harga="{{ $upah->harga }}">{{ $upah->nama }} ({{ $upah->harga }})</option>
    @endforeach
</select>

<select id="bahanOptions" class="d-none">
    @foreach($bahanList as $bahan)
        <option value="{{ $bahan->id }}" data-harga="{{ $bahan->harga }}">{{ $bahan->nama }} ({{ $bahan->harga }})</option>
    @endforeach
</select>

<select id="alatOptions" class="d-none">
    @foreach($alatList as $alat)
        <option value="{{ $alat->id }}" data-harga="{{ $alat->harga }}">{{ $alat->nama }} ({{ $alat->harga }})</option>
    @endforeach
</select>
@endsection
