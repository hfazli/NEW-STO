<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Scan STO</title>
    <meta content="" name="description">
    <meta content="" name="keywords">
    <!-- Favicons -->
    <link href="{{ asset('assets/img/icon-kbi.png') }}" rel="icon">
    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
    <!-- Vendor CSS Files -->
    <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
    <!-- Template Main CSS File -->
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/form.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <style>
        @media print {
            .no-print {
                display: none;
            }
        }
        .barcode-container {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 20px;
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <section class="section">
        <div class="card shadow-sm">
            <div class="card-body p-4">
                <!-- Penanda Login -->
                <div class="navbar-form d-flex justify-content-between align-items-center mb-1 p-2 rounded">
                    <h5 class="card-title" style="font-size: 1.5rem; font-weight: bold; color: #ffff;">
                        <i class="fas fa-box-open me-2"></i> STO Inventory Scan
                        @if (isset($inventory))
                            <p class="colom mt-1" style="font-size: 17px; margin-bottom: -1px; color:rgb(255, 255, 255);">
                                <i class="fas fa-file-invoice"></i>&nbsp;&nbsp;Inventory ID&nbsp;:&nbsp;
                                <strong style="width: 5px; font-size: 20px; color:rgb(255, 225, 0); padding: 1px; text-transform: uppercase;">
                                    {{ $inventory->inventory_id ?? 'Not Available' }}
                                </strong>
                            </p>
                            <p class="colom mt-1" style="font-size: 17px; margin-bottom: -1px; color:rgb(255, 255, 255);">
                                <i class="fas fa-building"></i>&nbsp;&nbsp;Customer&nbsp;:&nbsp;
                                <strong style="width: 5px; font-size: 20px; color:rgb(255, 213, 0); padding: 1px; text-transform: uppercase;">
                                    {{ $inventory->customer ?? 'Not Available' }}
                                </strong>
                            </p>
                        @endif
                    </h5>
                    @if (session('success'))
                        <div id="alertSuccess" class="alert alert-success alert-dismissible fade show mt-1 p-1" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif
                    @if (session('notfound'))
                        <div id="alertNotFound" class="alert alert-danger alert-dismissible fade show mt-1 p-1" role="alert">
                            {{ session('notfound') }}
                        </div>
                    @endif
                    <div class="text-end">
                        <small class="text-muted d-block" style="font-size: 1.2rem; color: #ffffff;">
                            {{ $user->username ?? 'Guest' }}
                            <i class="fas fa-user me-1" style="color:#1abc9c;"></i>
                        </small>
                        <small class="text-muted d-block">
                            <strong style="color: #bdc3c7">
                                @if (!empty($user->last_login) && $user->last_login instanceof \Carbon\Carbon)
                                    {{ $user->last_login->format('d M Y, H:i:s') }}
                                @else
                                    {{ $user->last_login ?? 'Belum login' }}
                                @endif
                            </strong>
                        </small>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section>
        <form id="stoForm" action="{{ route('reports.store') }}" method="POST">
            @csrf
            <div class="row mb-3">
                <div class="col-md-12">
                    <div class="card p-3">
                        <div class="card shadow-sm">
                            <div class="card-body p-4">
                                <h1 class="card-title mb-1 text-left" style="font-size: 1.5rem; font-weight: bold; color: #ffffff;">PT Kyoraku Blowmolding Indonesia</h1>
                                <h1 class="card-title mb-1 text-left" style="font-size: 1.3rem; font-weight: bold; color: #ffffff;">PPIC Departement / Warehouse</h1>
                                <h5 class="card-title mb-3 text-center" style="font-size: 1.5rem; font-weight: bold; color: #ffffff;">WIP</h5>
                                <div class="row mt-4">
                                    <div class="row mb-3">
                                        <label for="partName" class="col-sm-2 col-form-label" style="font-size: 1.2rem;">Part Name</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="partName" name="part_name" value="{{ $inventory->part_name ?? '' }}" readonly>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="partNumber" class="col-sm-2 col-form-label" style="font-size: 1.2rem;">Part Number</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="partNumber" name="part_number" value="{{ $inventory->part_number ?? '' }}" readonly>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="inventoryCode" class="col-sm-2 col-form-label" style="font-size: 1.2rem;">Inventory Code</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="inventoryCode" name="inventory_id" value="{{ $inventory->inventory_id ?? '' }}" readonly>
                                        </div>
                                    </div>
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>MOLDING DATE</th>
                                                <th>SHIFT</th>
                                                <th>QUANTITY</th>
                                                <th>TOTAL</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td><input type="date" class="form-control" id="moldingDate" name="molding_date" value="{{ $inventory->molding_date ?? '' }}" readonly></td>
                                                <td><input type="text" class="form-control" id="shift" name="shift" value="{{ $inventory->shift ?? '' }}" readonly></td>
                                                <td><input type="number" class="form-control" id="qtyPerBox" name="qty_package" value="{{ $inventory->qty_package ?? '' }}" readonly></td>
                                                <td><input type="number" class="form-control" id="total" name="total" value="{{ $inventory->total ?? '' }}" readonly></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <div class="row mb-3 text-center">
                                        <div class="col-md-3">
                                            <label for="locationDetail" class="form-label d-block">Detail Lokasi Name</label>
                                            <input type="text" class="form-control" id="locationDetail" name="detail_lokasi" value="{{ $inventory->detail_lokasi ?? '' }}" readonly>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="locationDetail" class="form-label d-block">Detail Lokasi Name</label>
                                            <input type="text" class="form-control" id="locationDetail" name="detail_lokasi2" value="{{ $inventory->null ?? '' }}">
                                            <label for="locationDetail" class="form-label d-block">(Item Jika Berbeda Rak)</label>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="plant" class="form-label d-block">Plant</label>
                                            <input type="text" class="form-control" id="plant" name="plant" value="{{ $inventory->plant ?? '' }}" readonly>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="userId" class="form-label d-block">ID Card Number</label>
                                            <input type="text" class="form-control" id="userId" name="id_card_number" value="{{ $user->id_card_number ?? '' }}">
                                        </div>
                                    </div>
                                    <div class="text-center d-flex justify-content-center">
                                        <button class="btn btn-success btn-lg me-2" type="button" onclick="confirmSave()">Save</button>
                                        <button class="btn btn-primary btn-lg no-print" type="button" onclick="window.print()">Print PDF</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </section>

    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/tinymce/tinymce.min.js') }}"></script>
    <!-- Template Main JS File -->
    <script src="{{ asset('assets/js/main.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function confirmSave() {
            Swal.fire({
                title: 'Apakah kamu yakin menyimpan ini?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, simpan!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Submit the form
                    document.getElementById('stoForm').submit();
                    
                    // Show success alert
                    Swal.fire({
                        title: 'Berhasil!',
                        text: 'Data berhasil tersimpan.',
                        icon: 'success',
                        confirmButtonText: 'OK'
                    }).then(() => {
                        // Redirect to the reports.index page
                        window.location.href = "{{ route('reports.index') }}";
                    });
                }
            });
        }

        document.addEventListener('DOMContentLoaded', function() {
            const InventoryInput = document.getElementById('InventoryInput');
            const form = document.getElementById('autoSubmitForm');

            if (InventoryInput) {
                InventoryInput.focus(); // Fokus pada input saat halaman dimuat

                // Hapus event listener yang memfokuskan kembali ke InventoryInput
                document.removeEventListener('click', function(event) {
                    if (event.target !== InventoryInput) {
                        InventoryInput.focus();
                    }
                });
            }

            // Fungsi untuk menampilkan alert dengan waktu otomatis hilang
            function showAlert(alertId) { 
                const alertBox = document.getElementById(alertId);
                if (alertBox) {
                    alertBox.style.display = 'block';
                    alertBox.classList.add('show'); // Tambahkan animasi

                    // Hilangkan alert setelah 5 detik
                    setTimeout(() => {
                        alertBox.classList.remove('show');
                        alertBox.classList.add('fade');
                        setTimeout(() => alertBox.remove(), 500); // Hapus setelah fade-out selesai
                    }, 5000);
                }
            }

            // Panggil alert sesuai session
            @if (session('success'))
                showAlert('alertSuccess');
            @elseif (session('notfound'))
                showAlert('alertNotFound');
            @endif
        });

        // Keep session alive setiap 10 menit
        let sessionAlive = true; // Kendalikan secara global
        setInterval(() => {
            if (!sessionAlive) return;
            fetch('/keep-session-alive').catch(() => sessionAlive = false);
        }, 10 * 60 * 1000);

        function debounce(func, delay) {
            let timer;
            return function(...args) {
                clearTimeout(timer);
                timer = setTimeout(() => func.apply(this, args), delay);
            };
        }
        document.getElementById('InventoryInput').addEventListener('input', debounce(resetTimer, 500));
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Panggil fungsi sesuai session
            @if (session('notfound'))
                showAlert('alertNotFound');
            @endif
        });

        // {{-- time alert --}}
        @if (session('success') || session('notfound') || session('gagal'))
            // Waktu delay 5 detik (5000 milidetik)
            setTimeout(function() {
                // Mencari elemen alert yang ada dan menyembunyikannya
                var alertElement = document.querySelector('.alert');
                if (alertElement) {
                    alertElement.classList.remove('show');
                    alertElement.classList.add('fade');
                    setTimeout(function() {
                        alertElement.remove();
                    }, 50); // Menunggu animasi fade-out
                }
            }, 2000);
        @endif
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const qtyPerBox = document.getElementById('qtyPerBox');
            const qtyBoxTotal = document.getElementById('qtyBoxTotal');
            const total = document.getElementById('total');
            const grandTotal = document.getElementById('grandTotal');
            const qtyPerBox2 = document.getElementById('qtyPerBox2');
            const qtyBoxTotal2 = document.getElementById('qtyBoxTotal2');
            const total2 = document.getElementById('total2');

            function calculateTotals() {
                const qtyPerBoxValue = parseFloat(qtyPerBox.value) || 0;
                const qtyBoxTotalValue = parseFloat(qtyBoxTotal.value) || 0;
                const qtyPerBox2Value = parseFloat(qtyPerBox2.value) || 0;
                const qtyBoxTotal2Value = parseFloat(qtyBoxTotal2.value) || 0;

                total.value = qtyPerBoxValue * qtyBoxTotalValue;
                total2.value = qtyPerBox2Value * qtyBoxTotal2Value;
                grandTotal.value = parseFloat(total.value) + parseFloat(total2.value);
            }

            qtyPerBox.addEventListener('input', calculateTotals);
            qtyBoxTotal.addEventListener('input', calculateTotals);
            qtyPerBox2.addEventListener('input', calculateTotals);
            qtyBoxTotal2.addEventListener('input', calculateTotals);

            calculateTotals(); // Initial calculation
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const issueDate = document.getElementById('issueDate');
            const today = new Date();
            const options = { day: 'numeric', month: 'long', year: 'numeric' };
            issueDate.value = today.toLocaleDateString('id-ID', options);
        });
    </script>
</body>

</html>