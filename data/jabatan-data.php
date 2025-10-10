<?php
/**
 * Data Struktur Organisasi - Peta Jabatan
 * Berdasarkan dokumen rekapitulasi jabatan unit kerja
 */

class DataJabatan {
    
    public static function getFullOrganizationData() {
        return [
            // Root - Unit Kerja Utama
            [
                'id' => 1,
                'name' => 'Rekapitulasi Jabatan Unit Kerja',
                'B' => '44',
                'K' => '83',
                'selisih' => '-39',
                'template' => 'unit_kerja',
                'level' => 1,
                'description' => 'Unit kerja utama dengan total formasi 44 dan kondisi 83 pegawai'
            ],

            // Level 2 - Jabatan Administrator
            [
                'id' => 2,
                'pid' => 1,
                'name' => 'Kepala Balai Kepengawasan dan Pengembangan Sanitasi Daya Manusia',
                'B' => '14',
                'K' => '1',
                'selisih' => '0',
                'template' => 'administrator',
                'level' => 2,
                'description' => 'Kepala balai yang bertanggung jawab atas pengawasan dan pengembangan sanitasi daya manusia'
            ],
            [
                'id' => 3,
                'pid' => 1,
                'name' => 'Kepala Bidang Pengadaan, Pemberhentian dan Kinerja',
                'B' => '1',
                'K' => '1',
                'selisih' => '0',
                'template' => 'administrator',
                'level' => 2,
                'description' => 'Mengelola pengadaan, pemberhentian, dan evaluasi kinerja pegawai'
            ],
            [
                'id' => 4,
                'pid' => 1,
                'name' => 'Kepala Bidang Mutasi, Promosi dan Informasi',
                'B' => '1',
                'K' => '1',
                'selisih' => '0',
                'template' => 'administrator',
                'level' => 2,
                'description' => 'Bertanggung jawab atas mutasi, promosi, dan sistem informasi kepegawaian'
            ],
            [
                'id' => 5,
                'pid' => 1,
                'name' => 'Kepala Bidang Pengembangan Kompetensi dan Disiplin Aparatur',
                'B' => '1',
                'K' => '1',
                'selisih' => '0',
                'template' => 'administrator',
                'level' => 2,
                'description' => 'Mengurus pengembangan kompetensi dan penegakan disiplin aparatur'
            ],

            // Level 3 - Sekretaris dan Jabatan Fungsional di bawah Kepala Balai
            [
                'id' => 6,
                'pid' => 2,
                'name' => 'Sekretaris Balai Kepengawasan dan Pengembangan Sanitasi Daya Manusia',
                'B' => '1',
                'K' => '1',
                'selisih' => '0',
                'template' => 'fungsional',
                'level' => 3,
                'description' => 'Sekretaris yang mengelola administrasi dan koordinasi kegiatan balai'
            ],

            // Level 4 - Subbagian di bawah Sekretaris
            [
                'id' => 7,
                'pid' => 6,
                'name' => 'Kepala Subbagian Umum, Kepegawaian dan Aset',
                'B' => '1',
                'K' => '1',
                'selisih' => '0',
                'template' => 'pelaksana',
                'level' => 4,
                'description' => 'Mengelola urusan umum, kepegawaian, dan pengelolaan aset'
            ],

            // Jabatan Pelaksana di bawah Sekretaris
            [
                'id' => 8,
                'pid' => 6,
                'name' => 'Pengadaan Kepegawaian',
                'B' => '1',
                'K' => '1',
                'selisih' => '0',
                'template' => 'pelaksana',
                'level' => 4,
                'description' => 'Menangani proses pengadaan dan rekrutmen kepegawaian'
            ],
            [
                'id' => 9,
                'pid' => 6,
                'name' => 'Pengolah Barang Milik Negara',
                'B' => '1',
                'K' => '1',
                'selisih' => '0',
                'template' => 'pelaksana',
                'level' => 4,
                'description' => 'Mengelola inventarisasi dan pemeliharaan barang milik negara'
            ],
            [
                'id' => 10,
                'pid' => 6,
                'name' => 'Pengadministrasi Keuangan',
                'B' => '1',
                'K' => '0',
                'selisih' => '1',
                'template' => 'pelaksana',
                'level' => 4,
                'description' => 'Mengelola administrasi keuangan dan pelaporan'
            ],
            [
                'id' => 11,
                'pid' => 6,
                'name' => 'Pengadministrasi Umum',
                'B' => '1',
                'K' => '1',
                'selisih' => '0',
                'template' => 'pelaksana',
                'level' => 4,
                'description' => 'Menangani administrasi umum dan surat menyurat'
            ],
            [
                'id' => 12,
                'pid' => 6,
                'name' => 'Pengolah Teknologi Informasi',
                'B' => '1',
                'K' => '0',
                'selisih' => '1',
                'template' => 'pelaksana',
                'level' => 4,
                'description' => 'Mengelola sistem teknologi informasi dan komunikasi'
            ],
            [
                'id' => 13,
                'pid' => 6,
                'name' => 'Pranikata Sirad',
                'B' => '1',
                'K' => '0',
                'selisih' => '1',
                'template' => 'pelaksana',
                'level' => 4,
                'description' => 'Pranikata Sistem Informasi Rencana dan Data'
            ],

            // Jabatan Fungsional di bawah Bidang Pengadaan
            [
                'id' => 14,
                'pid' => 3,
                'name' => 'Analis Sumber Daya Manusia Aparatur Ahli Muda',
                'B' => '1',
                'K' => '1',
                'selisih' => '0',
                'template' => 'fungsional',
                'level' => 3,
                'description' => 'Menganalisis dan mengevaluasi sumber daya manusia aparatur',
                'kelas' => '10'
            ],
            [
                'id' => 15,
                'pid' => 3,
                'name' => 'Analis Kebijaksanaan Ahli Pertama',
                'B' => '1',
                'K' => '2',
                'selisih' => '-1',
                'template' => 'fungsional',
                'level' => 3,
                'description' => 'Menganalisis kebijakan dan regulasi kepegawaian'
            ],

            // Jabatan Pelaksana di bawah Bidang Pengadaan
            [
                'id' => 16,
                'pid' => 3,
                'name' => 'Pengolah Data Perilaku',
                'B' => '1',
                'K' => '1',
                'selisih' => '0',
                'template' => 'pelaksana',
                'level' => 4,
                'description' => 'Mengolah dan menganalisis data perilaku pegawai'
            ],
            [
                'id' => 17,
                'pid' => 3,
                'name' => 'Pengolah Mutasi dan Instansi Formasi Regional',
                'B' => '1',
                'K' => '1',
                'selisih' => '0',
                'template' => 'pelaksana',
                'level' => 4,
                'description' => 'Mengelola data mutasi dan formasi pegawai regional'
            ],
            [
                'id' => 18,
                'pid' => 3,
                'name' => 'Pengolah Pretest Sumber Daya Manusia',
                'B' => '1',
                'K' => '0',
                'selisih' => '1',
                'template' => 'pelaksana',
                'level' => 4,
                'description' => 'Mengelola pelaksanaan pretest untuk SDM'
            ],
            [
                'id' => 19,
                'pid' => 3,
                'name' => 'Pengolah Data Administrasi dan Verifikasi',
                'B' => '1',
                'K' => '1',
                'selisih' => '0',
                'template' => 'pelaksana',
                'level' => 4,
                'description' => 'Mengolah data administrasi dan verifikasi'
            ],
            [
                'id' => 20,
                'pid' => 3,
                'name' => 'Pengolah Data dan Perencanaan Program',
                'B' => '1',
                'K' => '1',
                'selisih' => '0',
                'template' => 'pelaksana',
                'level' => 4,
                'description' => 'Mengolah data dan perencanaan program'
            ],
            [
                'id' => 21,
                'pid' => 3,
                'name' => 'Analis Jabatan',
                'B' => '1',
                'K' => '1',
                'selisih' => '0',
                'template' => 'pelaksana',
                'level' => 4,
                'description' => 'Menganalisis struktur dan analisis jabatan'
            ],
            [
                'id' => 22,
                'pid' => 3,
                'name' => 'Analis Perencanaan dan Kinerja Daya Manusia Aparatur',
                'B' => '1',
                'K' => '1',
                'selisih' => '0',
                'template' => 'pelaksana',
                'level' => 4,
                'description' => 'Menganalisis perencanaan dan kinerja SDM aparatur'
            ],
            [
                'id' => 23,
                'pid' => 3,
                'name' => 'Pengadministrasi Umum',
                'B' => '1',
                'K' => '1',
                'selisih' => '0',
                'template' => 'pelaksana',
                'level' => 4,
                'description' => 'Mengelola administrasi umum'
            ],
            [
                'id' => 24,
                'pid' => 3,
                'name' => 'Analis Kinerja Organisasi',
                'B' => '1',
                'K' => '0',
                'selisih' => '1',
                'template' => 'pelaksana',
                'level' => 4,
                'description' => 'Menganalisis kinerja organisasi'
            ],

            // Jabatan Fungsional di bawah Bidang Mutasi
            [
                'id' => 25,
                'pid' => 4,
                'name' => 'Analis Sumber Daya Manusia Aparatur Ahli Muda',
                'B' => '1',
                'K' => '1',
                'selisih' => '0',
                'template' => 'fungsional',
                'level' => 3,
                'description' => 'Menganalisis SDM untuk keperluan mutasi dan promosi',
                'kelas' => '10'
            ],
            [
                'id' => 26,
                'pid' => 4,
                'name' => 'Pengawas Penelitian Lanjutan',
                'B' => '1',
                'K' => '0',
                'selisih' => '1',
                'template' => 'fungsional',
                'level' => 3,
                'description' => 'Mengawasi pelaksanaan penelitian lanjutan'
            ],

            // Jabatan Pelaksana di bawah Bidang Mutasi  
            [
                'id' => 27,
                'pid' => 4,
                'name' => 'Perancang Rencana Mutasi',
                'B' => '1',
                'K' => '1',
                'selisih' => '0',
                'template' => 'pelaksana',
                'level' => 4,
                'description' => 'Merencanakan dan merancang program mutasi pegawai'
            ],
            [
                'id' => 28,
                'pid' => 4,
                'name' => 'Pengolah Pengembangan Karir',
                'B' => '1',
                'K' => '1',
                'selisih' => '0',
                'template' => 'pelaksana',
                'level' => 4,
                'description' => 'Mengelola jalur pengembangan karir pegawai'
            ],
            [
                'id' => 29,
                'pid' => 4,
                'name' => 'Pengolah Data Administrasi dan Verifikasi',
                'B' => '1',
                'K' => '1',
                'selisih' => '0',
                'template' => 'pelaksana',
                'level' => 4,
                'description' => 'Mengolah data administrasi dan verifikasi'
            ],
            [
                'id' => 30,
                'pid' => 4,
                'name' => 'Pengolah Data',
                'B' => '1',
                'K' => '1',
                'selisih' => '0',
                'template' => 'pelaksana',
                'level' => 4,
                'description' => 'Mengolah data kepegawaian'
            ],
            [
                'id' => 31,
                'pid' => 4,
                'name' => 'Pengolah Data Promosi',
                'B' => '1',
                'K' => '1',
                'selisih' => '0',
                'template' => 'pelaksana',
                'level' => 4,
                'description' => 'Mengolah data promosi pegawai'
            ],
            [
                'id' => 32,
                'pid' => 4,
                'name' => 'Penerima Ketersipan',
                'B' => '1',
                'K' => '1',
                'selisih' => '0',
                'template' => 'pelaksana',
                'level' => 4,
                'description' => 'Mengelola penerimaan ketersipan'
            ],
            [
                'id' => 33,
                'pid' => 4,
                'name' => 'Pengolah Sistem dan Prosedur Kepegawaian',
                'B' => '1',
                'K' => '1',
                'selisih' => '0',
                'template' => 'pelaksana',
                'level' => 4,
                'description' => 'Mengelola sistem dan prosedur kepegawaian'
            ],
            [
                'id' => 34,
                'pid' => 4,
                'name' => 'Pengolah Sistem Informasi Manajemen Kepegawaian',
                'B' => '1',
                'K' => '2',
                'selisih' => '-1',
                'template' => 'pelaksana',
                'level' => 4,
                'description' => 'Mengelola sistem informasi manajemen kepegawaian'
            ],
            [
                'id' => 35,
                'pid' => 4,
                'name' => 'Pengadministrasi Kepegawaian',
                'B' => '1',
                'K' => '1',
                'selisih' => '0',
                'template' => 'pelaksana',
                'level' => 4,
                'description' => 'Mengelola administrasi kepegawaian'
            ],

            // Jabatan Fungsional di bawah Bidang Pengembangan Kompetensi
            [
                'id' => 36,
                'pid' => 5,
                'name' => 'Analis Sumber Daya Manusia Aparatur Ahli Muda',
                'B' => '1',
                'K' => '1',
                'selisih' => '0',
                'template' => 'fungsional',
                'level' => 3,
                'description' => 'Menganalisis kebutuhan pengembangan kompetensi',
                'kelas' => '10'
            ],
            [
                'id' => 37,
                'pid' => 5,
                'name' => 'Asisten Sumber Daya Manusia Aparatur Ahli Muda',
                'B' => '1',
                'K' => '2',
                'selisih' => '-1',
                'template' => 'fungsional',
                'level' => 3,
                'description' => 'Membantu pelaksanaan pengembangan SDM aparatur'
            ],
            [
                'id' => 38,
                'pid' => 5,
                'name' => 'Penyusun Ahli Muda',
                'B' => '1',
                'K' => '1',
                'selisih' => '0',
                'template' => 'fungsional',
                'level' => 3,
                'description' => 'Menyusun kebijakan dan program pengembangan'
            ],

            // Jabatan Pelaksana di bawah Bidang Pengembangan Kompetensi
            [
                'id' => 39,
                'pid' => 5,
                'name' => 'Pengolah Disiplin Pegawai',
                'B' => '1',
                'K' => '0',
                'selisih' => '1',
                'template' => 'pelaksana',
                'level' => 4,
                'description' => 'Mengelola urusan disiplin dan pelanggaran pegawai'
            ],
            [
                'id' => 40,
                'pid' => 5,
                'name' => 'Fasilitator Kepemimpinan Sumber Daya Manusia Aparatur',
                'B' => '1',
                'K' => '0',
                'selisih' => '1',
                'template' => 'pelaksana',
                'level' => 4,
                'description' => 'Memfasilitasi pengembangan kepemimpinan aparatur'
            ],
            [
                'id' => 41,
                'pid' => 5,
                'name' => 'Analis Pengembangan Kapasitas dan Budaya Sumber Daya',
                'B' => '1',
                'K' => '1',
                'selisih' => '0',
                'template' => 'pelaksana',
                'level' => 4,
                'description' => 'Menganalisis pengembangan kapasitas dan budaya SDM'
            ],
            [
                'id' => 42,
                'pid' => 5,
                'name' => 'Pengadministrasi Program',
                'B' => '1',
                'K' => '1',
                'selisih' => '0',
                'template' => 'pelaksana',
                'level' => 4,
                'description' => 'Mengelola administrasi program'
            ],
            [
                'id' => 43,
                'pid' => 5,
                'name' => 'Pengadministrasi Tugas Belajar dan Ijin Belajar',
                'B' => '1',
                'K' => '2',
                'selisih' => '-1',
                'template' => 'pelaksana',
                'level' => 4,
                'description' => 'Mengelola administrasi tugas belajar dan ijin belajar'
            ],
            [
                'id' => 44,
                'pid' => 5,
                'name' => 'Analis Pengembangan Kompetensi',
                'B' => '1',
                'K' => '2',
                'selisih' => '-1',
                'template' => 'pelaksana',
                'level' => 4,
                'description' => 'Menganalisis kebutuhan pengembangan kompetensi'
            ],
            [
                'id' => 45,
                'pid' => 5,
                'name' => 'Analis Disiplin',
                'B' => '1',
                'K' => '1',
                'selisih' => '0',
                'template' => 'pelaksana',
                'level' => 4,
                'description' => 'Menganalisis masalah kedisiplinan'
            ],
            [
                'id' => 46,
                'pid' => 5,
                'name' => 'Pengolah Penyuluhan-penyuluhan Disiplin',
                'B' => '1',
                'K' => '0',
                'selisih' => '1',
                'template' => 'pelaksana',
                'level' => 4,
                'description' => 'Mengelola program penyuluhan disiplin'
            ],
            [
                'id' => 47,
                'pid' => 5,
                'name' => 'Perancang Program Penyelenggaraan Diklat',
                'B' => '1',
                'K' => '0',
                'selisih' => '1',
                'template' => 'pelaksana',
                'level' => 4,
                'description' => 'Merancang program pendidikan dan pelatihan'
            ],

            // Jabatan Fungsional (Additional based on summary)
            [
                'id' => 48,
                'pid' => 1,
                'name' => 'Perencana Ahli Muda',
                'B' => '1',
                'K' => '1',
                'selisih' => '0',
                'template' => 'fungsional',
                'level' => 3,
                'description' => 'Perencana ahli muda untuk perencanaan strategis',
                'kelas' => '10'
            ],

            // Jabatan Pelaksana Additional
            [
                'id' => 49,
                'pid' => 1,
                'name' => 'Analis Perencanaan, Evaluasi dan Pelaporan',
                'B' => '1',
                'K' => '1',
                'selisih' => '0',
                'template' => 'pelaksana',
                'level' => 4,
                'description' => 'Menganalisis perencanaan, evaluasi dan pelaporan'
            ],
            [
                'id' => 50,
                'pid' => 1,
                'name' => 'Pengolah Keuangan',
                'B' => '1',
                'K' => '2',
                'selisih' => '-1',
                'template' => 'pelaksana',
                'level' => 4,
                'description' => 'Mengolah administrasi keuangan'
            ],
            [
                'id' => 51,
                'pid' => 1,
                'name' => 'Pengadministrasi Keuangan',
                'B' => '1',
                'K' => '1',
                'selisih' => '0',
                'template' => 'pelaksana',
                'level' => 4,
                'description' => 'Mengelola administrasi keuangan'
            ],
            [
                'id' => 52,
                'pid' => 1,
                'name' => 'Verifikatur Keuangan',
                'B' => '1',
                'K' => '1',
                'selisih' => '0',
                'template' => 'pelaksana',
                'level' => 4,
                'description' => 'Melakukan verifikasi keuangan'
            ],
            [
                'id' => 53,
                'pid' => 1,
                'name' => 'Bendahara',
                'B' => '1',
                'K' => '1',
                'selisih' => '0',
                'template' => 'pelaksana',
                'level' => 4,
                'description' => 'Mengelola kas dan bendahara'
            ]
        ];
    }

    public static function getSummaryStatistics() {
        return [
            'total_formasi' => 44,
            'total_kondisi' => 83,
            'total_selisih' => -39,
            'jabatan_pimpinan_tinggi' => ['B' => 1, 'K' => 1, 'selisih' => 0],
            'jabatan_administrasi' => ['B' => 5, 'K' => 5, 'selisih' => 0],
            'jabatan_fungsional' => ['B' => 12, 'K' => 14, 'selisih' => -2],
            'jabatan_pelaksana' => ['B' => 26, 'K' => 63, 'selisih' => -37]
        ];
    }

    public static function getNodesByLevel($level) {
        $allData = self::getFullOrganizationData();
        return array_filter($allData, function($node) use ($level) {
            return isset($node['level']) && $node['level'] == $level;
        });
    }

    public static function getNodesByTemplate($template) {
        $allData = self::getFullOrganizationData();
        return array_filter($allData, function($node) use ($template) {
            return isset($node['template']) && $node['template'] == $template;
        });
    }

    public static function searchNodes($query) {
        $allData = self::getFullOrganizationData();
        return array_filter($allData, function($node) use ($query) {
            return stripos($node['name'], $query) !== false || 
                   stripos($node['description'], $query) !== false;
        });
    }

    public static function getNodeById($id) {
        $allData = self::getFullOrganizationData();
        foreach ($allData as $node) {
            if ($node['id'] == $id) {
                return $node;
            }
        }
        return null;
    }

    public static function getChildrenNodes($parentId) {
        $allData = self::getFullOrganizationData();
        return array_filter($allData, function($node) use ($parentId) {
            return isset($node['pid']) && $node['pid'] == $parentId;
        });
    }

    public static function exportToJson() {
        return json_encode(self::getFullOrganizationData(), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }

    public static function exportToCsv() {
        $data = self::getFullOrganizationData();
        $csv = "ID,Parent ID,Nama,Formasi (B),Kondisi (K),Selisih,Template,Level,Deskripsi\n";
        
        foreach ($data as $node) {
            $csv .= sprintf(
                "%d,%s,\"%s\",%s,%s,%s,%s,%d,\"%s\"\n",
                $node['id'],
                isset($node['pid']) ? $node['pid'] : '',
                $node['name'],
                $node['B'],
                $node['K'],
                $node['selisih'],
                $node['template'],
                $node['level'],
                isset($node['description']) ? $node['description'] : ''
            );
        }
        
        return $csv;
    }
}
?>