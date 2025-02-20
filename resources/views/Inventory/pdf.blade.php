<!DOCTYPE html>
<html>
<head>
    <title>Inventory PDF</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #000;
            padding: 12px; /* Menambah padding untuk membuat tabel lebih besar */
            text-align: left;
            font-size: 30px; /* Mengatur ukuran font teks menjadi lebih besar */
        }
        th {
            background-color:rgb(255, 255, 255);
        }
        .barcode, .qrcode {
            text-align: center;
            margin-top: 20px;
        }
        .barcode p {
            font-size: 40px; /* Mengatur ukuran font teks menjadi lebih besar */
        }
        .sto-periode {
            text-align: center;
            font-size: 40px; /* Mengatur ukuran font teks menjadi lebih besar */
        }
    </style>
</head>
<body>
    <p class="sto-periode">Sto Periode: <?php echo date('d F Y'); ?></p> <!-- Added sto periode based on current date -->   
    <div class="barcode">
        <?php
            $generator = new Picqer\Barcode\BarcodeGeneratorPNG();
            echo '<img src="data:image/png;base64,' . base64_encode($generator->getBarcode($inventory->inventory_id, $generator::TYPE_CODE_128)) . '" width="500" height="150">';
        ?>
        <p>{{ $inventory->inventory_id }}</p>
    </div>
    <table>
        <tr>
            <th>Inventory ID</th>
            <td>{{ $inventory->inventory_id }}</td>
        </tr>
        <tr>
            <th>Part Name</th>
            <td>{{ $inventory->part_name }}</td>
        </tr>
        <tr>
            <th>Part Number</th>
            <td>{{ $inventory->part_number }}</td>
        </tr>
        <tr>
            <th>Type Package</th>
            <td>{{ $inventory->type_package }}</td>
        </tr>
        <tr>
            <th>Qty/Box</th>
            <td>{{ $inventory->qty_package }}</td>
        </tr>
        <tr>
            <th>Status Product</th>
            <td>{{ $inventory->status_product }}</td>
        </tr>
        <tr>
            <th>Project</th>
            <td>{{ $inventory->project }}</td>
        </tr>
        <tr>
            <th>Customer</th>
            <td>{{ $inventory->customer }}</td>
        </tr>
        <tr>
            <th>Detail Lokasi</th>
            <td>{{ $inventory->detail_lokasi }}</td>
        </tr>
        <tr>
            <th>Unit</th>
            <td>{{ $inventory->satuan }}</td>
        </tr>
        <tr>
            <th>Plant</th>
            <td>{{ $inventory->plant }}</td>
        </tr>
    </table>
</body>
</html>