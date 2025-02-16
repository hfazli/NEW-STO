@extends('layouts.app')

@section('title', 'Update Daily')

@section('content')
    <div class="pagetitle">
        <h1>Update Daily</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('daily.index') }}">Daily</a></li>
                <li class="breadcrumb-item active">Update Daily</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Update Daily</h5>
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif
                <!-- Custom Styled Validation -->
                <form class="row g-3 needs-validation" novalidate enctype="multipart/form-data" method="POST"
                    action="{{ route('daily.update', $daily->id) }}">
                    @csrf
                    @method('PUT')

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="inventory_id" class="form-label">ID Inventory</label>
                            <select class="form-control" id="inventory_id" name="inventory_id" required>
                                <option value="">Select Inventory ID</option>
                                @foreach($inventory as $item)
                                    <option value="{{ $item->id }}" {{ old('inventory_id', $daily->inventory_id) == $item->id ? 'selected' : '' }}>
                                        {{ $item->id }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="part_name" class="form-label">Part Name</label>
                            <select class="form-control" id="part_name" name="part_name" required>
                                <option value="">Select Part Name</option>
                                @foreach($inventory as $item)
                                    <option value="{{ $item->part_name }}" {{ old('part_name', $daily->part_name) == $item->part_name ? 'selected' : '' }}>
                                        {{ $item->part_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="part_number" class="form-label">Part Number</label>
                            <select class="form-control" id="part_number" name="part_number" required>
                                <option value="">Select Part Number</option>
                                @foreach($inventory as $item)
                                    <option value="{{ $item->part_number }}" {{ old('part_number', $daily->part_number) == $item->part_number ? 'selected' : '' }}>
                                        {{ $item->part_number }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="customer" class="form-label">Customer</label>
                            <select class="form-control" id="customer" name="customer" required>
                                <option value="">Select Customer</option>
                                <option value="ADM-KAP" {{ old('customer', $daily->customer) == 'ADM-KAP' ? 'selected' : '' }}>ADM-KAP</option>
                                <option value="ADM-KEP" {{ old('customer', $daily->customer) == 'ADM-KEP' ? 'selected' : '' }}>ADM-KEP</option>
                                <option value="ADM-SAP" {{ old('customer', $daily->customer) == 'ADM-SAP' ? 'selected' : '' }}>ADM-SAP</option>
                                <option value="ADM-SEP" {{ old('customer', $daily->customer) == 'ADM-SEP' ? 'selected' : '' }}>ADM-SEP</option>
                                <option value="ADM-SPD" {{ old('customer', $daily->customer) == 'ADM-SPD' ? 'selected' : '' }}>ADM-SPD</option>
                                <option value="ASMO-DMIA" {{ old('customer', $daily->customer) == 'ASMO-DMIA' ? 'selected' : '' }}>ASMO-DMIA</option>
                                <option value="DENSO" {{ old('customer', $daily->customer) == 'DENSO' ? 'selected' : '' }}>DENSO</option>
                                <option value="GMK" {{ old('customer', $daily->customer) == 'GMK' ? 'selected' : '' }}>GMK</option>
                                <option value="HAC" {{ old('customer', $daily->customer) == 'HAC' ? 'selected' : '' }}>HAC</option>
                                <option value="HINO" {{ old('customer', $daily->customer) == 'HINO' ? 'selected' : '' }}>HINO</option>
                                <option value="HINO-SPD" {{ old('customer', $daily->customer) == 'HINO-SPD' ? 'selected' : '' }}>HINO-SPD</option>
                                <option value="HMMI" {{ old('customer', $daily->customer) == 'HMMI' ? 'selected' : '' }}>HMMI</option>
                                <option value="HPM" {{ old('customer', $daily->customer) == 'HPM' ? 'selected' : '' }}>HPM</option>
                                <option value="HPM-SPD LOKAL" {{ old('customer', $daily->customer) == 'HPM-SPD LOKAL' ? 'selected' : '' }}>HPM-SPD LOKAL</option>
                                <option value="IAMI" {{ old('customer', $daily->customer) == 'IAMI' ? 'selected' : '' }}>IAMI</option>
                                <option value="IPI" {{ old('customer', $daily->customer) == 'IPI' ? 'selected' : '' }}>IPI</option>
                                <option value="IRC" {{ old('customer', $daily->customer) == 'IRC' ? 'selected' : '' }}>IRC</option>
                                <option value="KTB" {{ old('customer', $daily->customer) == 'KTB' ? 'selected' : '' }}>KTB</option>
                                <option value="KTB-SPD" {{ old('customer', $daily->customer) == 'KTB-SPD' ? 'selected' : '' }}>KTB-SPD</option>
                                <option value="MAH SING" {{ old('customer', $daily->customer) == 'MAH SING' ? 'selected' : '' }}>MAH SING</option>
                                <option value="MMKI" {{ old('customer', $daily->customer) == 'MMKI' ? 'selected' : '' }}>MMKI</option>
                                <option value="MMKI-SPD" {{ old('customer', $daily->customer) == 'MMKI-SPD' ? 'selected' : '' }}>MMKI-SPD</option>
                                <option value="NAFUCO" {{ old('customer', $daily->customer) == 'NAFUCO' ? 'selected' : '' }}>NAFUCO</option>
                                <option value="NAGASSE" {{ old('customer', $daily->customer) == 'NAGASSE' ? 'selected' : '' }}>NAGASSE</option>
                                <option value="NISSEN" {{ old('customer', $daily->customer) == 'NISSEN' ? 'selected' : '' }}>NISSEN</option>
                                <option value="PBI" {{ old('customer', $daily->customer) == 'PBI' ? 'selected' : '' }}>PBI</option>
                                <option value="SIM" {{ old('customer', $daily->customer) == 'SIM' ? 'selected' : '' }}>SIM</option>
                                <option value="SIM-SPD" {{ old('customer', $daily->customer) == 'SIM-SPD' ? 'selected' : '' }}>SIM-SPD</option>
                                <option value="SMI" {{ old('customer', $daily->customer) == 'SMI' ? 'selected' : '' }}>SMI</option>
                                <option value="TMMIN" {{ old('customer', $daily->customer) == 'TMMIN' ? 'selected' : '' }}>TMMIN</option>
                                <option value="TMMIN-POQ" {{ old('customer', $daily->customer) == 'TMMIN-POQ' ? 'selected' : '' }}>TMMIN-POQ</option>
                                <option value="TRID" {{ old('customer', $daily->customer) == 'TRID' ? 'selected' : '' }}>TRID</option>
                                <option value="VALEO" {{ old('customer', $daily->customer) == 'VALEO' ? 'selected' : '' }}>VALEO</option>
                                <option value="YMPI" {{ old('customer', $daily->customer) == 'YMPI' ? 'selected' : '' }}>YMPI</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="status_product" class="form-label">Status Product</label>
                            <select class="form-control" id="status_product" name="status_product" required>
                                <option value="">Select Status Product</option>
                                <option value="FG" {{ old('status_product', $daily->status_product) == 'FG' ? 'selected' : '' }}>FG</option>
                                <option value="WIP" {{ old('status_product', $daily->status_product) == 'WIP' ? 'selected' : '' }}>WIP</option>
                                <option value="CHILPART" {{ old('status_product', $daily->status_product) == 'CHILPART' ? 'selected' : '' }}>CHILPART</option>
                                <option value="RAW MATERIAL" {{ old('status_product', $daily->status_product) == 'RAW MATERIAL' ? 'selected' : '' }}>RAW MATERIAL</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="lokasi" class="form-label">Lokasi</label>
                            <input type="text" class="form-control" id="lokasi" name="lokasi" value="{{ old('lokasi', $daily->lokasi) }}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="min_stock" class="form-label">Min Stok</label>
                            <input type="number" name="min_stock" class="form-control" id="min_stock" value="{{ old('min_stock', $daily->min_stock) }}" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="max_stock" class="form-label">Max Stok</label>
                            <input type="number" name="max_stock" class="form-control" id="max_stock" value="{{ old('max_stock', $daily->max_stock) }}" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="actual_stock" class="form-label">Actual Stok</label>
                            <input type="number" name="actual_stock" class="form-control" id="actual_stock" value="{{ old('actual_stock', $daily->actual_stock) }}" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="date" class="form-label">Date</label>
                            <input type="date" name="date" class="form-control" id="date" value="{{ old('date', $daily->date) }}" required>
                        </div>
                    </div>

                    <div class="col-12">
                        <button class="btn btn-primary" type="submit">Update Daily</button>
                    </div>
                </form><!-- End Custom Styled Validation -->
            </div>
        </div>
    </section>
@endsection