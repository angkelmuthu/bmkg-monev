<?php

include_once 'html_to_doc.php';

$this->db->where_in("kode_indikator_kinerja", json_decode($indikator_program, true));
$result = $this->db->get("m_indikator_kinerja")->result();
$iprogram = '';
foreach ($result as $row) {
    $iprogram .= '<li>' . $row->nama_indikator_kinerja . '</li>';
}

$ikegiatan = '';
$this->db->where_in("kode_indikator_kinerja", json_decode($indikator_kegiatan, true));
$result = $this->db->get("m_indikator_kinerja")->result();
foreach ($result as $row) {
    $ikegiatan .= '<li>' . $row->nama_indikator_kinerja . '</li>';
}

$ikro = '';
$this->db->where("kode_indikator_kinerja", $indikator_kro);
$result = $this->db->get("m_indikator_kinerja")->result();
foreach ($result as $row) {
    $ikro .= $row->nama_indikator_kinerja;
}

if (!empty($isi)) {
    $konten = $isi;
} else {
    $konten = '';
}
// Initialize class
$htmltodoc = new HTML_TO_DOC();

$htmlContent = '<!Doctype html>
<html>
<style>
body{
    margin: 0;
    font-family: -apple-system, BlinkMacSystemFont, "Arial", Segoe UI, Roboto, Helvetica Neue;
    font-size: 0.8125rem;
    font-weight: 400;
    line-height: 1.47;
    color: #212529;
    text-align: left;
}
.judul{
    font-family: "Arial", Segoe UI, Roboto, Helvetica Neue;
    text-align: center;
}
.isi{
    font-family: "Arial", Segoe UI, Roboto, Helvetica Neue;
    text-align: justify;
    text-justify: inter-word;
}
/*design table 1*/
.table1 {
    font-family: sans-serif;
    color: #232323;
    border-collapse: collapse;
}
.table1, th, td {
    padding: 8px 20px;
}

.right {
    float: right;
    width: 30;
    border: 3px solid #73AD21;
    padding: 10px;
  }
</style>
<body>
<p class="judul"><b>
    KERANGKA ACUAN KERJA (KAK) / TERM of REFERENCE (TOR)
<br>
    KELUARAN (OUTPUT) KEGIATAN T.A ' . $tahun . '
</b></p>
<br>
<table class="table1">
<tr>
    <td>Kementerian Lembaga</td>
    <td width="5px">:</td>
    <td>' . $nama_unit . '</td>
</tr>
<tr>
    <td>Unit Eselon I</td>
    <td width="5px">:</td>
    <td>' . $nama_unit_eselon_1 . '</td>
</tr>

<tr>
    <td>Program</td>
    <td width="5px">:</td>
    <td>' . $nama_program . '</td>
</tr>
<tr>
    <td>Program Sasaran</td>
    <td width="5px">:</td>
    <td>' . $nama_program_sasaran . '</td>
</tr>
<tr>
    <td>Indikator Program</td>
    <td width="5px">:</td>
    <td>
        <ol>' . $iprogram . '</ol>
    </td>
</tr>
<tr>
    <td>Unit Eselon II</td>
    <td width="5px">:</td>
    <td>' . $nama_unit_eselon_2 . '</td>
</tr>
<tr>
    <td>Kegiatan</td>
    <td width="5px">:</td>
    <td>' . $nama_kegiatan . '</td>
</tr>
<tr>
    <td>Kegiatan Sasaran</td>
    <td width="5px">:</td>
    <td>' . $nama_kegiatan_sasaran . '</td>
</tr>
<tr>
    <td>Indikator Kegiatan</td>
    <td width="5px">:</td>
    <td>
        <ol>' . $ikegiatan . '</ol>
    </td>
</tr>
<tr>
    <td>Kro</td>
    <td width="5px">:</td>
    <td>' . $nama_kro . '</td>
</tr>
<tr>
    <td>Indikator Kro</td>
    <td width="5px">:</td>
    <td>' . $ikro . '</td>
</tr>
<tr>
    <td>Ro</td>
    <td width="5px">:</td>
    <td>' . $nama_ro . '</td>
</tr>
<tr>
    <td>Volume</td>
    <td width="5px">:</td>
    <td>' . $volume . '</td>
</tr>
<tr>
    <td>Satuan</td>
    <td width="5px">:</td>
    <td>' . $nama_satuan . '</td>
</tr>
</table>
<div class="isi">' . $isi . '</div>
<br><br>
<table>
<tr>
<td width="50%"></td>
<td>
<p style="margin:0;text-align: center;">' . $ttd_tempat . ', ' . tgl_indo($ttd_tanggal) . '</p>
<p style="margin:0;text-align: center;">Penanggaung Jawab Kegiatan</p>
<p style="margin:0;text-align: center;">' . $ttd_jabatan . '</p>
<br><br><br><br>
<p style="margin:0;text-align: center;border-bottom: 1px solid;">' . $ttd_nama . '</p>
<p style="margin:0;text-align: center;">' . $ttd_nip . '</p>
</td>
</tr>
</table>
    </body>
    </html>';

$filename = 'e-TOR_' . $nama_unit_eselon_2 . '_TA_' . $tahun;

$htmltodoc->createDoc($htmlContent, $filename, 1);
