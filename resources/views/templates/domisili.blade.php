<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>SURAT PERNYATAAN DOMISILI TEMPAT TINGGAL</title>
    <style>
        body {
            font-family: 'Times New Roman', Times, serif;
            font-size: 12pt;
            line-height: 1.5;
        }
        .underline {
            text-decoration: underline;
        }
        .text-center {
            text-align: center;
        }
        .signature-area {
            display: flex;
            justify-content: flex-end; /* rata kanan */
            margin-top: 50px;
        }
        .signature-box {
            text-align: center;
            width: 40%;
        }
        .signature-row {
            display: flex;
            justify-content: space-between; /* kiri–kanan sejajar */
            margin-top: 50px;
        }
        .signature-left,
        .signature-right {
            width: 40%;
            text-align: center;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        td {
            padding: 5px;
            vertical-align: top;
        }
    </style>
</head>
<body>
    <div class="text-center">
        <h3><span class="underline">SURAT PERNYATAAN DOMISILI TEMPAT TINGGAL</span></h3>
    </div>

    <p>Saya yang bertanda tangan di bawah ini :</p>

    <table>
        <tr>
            <td width="150">Nama</td>
            <td>: {{ $data['nama'] ?? '' }}</td>
        </tr>
        <tr>
            <td>NIK</td>
            <td>: {{ $data['nik'] ?? '' }}</td>
        </tr>
        <tr>
            <td>Tempat/tanggal lahir</td>
            <td>: {{ $data['tempat_lahir'] ?? '' }}, {{ $data['tanggal_lahir'] ?? '' }}</td>
        </tr>
        <tr>
            <td>Pekerjaan</td>
            <td>: {{ $data['pekerjaan'] ?? '' }}</td>
        </tr>
        <tr>
            <td>Alamat</td>
            <td>: {{ $data['alamat'] ?? '' }}</td>
        </tr>
    </table>

    <p>Dengan ini menyatakan dengan sebenar-benarnya bahwa pada saat ini berdomisili dengan alamat :</p>
    <p>{{ $data['alamat_domisili'] ?? '' }}</p>

    <p>Demikian Surat Pernyataan ini saya buat untuk keperluan :</p>
    <p>{{ $data['keperluan'] ?? '' }}</p>

    <p>Apabila di kemudian hari terbukti bahwa Surat Pernyataan ini tidak benar, maka saya bersedia bertanggung jawab sesuai peraturan perundang-undangan yang berlaku.</p>

    <!-- tanda tangan warga (kanan) -->
    <div class="signature-area">
        <div class="signature-box">
            <p>Yogyakarta, {{ $data['tanggal_surat'] ?? '' }}</p>
            <p>Yang Menyatakan,</p>
            <br><br><br>
            <p>({{ $data['nama'] ?? '' }})</p>
        </div>
    </div>

    <!-- Ketua RW (kiri) & Sekretaris Desa (kanan) -->
    <div class="signature-row">
        <div class="signature-left">
            <p>Ketua RW</p>
            <br><br><br>
            <p>{{ $data['ketua_rw'] ?? '' }}</p>
        </div>
        <div class="signature-right">
            <p>Sekretaris Desa</p>
            <br><br><br>
            <p>{{ $data['pegawai_desa'] ?? '' }}</p>
        </div>
    </div>
</body>
</html>
