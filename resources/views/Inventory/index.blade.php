@extends('layouts.app')

@section('title', 'Data Inventory')

@section('content')
   <div class="pagetitle">
       <h1>Inventory</h1>
       <nav>
           <ol class="breadcrumb">
               <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
               <li class="breadcrumb-item active"> Data Inventory</li>
           </ol>
       </nav>
   </div>

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
               <h5 class="card-title">Inventory List</h5>

               <a href="{{ route('inventory.create') }}" class="btn btn-primary mb-3">
                   <i class="fas fa-plus"></i> Create New Inventory
               </a>

               <button type="button" class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#importModal">
                   <i class="fas fa-file-excel"></i> Import Excel Inventory
               </button>
               <div class="table-responsive">
                   <table class="table table-bordered text-center align-middle datatable">
                       <thead class="thead-light">
                           <tr>
                               <th>No</th>
                               <th>Inventory ID</th>
                               <th>Part Name</th>
                               <th>Part Number</th>
                               <th>Type Package</th>
                               <th>Qty/Box</th>
                               <th>Status Product</th> <!-- Moved Status Product column -->
                               <th>Project</th>
                               <th>Customer</th>
                               <th>Detail Lokasi</th>
                               <th>Unit</th>
                               <th>Stok Awal</th>
                               <th>Plant</th>
                               <th>Actions</th> <!-- Added Actions column -->
                           </tr>
                       </thead>
                       <tbody>
                           @foreach($inventory as $index => $item)
                               <tr>
                                   <td>{{ $index + 1 }}</td>
                                   <td>{{ $item->inventory_id }}</td>
                                   <td>{{ $item->part_name }}</td>
                                   <td>{{ $item->part_number }}</td>
                                   <td>{{ $item->type_package }}</td>
                                   <td>{{ $item->qty_package }}</td>
                                   <td>{{ $item->status_product }}</td> <!-- Moved Status Product data display -->
                                   <td>{{ $item->project }}</td>
                                   <td>{{ $item->customer }}</td>
                                   <td>{{ $item->detail_lokasi }}</td>
                                   <td>{{ $item->satuan }}</td>
                                   <td>{{ $item->stok_awal }}</td>
                                   <td>{{ $item->plant }}</td>
                                   <td>
                                       <div class="d-flex justify-content-center">
                                           <a href="{{ route('inventory.edit', $item->id) }}" class="btn btn-primary me-2">
                                               <i class="fas fa-edit"></i> Edit
                                           </a>
                                           <form action="{{ route('inventory.destroy', $item->id) }}" method="POST" id="delete-form-{{ $item->id }}" style="display:inline;">
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
                   <h5 class="modal-title" id="importModalLabel">Import Inventory from Excel</h5>
                   <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
               </div>
               <div class="modal-body">
                   <form id="importForm" action="{{ route('inventory.import') }}" method="POST" enctype="multipart/form-data">
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
                   fetch(`/inventory/${partId}/change-status`, {
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