@extends('layouts.app')

@section('title', 'Data Report')

@section('content')
    <div class="pagetitle">
         <h1>Report STO</h1>
         <nav>
           <ol class="breadcrumb">
               <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
               <li class="breadcrumb-item active"> Data Report</li>
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

<section class="section">
      <div class="card">
             <div class="card-body">
                     <h5 class="card-title">Report List</h5>
                     <div class="table-responsive">
                     <button type="button" class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#importModal">
                            <i class="fas fa-file-excel"></i> Export Excel FG
                     </button>
                            <table class="table table-bordered text-center align-middle datatable">
                                  <thead class="thead-light">
                                          <tr>
                                                 <th>No</th>
                                                 <th>Part Name</th>
                                                 <th>Part Number</th>
                                                 <th>ID Inventory</th>
                                                 <th>Status Product</th>
                                                 <th>Qty/Package</th>
                                                 <th>Qty Box</th>
                                                 <th>Total</th>
                                                 <th>Grand Total</th>
                                                 <th>STO Periode</th>
                                                 <th>Prepared By</th>
                                                 <th>Checked By</th>
                                                 <th>Detail Lokasi Name</th>
                                                 <th>Detail Lokasi Code</th>
                                                 <th>Plant</th>
                                                 <th>Actions</th>
                                          </tr>
                                  </thead>
                                  <tbody>
                                          @foreach($reports as $index => $report)
                                                 <tr>
                                                        <td>{{ $index + 1 }}</td>
                                                        <td>{{ $report->part_name }}</td>
                                                        <td>{{ $report->part_number }}</td>
                                                        <td>{{ $report->inventory_id }}</td>
                                                        <td>{{ $report->status_product }}</td>
                                                        <td>{{ $report->qty_package }}</td>
                                                        <td>{{ $report->qtybox }}</td>
                                                        <td>{{ $report->total }}</td>
                                                        <td>{{ $report->grand_total }}</td>
                                                        <td>{{ $report->sto_periode }}</td>
                                                        <td>{{ $report->prepared_by }}</td>
                                                        <td>{{ $report->checked_by }}</td>
                                                        <td>{{ $report->detail_lokasi }}</td>
                                                        <td>{{ $report->detail_lokasi_code }}</td>
                                                        <td>{{ $report->plant }}</td>
                                                        <td>
                                                                <div class="d-flex justify-content-center">
                                                                      <a href="{{ route('report.edit', $report->id) }}" class="btn btn-primary me-2">
                                                                             <i class="fas fa-edit"></i> Edit
                                                                      </a>
                                                                      <form action="{{ route('report.destroy', $report->id) }}" method="POST" id="delete-form-{{ $report->id }}" style="display:inline;">
                                                                             @csrf
                                                                             @method('DELETE')
                                                                             <button type="button" onclick="confirmDelete({{ $report->id }})" class="btn btn-danger">
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

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
         function confirmDelete(id) {
              Swal.fire({
                    title: 'Are you sure you want to delete this item?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, delete it!',
                    cancelButtonText: 'Cancel'
              }).then((result) => {
                    if (result.isConfirmed) {
                         document.getElementById('delete-form-' + id).submit();
                    }
              });
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
    </script>
@endsection
