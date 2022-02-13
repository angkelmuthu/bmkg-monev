<?php
//defined('BASEPATH') or exit('No direct script access allowed');
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\Writer\Word2007;
use PhpOffice\PhpWord\Style\BorderSide;
use PhpOffice\PhpWord\Style\BorderStyle;
use PhpOffice\PhpWord\Style\Colors\BasicColor;
use PhpOffice\PhpWord\Style\Colors\Hex;
use PhpOffice\PhpWord\Style\Colors\Rgb;
use PhpOffice\PhpWord\Style\Image;
use PhpOffice\PhpWord\Style\Lengths\Absolute;
use PhpOffice\PhpWord\Style\Lengths\Length;
use PhpOffice\PhpWord\Style\Paragraph;
use PhpOffice\PhpWord\TestHelperDOCX;

class Export extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        //is_login();
        $this->load->model('Tor_head_model');
    }
    // public function tor($id_tor_head)
    // {

    //     $row = $this->Tor_head_model->get_by_id($id_tor_head);
    //     $phpWord = new PhpWord();

    //     $section = $phpWord->addSection();
    //     $html = cleanHTML($row->isi);
    //     \PhpOffice\PhpWord\Settings::setCompatibility(false);
    //     \PhpOffice\PhpWord\Shared\Html::addHtml($section, $html);
    //     header('Content-Type: application/octet-stream');
    //     header('Content-Disposition: attachment;filename="test.docx"');
    //     $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
    //     ob_clean();
    //     $objWriter->save('php://output');
    // }

    public function tor($id_tor_head)
    {

        $row = $this->Tor_head_model->get_by_id($id_tor_head);
        //if ($row) {
        $data = array(
            'id_tor_head' => $row->id_tor_head,
            'kode_unit' => $row->kode_unit,
            'nama_unit' => $row->nama_unit,
            'tahun' => $row->tahun,
            'kode_unit_eselon_1' => $row->kode_unit_eselon_1,
            'nama_unit_eselon_1' => $row->nama_unit_eselon_1,
            'kode_unit_eselon_2' => $row->kode_unit_eselon_2,
            'nama_unit_eselon_2' => $row->nama_unit_eselon_2,
            'kode_program' => $row->kode_program,
            'nama_program' => $row->nama_program,
            'kode_program_sasaran' => $row->kode_program_sasaran,
            'nama_program_sasaran' => $row->nama_program_sasaran,
            'indikator_program' => $row->indikator_program,
            'kode_kegiatan' => $row->kode_kegiatan,
            'nama_kegiatan' => $row->nama_kegiatan,
            'kode_kegiatan_sasaran' => $row->kode_kegiatan_sasaran,
            'nama_kegiatan_sasaran' => $row->nama_kegiatan_sasaran,
            'indikator_kegiatan' => $row->indikator_kegiatan,
            'kode_kro' => $row->kode_kro,
            'nama_kro' => $row->nama_kro,
            'indikator_kro' => $row->indikator_kro,
            'kode_ro' => $row->kode_ro,
            'nama_ro' => $row->nama_ro,
            'volume' => $row->volume,
            'id_satuan' => $row->id_satuan,
            'nama_satuan' => $row->nama_satuan,
            'id_users' => $row->id_users,
            'username' => $row->username,
            'create_date' => $row->create_date,
            'isi' => $row->isi,
            'ttd_tempat' => $row->ttd_tempat,
            'ttd_tanggal' => $row->ttd_tanggal,
            'ttd_jabatan' => $row->ttd_jabatan,
            'ttd_nama' => $row->ttd_nama,
            'ttd_nip' => $row->ttd_nip,
        );
        $this->load->view('export', $data);
    }
    public function rab($id_tor_head)
    {
        $row = $this->Tor_head_model->get_by_id($id_tor_head);
        header("Content-type: application/vnd-ms-excel");
        header("Content-Disposition: attachment; filename=RAB-$row->nama_unit_eselon_2-TA-$row->tahun.xls");

        //if ($row) {
        $data = array(
            'id_tor_head' => $row->id_tor_head,
            'kode_unit' => $row->kode_unit,
            'nama_unit' => $row->nama_unit,
            'tahun' => $row->tahun,
            'kode_unit_eselon_1' => $row->kode_unit_eselon_1,
            'nama_unit_eselon_1' => $row->nama_unit_eselon_1,
            'kode_unit_eselon_2' => $row->kode_unit_eselon_2,
            'nama_unit_eselon_2' => $row->nama_unit_eselon_2,
            'kode_program' => $row->kode_program,
            'nama_program' => $row->nama_program,
            'kode_program_sasaran' => $row->kode_program_sasaran,
            'nama_program_sasaran' => $row->nama_program_sasaran,
            'indikator_program' => $row->indikator_program,
            'kode_kegiatan' => $row->kode_kegiatan,
            'nama_kegiatan' => $row->nama_kegiatan,
            'kode_kegiatan_sasaran' => $row->kode_kegiatan_sasaran,
            'nama_kegiatan_sasaran' => $row->nama_kegiatan_sasaran,
            'indikator_kegiatan' => $row->indikator_kegiatan,
            'kode_kro' => $row->kode_kro,
            'nama_kro' => $row->nama_kro,
            'indikator_kro' => $row->indikator_kro,
            'kode_ro' => $row->kode_ro,
            'nama_ro' => $row->nama_ro,
            'volume' => $row->volume,
            'id_satuan' => $row->id_satuan,
            'nama_satuan' => $row->nama_satuan,
            'id_users' => $row->id_users,
            'username' => $row->username,
            'create_date' => $row->create_date,
            'isi' => $row->isi,
            'ttd_tempat' => $row->ttd_tempat,
            'ttd_tanggal' => $row->ttd_tanggal,
            'ttd_jabatan' => $row->ttd_jabatan,
            'ttd_nama' => $row->ttd_nama,
            'ttd_nip' => $row->ttd_nip,
        );
        $this->load->view('export_rab', $data);
    }
}
