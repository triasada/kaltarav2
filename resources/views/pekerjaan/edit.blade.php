@extends('adminlte::page')

@section('title', 'Edit Harga Satuan Pekerjaan')
@section('content')
<div class="container">
    <form action="{{ route('pekerjaan.update', $pekerjaan->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" name="title" class="form-control" value="{{ $pekerjaan->title }}" required>
        </div>

        <div class="form-group">
            <label for="satuan">Satuan</label>
            <input type="text" name="satuan" class="form-control" value="{{ $pekerjaan->satuan }}" required>
        </div>
        <div class="form-group">
            <label for="kabupaten_id">Kabupaten (District)</label>
            <select name="kabupaten_id" class="form-control" required>
                <option value="">Select District</option>
                @foreach($districts as $district)
                    <option value="{{ $district->id }}" 
                        {{ $pekerjaan->kabupaten_id == $district->id ? 'selected' : '' }}>
                        {{ $district->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <h4>Details</h4>

        {{-- UPAH Section --}}
        <h5>UPAH</h5>
        <table class="table table-bordered" id="upahDetailsTable">
            <thead>
                <tr>
                    <th>Nama Harga Satuan</th>
                    <th>Harga Satuan</th>
                    <th>Koefisien</th>
                    <th>Total Harga</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="upahDetails">
                @foreach($pekerjaan->details->where('hargaSatuan.jenis', 'Upah') as $index => $detail)
                    <tr class="detail-item" data-id="{{ $detail->id }}">
                        <td>
                            <select name="details[upah][{{ $index }}][harga_satuan_id]" class="form-control" onchange="updateHarga(this)">
                                @foreach($upahList as $upah)
                                    <option value="{{ $upah->id }}" 
                                        {{ $detail->harga_satuan_id == $upah->id ? 'selected' : '' }}
                                        data-harga="{{ $upah->harga }}">
                                        {{ $upah->nama }} ({{ $upah->harga }})
                                    </option>
                                @endforeach
                            </select>
                        </td>
                        <td><input type="text" name="details[upah][{{ $index }}][harga]" class="form-control harga" value="{{ $detail->hargaSatuan->harga }}" readonly></td>
                        <td><input type="number" step=".01" name="details[upah][{{ $index }}][koefisien]" class="form-control" value="{{ $detail->koefisien }}" oninput="calculateTotal(this)" required></td>
                        <td><input type="text" name="details[upah][{{ $index }}][total_harga]" class="form-control total_harga" value="{{ $detail->total_harga }}" readonly></td>
                        <td><button type="button" class="btn btn-danger remove-button">Remove</button></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <button type="button" class="btn btn-secondary mt-2" onclick="addDetail('upah')">Add UPAH</button>

        {{-- Repeat Similar Sections for BAHAN and ALAT --}}
        <h5>BAHAN</h5>
        <table class="table table-bordered" id="bahanDetailsTable">
            <thead>
                <tr>
                    <th>Nama Harga Satuan</th>
                    <th>Harga Satuan</th>
                    <th>Koefisien</th>
                    <th>Total Harga</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="bahanDetails">
            @foreach($pekerjaan->details->where('hargaSatuan.jenis', 'Bahan') as $index => $detail)
                    <tr class="detail-item" data-id="{{ $detail->id }}">
                        <td>
                            <select name="details[bahan][{{ $index }}][harga_satuan_id]" class="form-control" onchange="updateHarga(this)">
                                @foreach($bahanList as $bahan)
                                    <option value="{{ $bahan->id }}" 
                                        {{ $detail->harga_satuan_id == $bahan->id ? 'selected' : '' }}
                                        data-harga="{{ $bahan->harga }}">
                                        {{ $bahan->nama }} ({{ $bahan->harga }})
                                    </option>
                                @endforeach
                            </select>
                        </td>
                        <td><input type="text" name="details[bahan][{{ $index }}][harga]" class="form-control harga" value="{{ $detail->hargaSatuan->harga }}" readonly></td>
                        <td><input type="number" step=".01" name="details[bahan][{{ $index }}][koefisien]" class="form-control" value="{{ $detail->koefisien }}" oninput="calculateTotal(this)" required></td>
                        <td><input type="text" name="details[bahan][{{ $index }}][total_harga]" class="form-control total_harga" value="{{ $detail->total_harga }}" readonly></td>
                        <td><button type="button" class="btn btn-danger remove-button">Remove</button></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <button type="button" class="btn btn-secondary mt-2" onclick="addDetail('bahan')">Add BAHAN</button>

        <h5>ALAT</h5>
        <table class="table table-bordered" id="alatDetailsTable">
            <thead>
                <tr>
                    <th>Nama Harga Satuan</th>
                    <th>Harga Satuan</th>
                    <th>Koefisien</th>
                    <th>Total Harga</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="alatDetails">
            @foreach($pekerjaan->details->where('hargaSatuan.jenis', 'Alat') as $index => $detail)
                    <tr class="detail-item" data-id="{{ $detail->id }}">
                        <td>
                            <select name="details[alat][{{ $index }}][harga_satuan_id]" class="form-control" onchange="updateHarga(this)">
                                @foreach($alatList as $alat)
                                    <option value="{{ $alat->id }}" 
                                        {{ $detail->harga_satuan_id == $alat->id ? 'selected' : '' }}
                                        data-harga="{{ $alat->harga }}">
                                        {{ $alat->nama }} ({{ $alat->harga }})
                                    </option>
                                @endforeach
                            </select>
                        </td>
                        <td><input type="text" name="details[alat][{{ $index }}][harga]" class="form-control harga" value="{{ $detail->hargaSatuan->harga }}" readonly></td>
                        <td><input type="number" step=".01" name="details[alat][{{ $index }}][koefisien]" class="form-control" value="{{ $detail->koefisien }}" oninput="calculateTotal(this)" required></td>
                        <td><input type="text" name="details[alat][{{ $index }}][total_harga]" class="form-control total_harga" value="{{ $detail->total_harga }}" readonly></td>
                        <td><button type="button" class="btn btn-danger remove-button">Remove</button></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <button type="button" class="btn btn-secondary mt-2" onclick="addDetail('alat')">Add ALAT</button>

        <input type="hidden" id="removedDetails" name="removed_details" value="">
        <button type="submit" class="btn btn-primary mt-3">Update</button>
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
                <td><input type="number" step=".01" name="details[${type}][${index}][koefisien]" class="form-control" placeholder="Koefisien" oninput="calculateTotal(this)" required></td>
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
            const detailItem = event.target.closest('.detail-item');
            const id = detailItem.dataset.id;
            if (id) {
                let removedDetails = JSON.parse(document.getElementById('removedDetails').value || '[]');
                removedDetails.push(id);
                document.getElementById('removedDetails').value = JSON.stringify(removedDetails);
            }
            detailItem.remove();
        }
    });
</script>

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
