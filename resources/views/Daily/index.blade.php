@extends('layouts.app')

@section('title', 'Data Inventory')

@section('content')
   <div class="pagetitle">
       <h1>Daily Stok</h1>
       <nav>
           <ol class="breadcrumb">
               <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
               <li class="breadcrumb-item active"> Data Stok</li>
           </ol>
       </nav>
   </div>

   <form method="GET" action="{{ route('daily.index') }}" class="mb-3">
       <div class="row">
           <div class="col-md-4">
               <label for="start_date" class="form-label">Start Date</label>
               <input type="date" name="start_date" id="start_date" class="form-control" placeholder="Start Date" value="{{ request('start_date') }}">
           </div>
           <div class="col-md-4">
               <label for="end_date" class="form-label">End Date</label>
               <input type="date" name="end_date" id="end_date" class="form-control" placeholder="End Date" value="{{ request('end_date') }}">
           </div>
           <div class="col-md-4 d-flex align-items-end">
               <button type="submit" class="btn btn-primary w-100">Filter</button>
           </div>
       </div>
   </form>

   @if(session('success'))
       <div class="alert alert-success alert-dismissible fade show" role="alert">
           {{ session('success') }}
           <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
       </div>
   @endif

   @if(session('error'))
       <div class="alert alert-danger alert-dismissible fade show" role="alert">
           {{ session('error') }}
           <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
       </div>
   @endif

   @if(session('errorRows'))
       <div class="alert alert-warning alert-dismissible fade show" role="alert">
           <strong>Some rows failed to import:</strong>
           <ul>
               @foreach(session('errorRows') as $errorRow)
                   <li>
                       Row: {{ json_encode($errorRow['row']) }}<br>
                       Errors: {{ implode(', ', $errorRow['errors']) }}
                   </li>
               @endforeach
           </ul>
           <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
       </div>
   @endif

   <section class="section">
       <div class="card">
           <div class="card-body">
               <h5 class="card-title">Stok List</h5>

               <a href="{{ route('daily.create') }}" class="btn btn-primary mb-3">
                   <i class="fas fa-plus"></i> Create New Stok Daily
               </a>

               <button type="button" class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#importModal">
                   <i class="fas fa-file-excel"></i> Import Excel Stok Daily
               </button>

               <div class="table-responsive">
                   <table class="table table-bordered text-center align-middle datatable">
                       <thead class="thead-light">
                           <tr>
                               <th>No</th>
                               <th>Inventory ID</th>
                               <th>Part Name</th>
                               <th>Part Number</th>
                               <th>Lokasi</th>
                               <th>Status Product</th>
                               <th>Customer</th>

                               <th>Min Stok</th>
                               <th>Max Stok</th>
                               <th>Actual Stok</th>
                               <th>Date</th>
                               <th>Actions</th>
                           </tr>
                       </thead>
                       <tbody>
                           @foreach($daily as $index => $item)
                               <tr>
                                   <td>{{ $index + 1 }}</td>
                                   <td>{{ $item->inventory_id }}</td>
                                   <td>{{ $item->part_name }}</td>
                                   <td>{{ $item->part_number }}</td>
                                   <td>{{ $item->lokasi }}</td>
                                   <td>{{ $item->status_product }}</td>
                                   <td>{{ $item->customer }}</td>
                                   <td>{{ $item->min_stock }}</td>
                                   <td>{{ $item->max_stock }}</td>
                                   <td>{{ $item->actual_stock }}</td>
                                   <td>{{ $item->date }}</td>
                                   <td>
                                       <div class="d-flex justify-content-center">
                                           <a href="{{ route('daily.edit', $item->id) }}" class="btn btn-primary me-2">
                                               <i class="fas fa-edit"></i> Edit
                                           </a>
                                           <form action="{{ route('daily.destroy', $item->id) }}" method="POST" id="delete-form-{{ $item->id }}" style="display:inline;">
                                               @csrf
                                               @method('DELETE')
                                               <button type="button" onclick="confirmDelete({{ $item->id }})" class="btn btn-danger">
                                                   <i class="bi bi-trash3"></i> Delete
                                               </button>
                                           </form>
                                       </div>
                                   </td>
                               </tr>
                           @endforeach
                       </tbody>
                   </table>
               </div>
           </div>
       </div>
   </section>

   <div class="modal fade" id="importModal" tabindex="-1" aria-labelledby="importModalLabel" aria-hidden="true">
       <div class="modal-dialog">
           <div class="modal-content">
               <div class="modal-header">
                   <h5 class="modal-title" id="importModalLabel">Import Daily from Excel</h5>
                   <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
               </div>
               <div class="modal-body">
                   <form id="importForm" action="{{ route('daily.import') }}" method="POST" enctype="multipart/form-data">
                       @csrf
                       <div class="mb-3">
                           <label for="file" class="form-label">Upload Excel File</label>
                           <input type="file" name="file" class="form-control" id="file" required accept=".xls,.xlsx">
                       </div>
                       <div class="modal-footer">
                           <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                           <button type="submit" class="btn btn-success">Import</button>
                       </div>
                   </form>
               </div>
           </div>
       </div>
   </div>

   <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
   <script>
       function confirmDelete(id) {
           if (confirm('Are you sure you want to delete this item?')) {
               document.getElementById('delete-form-' + id).submit();
           }
       }

       function changeEntriesPerPage() {
           const entriesPerPage = document.getElementById('entriesPerPage').value;
           const url = new URL(window.location.href);
           if (entriesPerPage === 'all') {
               url.searchParams.delete('entries');
           } else {
               url.searchParams.set('entries', entriesPerPage);
           }
           window.location.href = url.toString();
       }

       function changeStatus(partId, status) {
           Swal.fire({
               title: 'Apakah Anda yakin?',
               text: status === 0 ? "Status akan diubah menjadi Nonaktif!" : "Status akan diubah menjadi Aktif!",
               icon: 'warning',
               showCancelButton: true,
               confirmButtonColor: status === 1 ? '#28a745' : '#d33',
               cancelButtonColor: '#6c757d',
               confirmButtonText: 'Ya, Ubah',
               cancelButtonText: 'Batal'
           }).then((result) => {
               if (result.isConfirmed) {
                   fetch(`/daily/${partId}/change-status`, {
                       method: 'POST',
                       headers: {
                           'Content-Type': 'application/json',
                           'X-CSRF-TOKEN': '{{ csrf_token() }}'
                       },
                       body: JSON.stringify({ status })
                   })
                   .then(response => response.json())
                   .then(data => {
                       if (data.success) {
                           Swal.fire({
                               title: 'Berhasil!',
                               text: data.message,
                               icon: 'success',
                               confirmButtonColor: '#28a745',
                               confirmButtonText: 'OK'
                           }).then(() => {
                               location.reload();
                           });
                       } else {
                           Swal.fire({
                               title: 'Gagal!',
                               text: data.message,
                               icon: 'error',
                               confirmButtonColor: '#d33',
                               confirmButtonText: 'OK'
                           });
                       }
                   })
                   .catch(error => {
                       Swal.fire({
                           title: 'Error!',
                           text: 'Terjadi kesalahan saat memproses permintaan.',
                           icon: 'error',
                           confirmButtonColor: '#d33',
                           confirmButtonText: 'OK'
                       });  
                       console.error('Error:', error);
                   });
               }
           });
       }
   </script>
@endsection