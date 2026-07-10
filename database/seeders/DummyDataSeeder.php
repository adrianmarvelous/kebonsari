<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use App\Models\User;

class DummyDataSeeder extends Seeder
{
    public function run(): void
    {
        // ===== 1. ROLES =====
        $roles = [
            ['id' => 1, 'name' => 'Super Admin', 'description' => 'Akses penuh ke semua fitur'],
            ['id' => 2, 'name' => 'Admin', 'description' => 'Mengelola konten dan pengunjung'],
        ];
        foreach ($roles as $role) {
            DB::table('roles')->updateOrInsert(['id' => $role['id']], $role);
        }

        // ===== 2. USERS =====
        $users = [
            [
                'name' => 'Super Admin',
                'email' => 'superadmin@kebonsari.com',
                'password' => Hash::make('password'),
                'role_id' => 1,
            ],
            [
                'name' => 'Admin Kebonsari',
                'email' => 'admin@kebonsari.com',
                'password' => Hash::make('password'),
                'role_id' => 2,
            ],
        ];
        foreach ($users as $user) {
            $existing = DB::table('users')->where('email', $user['email'])->first();
            if (!$existing) {
                $userId = DB::table('users')->insertGetId([
                    'name' => $user['name'],
                    'email' => $user['email'],
                    'password' => $user['password'],
                    'email_verified_at' => now(),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
                DB::table('users')->where('id', $userId)->update(['role_id' => $user['role_id']]);
            }
        }

        // ===== 3. LAYANAN (Services) =====
        $layananList = [
            ['kategori' => 'Kependudukan', 'sektor' => 'Pelayanan Umum', 'nama_layanan' => 'Pembuatan KTP'],
            ['kategori' => 'Kependudukan', 'sektor' => 'Pelayanan Umum', 'nama_layanan' => 'Pembuatan KK'],
            ['kategori' => 'Kependudukan', 'sektor' => 'Pelayanan Umum', 'nama_layanan' => 'Pembuatan Akta Kelahiran'],
            ['kategori' => 'Perizinan', 'sektor' => 'Pelayanan Usaha', 'nama_layanan' => 'Pembuatan SIUP'],
            ['kategori' => 'Perizinan', 'sektor' => 'Pelayanan Usaha', 'nama_layanan' => 'Pembuatan IMB'],
            ['kategori' => 'Kesehatan', 'sektor' => 'Kesehatan Masyarakat', 'nama_layanan' => 'BPJS Kesehatan'],
            ['kategori' => 'Kesehatan', 'sektor' => 'Kesehatan Masyarakat', 'nama_layanan' => 'Imunisasi Anak'],
            ['kategori' => 'Sosial', 'sektor' => 'Bantuan Sosial', 'nama_layanan' => 'BLT Dana Desa'],
            ['kategori' => 'Sosial', 'sektor' => 'Bantuan Sosial', 'nama_layanan' => 'PKH'],
            ['kategori' => 'Pajak', 'sektor' => 'Pajak Daerah', 'nama_layanan' => 'PBB'],
        ];

        foreach ($layananList as $i => $layanan) {
            DB::table('layanan')->updateOrInsert(
                ['id' => $i + 1],
                array_merge($layanan, ['created_at' => now(), 'updated_at' => now()])
            );
        }

        // ===== 4. VISITORS (Pengunjung) - 100 data tersebar 6 bulan =====
        $namaList = [
            'Ahmad Fauzi', 'Siti Nurhaliza', 'Budi Santoso', 'Dewi Lestari', 'Rudi Hermawan',
            'Ani Rahmawati', 'Bambang Susilo', 'Citra Dewi', 'Deni Gunawan', 'Eka Putri',
            'Farhan Maulana', 'Gita Puspita', 'Hendra Gunawan', 'Intan Permata', 'Joko Susilo',
            'Kartika Sari', 'Lukman Hakim', 'Mega Wati', 'Nanda Pratama', 'Oktavia Dewi',
            'Putra Wijaya', 'Ratna Sari', 'Sandy Nugraha', 'Tina Amelia', 'Umar Hidayat',
            'Vivi Anggraini', 'Wawan Setiawan', 'Yuli Astuti', 'Zainal Arifin', 'Aris Munandar',
            'Bunga Citra', 'Candra Wijaya', 'Dian Pelangi', 'Eko Saputra', 'Fitri Handayani',
            'Gilang Pratama', 'Hesti Wardani', 'Irfan Maulana', 'Jasmine Putri', 'Kevin Sanjaya',
        ];
        $alamatList = [
            'Jl. Merpati No. 1', 'Jl. Kenanga No. 5', 'Jl. Melati No. 10', 'Jl. Mawar No. 15',
            'Jl. Anggrek No. 20', 'Jl. Dahlia No. 25', 'Jl. Flamboyan No. 30', 'Jl. Bougenville No. 35',
            'Jl. Cempaka No. 40', 'Jl. Teratai No. 45', 'Jl. Kamboja No. 50', 'Jl. Sakura No. 55',
            'Jl. Tulip No. 60', 'Jl. Lavender No. 65', 'Jl. Lily No. 70', 'Perum Kebonsari Indah Blok A',
            'Perum Kebonsari Indah Blok B', 'Perum Kebonsari Asri No. 5', 'Griya Kebonsari Permai',
            'Jl. Raya Kebonsari No. 100',
        ];

        $visitorData = [];
        for ($i = 0; $i < 100; $i++) {
            $daysAgo = rand(0, 180);
            $visitorData[] = [
                'nama' => $namaList[array_rand($namaList)],
                'alamat' => $alamatList[array_rand($alamatList)],
                'id_layanan' => rand(1, count($layananList)),
                'klik_app' => rand(0, 1),
                'created_at' => Carbon::now()->subDays($daysAgo),
            ];
        }
        // Hapus data pengunjung lama (kalau ada) & insert baru
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('visitors')->truncate();
        DB::table('visitors')->insert($visitorData);

        // ===== 5. AGENDA (Events) - 12 agenda =====
        $agendaData = [
            ['nama_agenda' => 'Rapat Koordinasi Bulanan', 'narasi' => '<p>Rapat koordinasi bulanan antara kelurahan dan perangkat RW/RT se-Kelurahan Kebonsari. Membahas program kerja dan evaluasi pelayanan masyarakat.</p>'],
            ['nama_agenda' => 'Sosialisasi Vaksinasi', 'narasi' => '<p>Sosialisasi pentingnya vaksinasi bagi balita dan lansia. Bekerja sama dengan Puskesmas Sukolilo.</p>'],
            ['nama_agenda' => 'Kerja Bakti Lingkungan', 'narasi' => '<p>Kerja bakti membersihkan lingkungan kelurahan dalam rangka program "Kebonsari Bersih dan Hijau".</p>'],
            ['nama_agenda' => 'Pelatihan UMKM', 'narasi' => '<p>Pelatihan pengelolaan usaha mikro kecil menengah bagi warga Kebonsari. Materi meliputi manajemen keuangan dan pemasaran digital.</p>'],
            ['nama_agenda' => 'Posyandu Balita', 'narasi' => '<p>Kegiatan posyandu rutin untuk balita di Kelurahan Kebonsari. Pemeriksaan tumbuh kembang dan imunisasi.</p>'],
            ['nama_agenda' => 'Pengajian Akbar', 'narasi' => '<p>Pengajian akbar dalam rangka memperingati Maulid Nabi Muhammad SAW. Bertempat di halaman kantor kelurahan.</p>'],
            ['nama_agenda' => 'Senam Sehat Bersama', 'narasi' => '<p>Senam sehat bersama warga setiap hari Minggu pagi di lapangan kelurahan. Diikuti oleh puluhan warga dari berbagai RW.</p>'],
            ['nama_agenda' => 'Rapat Persiapan HUT RI', 'narasi' => '<p>Rapat persiapan peringatan Hari Ulang Tahun Republik Indonesia ke-79 tingkat Kelurahan Kebonsari.</p>'],
            ['nama_agenda' => 'Bazar Sembako Murah', 'narasi' => '<p>Bazar sembako murah yang diadakan setiap bulan untuk membantu warga kurang mampu mendapatkan kebutuhan pokok dengan harga terjangkau.</p>'],
            ['nama_agenda' => 'Lomba 17 Agustusan', 'narasi' => '<p>Lomba-lomba tradisional dalam rangka memeriahkan HUT RI. Terbuka untuk semua warga Kebonsari.</p>'],
            ['nama_agenda' => 'Sosialisasi KB', 'narasi' => '<p>Sosialisasi program Keluarga Berencana oleh BKKBN bekerja sama dengan Kelurahan Kebonsari.</p>'],
            ['nama_agenda' => 'Halal Bihalal', 'narasi' => '<p>Acara halal bihalal warga Kelurahan Kebonsari setelah Hari Raya Idul Fitri. Silaturahmi antara perangkat kelurahan dan warga.</p>'],
        ];
        DB::table('agenda_lampiran')->truncate();
        DB::table('agenda')->truncate();
        foreach ($agendaData as $i => $agenda) {
            DB::table('agenda')->insert([
                'nama_agenda' => $agenda['nama_agenda'],
                'foto_cover' => 'uploads/agenda/cover/default.jpg',
                'narasi' => $agenda['narasi'],
                'created_at' => Carbon::now()->subDays(rand(0, 180)),
                'updated_at' => now(),
            ]);
        }

        // ===== 6. MENUS =====
        $menus = [
            ['name' => 'User', 'url' => 'users.index', 'icon' => 'user', 'parent_id' => null, 'order' => 1],
            ['name' => 'Layanan', 'url' => 'layanan.index', 'icon' => 'handshake', 'parent_id' => null, 'order' => 2],
            ['name' => 'Info', 'url' => 'info.index', 'icon' => 'info-circle', 'parent_id' => null, 'order' => 3],
            ['name' => 'Pengunjung', 'url' => 'pengunjung.index', 'icon' => 'user-check', 'parent_id' => null, 'order' => 4],
            ['name' => 'Agenda', 'url' => 'agenda.index', 'icon' => 'calendar-alt', 'parent_id' => null, 'order' => 5],
        ];
        DB::table('menus')->truncate();
        foreach ($menus as $menu) {
            DB::table('menus')->insert($menu);
        }

        // ===== 7. ROLE TO MENU (Super Admin gets all, Admin gets all) =====
        DB::table('role_to_menu')->truncate();
        $menuIds = DB::table('menus')->pluck('id');
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        foreach ($menuIds as $menuId) {
            DB::table('role_to_menu')->insert(['role_id' => 1, 'menu_id' => $menuId]); // Super Admin
            DB::table('role_to_menu')->insert(['role_id' => 2, 'menu_id' => $menuId]); // Admin
        }

        $this->command->info('✅ Dummy data berhasil dibuat!');
        $this->command->info('   Super Admin: superadmin@kebonsari.com / password');
        $this->command->info('   Admin: admin@kebonsari.com / password');
    }
}
