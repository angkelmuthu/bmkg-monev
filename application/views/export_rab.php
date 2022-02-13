<table>
    <tr style="text-align: center;">
        <td colspan="6"><b>RINCIAN ANGGARAN BELANJA</b></td>
    </tr>
    <tr style="text-align: center;">
        <td colspan="6"><b>KELUARAN (OUTPUT) KEGIATAN TA. <?php echo $tahun ?></b></td>
    </tr>
    <tr>
        <td colspan="6"></td>
    </tr>
    <tr>
        <td colspan="2">Kementerian Lembaga</td>
        <td>:</td>
        <td colspan="3"><?php echo $nama_unit; ?></td>
    </tr>
    <tr>
        <td colspan="2">Unit Eselon I</td>
        <td>:</td>
        <td colspan="3"><?php echo $nama_unit_eselon_1; ?></td>
    </tr>

    <tr>
        <td colspan="2">Program</td>
        <td>:</td>
        <td colspan="3"><?php echo $nama_program; ?></td>
    </tr>
    <tr>
        <td colspan="2">Program Sasaran</td>
        <td>:</td>
        <td colspan="3"><?php echo $nama_program_sasaran; ?></td>
    </tr>
    <tr>
        <td colspan="2">Indikator Program</td>
        <td>:</td>
        <td>
            <ol>
                <?php
                $this->db->where_in("kode_indikator_kinerja", json_decode($indikator_program, true));
                $result = $this->db->get("m_indikator_kinerja")->result();
                foreach ($result as $row) {
                    echo '<li>' . $row->nama_indikator_kinerja . '</li>';
                }
                ?>
            </ol>
        </td>
    </tr>
    <tr>
        <td colspan="2">Unit Eselon II</td>
        <td>:</td>
        <td colspan="3"><?php echo $nama_unit_eselon_2; ?></td>
    </tr>
    <tr>
        <td colspan="2">Kegiatan</td>
        <td>:</td>
        <td colspan="3"><?php echo $nama_kegiatan; ?></td>
    </tr>
    <tr>
        <td colspan="2">Kegiatan Sasaran</td>
        <td>:</td>
        <td colspan="3"><?php echo $nama_kegiatan_sasaran; ?></td>
    </tr>
    <tr>
        <td colspan="2">Indikator Kegiatan</td>
        <td>:</td>
        <td>
            <ol>
                <?php
                $this->db->where_in("kode_indikator_kinerja", json_decode($indikator_kegiatan, true));
                $result = $this->db->get("m_indikator_kinerja")->result();
                foreach ($result as $row) {
                    echo '<li>' . $row->nama_indikator_kinerja . '</li>';
                }
                ?>
            </ol>
        </td>
    </tr>
    <tr>
        <td colspan="2">Kro</td>
        <td>:</td>
        <td colspan="3"><?php echo $nama_kro; ?></td>
    </tr>
    <tr>
        <td colspan="2">Indikator Kro</td>
        <td>:</td>
        <td>
            <?php
            $this->db->where("kode_indikator_kinerja", $indikator_kro);
            $result = $this->db->get("m_indikator_kinerja")->result();
            foreach ($result as $row) {
                echo $row->nama_indikator_kinerja;
            }
            ?>
        </td>
    </tr>
    <tr>
        <td colspan="2">Ro</td>
        <td>:</td>
        <td colspan="3"><?php echo $nama_ro; ?></td>
    </tr>
    <tr>
        <td colspan="2">Volume</td>
        <td>:</td>
        <td colspan="3"><?php echo $volume; ?></td>
    </tr>
    <tr>
        <td colspan="2">Satuan</td>
        <td>:</td>
        <td colspan="3"><?php echo $nama_satuan; ?></td>
    </tr>
    <tr>
        <td colspan="6"></td>
    </tr>
</table>
<?php
$this->db->select('sum(total) as total');
$this->db->where('id_tor_head', $id_tor_head);
$query = $this->db->get('t_rab_item');
$result = $query->row();
?>

<table border="1">
    <tr>
        <th style="text-align: center;" rowspan="2">Kode</th>
        <th style="text-align: center;" rowspan="2">Program/Kegiatan/Output/Komponen/Sub Komponen/Akun/Detil</th>
        <th style="text-align: center;" colspan="2">Rincian Perhitungan</th>
        <th style="text-align: center;" rowspan="2">Harga satuan</th>
        <th style="text-align: center;" rowspan="2">PAGU</th>
    </tr>
    <tr>
        <th style="text-align: center;">Vol</th>
        <th style="text-align: center;">Sat</th>
    </tr>
    <tr>
        <td style="text-align: center;">1</td>
        <td style="text-align: center;">2</td>
        <td style="text-align: center;">3</td>
        <td style="text-align: center;">4</td>
        <td style="text-align: center;">5</td>
        <td style="text-align: center;">6</td>
    </tr>
    <tr>
        <td style="text-align: right;"><?php echo $kode_program ?></td>
        <td><?php echo $nama_program ?></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
    </tr>
    <tr>
        <td style="text-align: right;"><?php echo $kode_program . '.' . $kode_kegiatan ?></td>
        <td><?php echo $nama_kegiatan ?></td>
        <td></td>
        <td></td>
        <td></td>
        <td style="text-align: right;"><strong><?php echo angka($result->total) ?></strong></td>
    </tr>
    <tr>
        <td style="text-align: right;"><?php echo $kode_program . '.' . $kode_kegiatan . '.' . $kode_kro ?></td>
        <td><?php echo $nama_kro ?></td>
        <td></td>
        <td></td>
        <td></td>
        <td style="text-align: right;"><strong><?php echo angka($result->total) ?></strong></td>
    </tr>
    <tr>
        <td style="text-align: right;"><?php echo $kode_program . '.' . $kode_kegiatan . '.' . $kode_kro . '.' . $kode_ro ?></td>
        <td><?php echo $nama_ro ?></td>
        <td></td>
        <td></td>
        <td></td>
        <td style="text-align: right;"><strong><?php echo angka($result->total) ?></strong></td>
    </tr>
    <?php
    $this->db->select('a.id_rab,a.id_tor_head,a.kode_komponen,b.nama_komponen,sum(c.total) as total');
    $this->db->from('t_rab a');
    $this->db->join('m_komponen b', 'a.kode_komponen = b.kode_komponen');
    $this->db->join('t_rab_item c', 'a.id_rab=c.id_rab', 'LEFT');
    $this->db->where('a.id_tor_head', $this->uri->segment(3));
    $this->db->group_by('a.id_rab');
    $query = $this->db->get();
    $result = $query->result();
    $num = $query->num_rows();
    if ($num > 0) {
        foreach ($result as $rkomponen) {
    ?>
            <tr>
                <td style="text-align: right;"><?php echo $rkomponen->kode_komponen ?></td>
                <td><i class="fal fa-angle-right mr-1"></i><?php echo $rkomponen->nama_komponen ?></td>
                <td></td>
                <td></td>
                <td></td>
                <td style="text-align: right;"><strong><?php echo angka($rkomponen->total) ?></strong></td>
            </tr>
            <?php
            $this->db->select('a.id_rab_sub,a.id_rab,a.kode_komponen,a.kode_komponen_sub,a.nama_komponen_sub,sum(c.total) as total');
            $this->db->from('t_rab_sub a');
            //$this->db->join('m_komponen_sub b', 'a.kode_komponen_sub = b.kode_komponen_sub', 'LEFT');
            $this->db->join('t_rab_item c', 'a.id_rab_sub=c.id_rab_sub', 'LEFT');
            $this->db->where('a.id_rab', $rkomponen->id_rab);
            $this->db->group_by('a.id_rab_sub');
            $query = $this->db->get();
            $result = $query->result();
            $num = $query->num_rows();
            if ($num > 0) {
                foreach ($result as $rkomponensub) {
            ?>
                    <tr>
                        <td style="text-align: right;"><?php echo $rkomponensub->kode_komponen_sub ?></td>
                        <td><i class="fal fa-angle-right ml-1 mr-1"></i><?php echo $rkomponensub->nama_komponen_sub ?></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td style="text-align: right;"><strong><?php echo angka($rkomponensub->total) ?></strong></td>
                    </tr>
                    <?php
                    $this->db->select('a.id_rab_akun,a.id_rab_sub,b.kode_akun,b.nama_akun,sum(c.total) as total');
                    $this->db->from('t_rab_akun a');
                    $this->db->join('m_akun b', 'a.kode_akun = b.kode_akun', 'LEFT');
                    $this->db->join('t_rab_item c', 'a.id_rab_akun=c.id_rab_akun', 'LEFT');
                    $this->db->where('a.id_rab_sub', $rkomponensub->id_rab_sub);
                    $this->db->group_by('a.id_rab_akun');
                    $query = $this->db->get();
                    $result = $query->result();
                    $num = $query->num_rows();
                    if ($num > 0) {
                        foreach ($result as $rakun) {
                    ?>
                            <tr>
                                <td style="text-align: right;"><strong><?php echo $rakun->kode_akun ?></strong></td>
                                <td><i class="fal fa-angle-right ml-2 mr-1"></i><strong><?php echo $rakun->nama_akun ?></strong></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td style="text-align: right;"><strong><?php echo angka($rakun->total) ?></strong></td>
                            </tr>
                            <?php
                            $this->db->select('*,sum(total) as total');
                            $this->db->where('id_rab_akun', $rakun->id_rab_akun);
                            $this->db->group_by('title_item');
                            $query = $this->db->get('t_rab_item');
                            $result = $query->result();
                            $num = $query->num_rows();
                            if ($num > 0) {
                                foreach ($result as $r_item_title) {
                            ?>
                                    <?php if (!empty($r_item_title->title_item)) { ?>
                                        <tr>
                                            <td style="text-align: right;"></td>
                                            <td><?php echo $r_item_title->title_item ?></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td style="text-align: right;"><?php echo angka($r_item_title->total) ?></td>
                                        </tr>
                                    <?php } ?>
                                    <?php
                                    $this->db->select('a.*,b.nama_satuan');
                                    $this->db->from('t_rab_item a');
                                    $this->db->join('m_satuan b', 'a.id_satuan = b.id_satuan', 'LEFT');
                                    $this->db->where('a.id_rab_akun', $r_item_title->id_rab_akun);
                                    $this->db->where('a.title_item', $r_item_title->title_item);
                                    $query = $this->db->get('');
                                    $result = $query->result();
                                    $num = $query->num_rows();
                                    if ($num > 0) {
                                        foreach ($result as $r_item) {
                                    ?>
                                            <tr>

                                                <td style="text-align: right;"></td>
                                                <?php if (!empty($r_item->title_item)) { ?>
                                                    <td>- <?php echo $r_item->item ?></td>
                                                <?php } else { ?>
                                                    <td>- <?php echo $r_item->item ?></td>
                                                <?php } ?>
                                                <td style="text-align: center;"><?php echo $r_item->volume ?></td>
                                                <td style="text-align: center;"><?php echo $r_item->nama_satuan ?></td>
                                                <td style="text-align: right;"><?php echo angka($r_item->harga_satuan) ?></td>
                                                <td style="text-align: right;"><?php echo angka($r_item->total) ?></td>
                                            </tr>
    <?php
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
    } ?>
</table>
<table>
    <tr>
        <td colspan="6"></td>
    </tr>
    <tr>
        <td colspan="4"></td>
        <td colspan="2"><?php echo $ttd_tempat . ', ' . tgl_indo($ttd_tanggal); ?></td>
    </tr>
    <tr>
        <td colspan="4"></td>
        <td colspan="2"><b><?php echo $ttd_jabatan ?></b></td>
    </tr>
    <tr>
        <td colspan="4"></td>
        <td colspan="2"></td>
    </tr>
    <tr>
        <td colspan="4"></td>
        <td colspan="2"></td>
    </tr>
    <tr>
        <td colspan="4"></td>
        <td colspan="2"></td>
    </tr>
    <tr>
        <td colspan="4"></td>
        <td colspan="2"></td>
    </tr>
    <tr>
        <td colspan="4"></td>
        <td colspan="2"><b><?php echo $ttd_nama ?></b></td>
    </tr>
    <tr>
        <td colspan="4"></td>
        <td colspan="2">NIP. <?php echo $ttd_nip ?></td>
    </tr>
</table>