@extends('layouts.app')

@section('title', 'Update Inventory')

@section('content')
  <div class="pagetitle">
    <h1>Update Inventory</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('inventory.index') }}">Inventory</a></li>
        <li class="breadcrumb-item active">Update Inventory</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <section class="section">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Update Inventory</h5>
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
          action="{{ route('inventory.update', $inventory->id) }}">
          @csrf
          @method('PUT')

          <div class="col-md-6">
            <label for="inventory_id" class="form-label">ID Inventory</label>
            <input type="text" name="inventory_id" class="form-control @error('inventory_id') is-invalid @enderror"
              id="inventory_id" value="{{ old('inventory_id', $inventory->inventory_id) }}">
            @error('inventory_id')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <div class="col-md-6">
            <label for="part_name" class="form-label">Part Name</label>
            <input type="text" name="part_name" class="form-control @error('part_name') is-invalid @enderror"
              id="part_name" value="{{ old('part_name', $inventory->part_name) }}">
            @error('part_name')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <div class="col-md-6">
            <label for="part_number" class="form-label">Part Number</label>
            <input type="text" name="part_number" class="form-control @error('part_number') is-invalid @enderror"
              id="part_number" value="{{ old('part_number', $inventory->part_number) }}">
            @error('part_number')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <div class="col-md-6">
            <label for="type_package" class="form-label">Type Package</label>
            <input type="text" name="type_package" class="form-control @error('type_package') is-invalid @enderror"
              id="type_package" value="{{ old('type_package', $inventory->type_package) }}">
            @error('type_package')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <div class="col-md-6">
            <label for="qty_package" class="form-label">Qty Package Pcs</label>
            <input type="number" name="qty_package" class="form-control @error('qty_package') is-invalid @enderror"
              id="qty_package" value="{{ old('qty_package', $inventory->qty_package) }}">
            @error('qty_package')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <div class="col-md-6">
            <label for="project" class="form-label">Project</label>
            <input type="text" name="project" class="form-control @error('project') is-invalid @enderror"
              id="project" value="{{ old('project', $inventory->project) }}">
            @error('project')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <div class="col-md-6">
            <label for="customer" class="form-label">Customer</label>
            <select name="customer" class="form-control @error('customer') is-invalid @enderror" id="customer" required>
              <option value="">Select Customer</option>
              @foreach ($customers as $customer)
                <option value="{{ $customer->name }}"
                  {{ old('customer', $inventory->customer) == $customer->name ? 'selected' : '' }}>
                  {{ $customer->name }}
                </option>
              @endforeach
            </select>
            @error('customer')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <div class="col-md-6">
            <label for="detail_lokasi" class="form-label">Detail Lokasi</label>
            <input type="text" name="detail_lokasi" class="form-control @error('detail_lokasi') is-invalid @enderror"
              id="detail_lokasi" value="{{ old('detail_lokasi', $inventory->detail_lokasi) }}">
            @error('detail_lokasi')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <div class="col-md-6">
            <label for="satuan" class="form-label">Unit</label>
            <select name="satuan" class="form-control @error('satuan') is-invalid @enderror" id="satuan" required>
              <option value="">Select Unit</option>
              <option value="pcs" {{ old('satuan', $inventory->satuan) == 'pcs' ? 'selected' : '' }}>Pcs</option>
              <option value="kg" {{ old('satuan', $inventory->satuan) == 'kg' ? 'selected' : '' }}>Kg</option>
            </select>
            @error('satuan')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <div class="col-md-6">
            <label for="stok_awal" class="form-label">Stok Awal</label>
            <input type="number" name="stok_awal" class="form-control @error('stok_awal') is-invalid @enderror"
              id="stok_awal" value="{{ old('stok_awal', $inventory->stok_awal) }}">
            @error('stok_awal')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>
          <div class="col-md-6">
            <label for="plant" class="form-label">Plant</label>
            <input type="text" name="plant" class="form-control @error('plant') is-invalid @enderror"
              id="plant" value="{{ old('plant', $inventory->plant) }}">
            @error('plant')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <div class="col-md-6">
            <label for="status_product" class="form-label">Status Product</label>
            <select name="status_product" class="form-control @error('status_product') is-invalid @enderror"
              id="status_product" required>
              <option value="">Select Status Product</option>
              <option value="FG" {{ old('status_product', $inventory->status_product) == 'FG' ? 'selected' : '' }}>
                FG</option>
              <option value="WIP" {{ old('status_product', $inventory->status_product) == 'WIP' ? 'selected' : '' }}>
                WIP</option>
              <option value="CHILPART"
                {{ old('status_product', $inventory->status_product) == 'CHILPART' ? 'selected' : '' }}>CHILPART</option>
              <option value="RAW MATERIAL"
                {{ old('status_product', $inventory->status_product) == 'RAW MATERIAL' ? 'selected' : '' }}>RAW MATERIAL
              </option>
            </select>
            @error('status_product')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <div class="col-12">
            <button class="btn btn-primary" type="submit">Update Inventory</button>
          </div>
        </form><!-- End Custom Styled Validation -->
      </div>
    </div>
  </section>
@endsection
