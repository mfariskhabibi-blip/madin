<?php

namespace App\Controllers;

use App\Models\UserModel;

class Admin extends BaseController
{
    protected $userModel;
    protected $santriModel;
    protected $kelasModel;
    protected $ustadzModel;
    protected $hafalanModel;
    protected $pembayaranModel;
    protected $pengumumanModel;
    protected $jadwalModel;
    protected $kelasUstadzModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->santriModel = new \App\Models\SantriModel();
        $this->kelasModel = new \App\Models\KelasModel();
        $this->ustadzModel = new \App\Models\UstadzModel();
        $this->kelasUstadzModel = new \App\Models\KelasUstadzModel();
        $this->hafalanModel = new \App\Models\HafalanModel();
        $this->pembayaranModel = new \App\Models\PembayaranModel();
        $this->pengumumanModel = new \App\Models\PengumumanModel();
        $this->jadwalModel     = new \App\Models\JadwalModel();
        $this->orangTuaModel   = new \App\Models\OrangTuaModel();
    }

    // =========================================================
    // DASHBOARD
    // =========================================================
    public function dashboard()
    {
        $data = [
            'judul'                  => 'Dashboard Admin',
            'nama_admin'             => session()->get('nama_lengkap') ?? 'Admin PTQ',
            'total_santri'           => 0,
            'total_pengajar'         => 0,
            'total_kelas'            => 0,
            'pembayaran_belum_lunas' => 0,
            'santri_terbaru'         => [],
            'persentase_kehadiran'   => 0,
            'pembayaran_terakhir'    => []
        ];
        return view('admin/dashboard', $data);
    }

    // =========================================================
    // USER MANAGEMENT - LIST
    // =========================================================
    public function users()
    {
        $roleFilter = $this->request->getGet('role');

        $builder = $this->userModel;
        if ($roleFilter && in_array($roleFilter, ['admin', 'ustadz', 'ortu'])) {
            $builder = $builder->where('role', $roleFilter);
        }

        $users = $builder->orderBy('created_at', 'DESC')->findAll();

        // Hitung statistik per role — gunakan instance baru agar query tidak saling tertumpuk
        $totalAdmin  = (new UserModel())->where('role', 'admin')->countAllResults();
        $totalUstadz = (new UserModel())->where('role', 'ustadz')->countAllResults();
        $totalOrtu   = (new UserModel())->where('role', 'ortu')->countAllResults();

        $data = [
            'judul'        => 'Kelola Pengguna',
            'nama_admin'   => session()->get('nama_lengkap') ?? 'Admin PTQ',
            'users'        => $users,
            'roleFilter'   => $roleFilter,
            'totalAdmin'   => $totalAdmin,
            'totalUstadz'  => $totalUstadz,
            'totalOrtu'    => $totalOrtu,
        ];

        return view('admin/users', $data);
    }

    // =========================================================
    // USER MANAGEMENT - CREATE (tampilkan form)
    // =========================================================
    public function createUser()
    {
        $data = [
            'judul'      => 'Tambah Akun Baru',
            'nama_admin' => session()->get('nama_lengkap') ?? 'Admin PTQ',
        ];
        return view('admin/user_create', $data);
    }

    // =========================================================
    // USER MANAGEMENT - STORE (simpan user baru)
    // =========================================================
    public function storeUser()
    {
        $rules = [
            'username'     => 'required|min_length[3]|max_length[100]|is_unique[users.username]',
            'password'     => 'required|min_length[5]',
            'nama_lengkap' => 'required|max_length[100]',
            'email'        => 'permit_empty|valid_email|max_length[100]',
            'role'         => 'required|in_list[admin,ustadz,ortu]',
        ];

        $messages = [
            'username' => [
                'required'    => 'Username wajib diisi.',
                'min_length'  => 'Username minimal 3 karakter.',
                'is_unique'   => 'Username sudah digunakan.',
            ],
            'password' => [
                'required'    => 'Password wajib diisi.',
                'min_length'  => 'Password minimal 5 karakter.',
            ],
            'nama_lengkap' => [
                'required'    => 'Nama lengkap wajib diisi.',
            ],
            'email' => [
                'valid_email' => 'Format email tidak valid.',
            ],
            'role' => [
                'required'    => 'Role wajib dipilih.',
                'in_list'     => 'Role tidak valid.',
            ],
        ];

        if (!$this->validate($rules, $messages)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->userModel->save([
            'username'     => $this->request->getPost('username'),
            'password'     => $this->request->getPost('password'),
            'nama_lengkap' => $this->request->getPost('nama_lengkap'),
            'email'        => $this->request->getPost('email'),
            'role'         => $this->request->getPost('role'),
            'status'       => 'aktif',
        ]);

        $newUserId = $this->userModel->getInsertID();
        $role = $this->request->getPost('role');

        // Jika role ortu, simpan juga profil orang tua & data santri
        if ($role === 'ortu') {
            // Simpan profil orang tua
            $this->orangTuaModel->save([
                'id_user'          => $newUserId,
                'nama_ayah'        => $this->request->getPost('nama_ayah'),
                'nama_ibu'         => $this->request->getPost('nama_ibu'),
                'no_telepon_ayah'  => $this->request->getPost('no_telepon_ayah'),
                'no_telepon_ibu'   => $this->request->getPost('no_telepon_ibu'),
                'alamat'           => $this->request->getPost('alamat_ortu'),
            ]);

            // Simpan data santri (anak)
            $santriData = $this->request->getPost('santri');
            if (!empty($santriData) && is_array($santriData)) {
                foreach ($santriData as $s) {
                    // Skip jika nama santri kosong
                    if (empty($s['nama_santri'])) continue;

                    // Auto-generate NIS: tahun + random 4 digit
                    $tahun = $s['tahun_angkatan'] ?? date('Y');
                    $nis = $tahun . str_pad(rand(1, 9999), 4, '0', STR_PAD_LEFT);
                    // Pastikan NIS unik
                    while ($this->santriModel->where('nis', $nis)->first()) {
                        $nis = $tahun . str_pad(rand(1, 9999), 4, '0', STR_PAD_LEFT);
                    }

                    $this->santriModel->save([
                        'nis'            => $nis,
                        'nama_santri'    => $s['nama_santri'],
                        'jenis_kelamin'  => $s['jenis_kelamin'] ?? 'L',
                        'tanggal_lahir'  => $s['tanggal_lahir'] ?? null,
                        'alamat'         => $s['alamat'] ?? null,
                        'id_ortu'        => $newUserId,
                        'status'         => 'aktif',
                    ]);
                }
            }

            return redirect()->to('/admin/users')->with('success', 'Akun Orang Tua beserta data santri berhasil ditambahkan.');
        }

        return redirect()->to('/admin/users')->with('success', 'Pengguna berhasil ditambahkan.');
    }

    // =========================================================
    // USER MANAGEMENT - EDIT (tampilkan form edit)
    // =========================================================
    public function editUser($id)
    {
        $user = $this->userModel->find($id);
        if (!$user) {
            return redirect()->to('/admin/users')->with('error', 'Pengguna tidak ditemukan.');
        }

        $parent = null;
        $santri = [];

        if ($user['role'] === 'ortu') {
            $parent = $this->orangTuaModel->where('id_user', $id)->first();
            if ($parent) {
                $santri = $this->santriModel->where('id_ortu', $id)->findAll();
            }
        }

        $data = [
            'judul'  => 'Edit Akun - ' . $user['nama_lengkap'],
            'user'   => $user,
            'parent' => $parent,
            'santri' => $santri,
        ];
        return view('admin/user_edit', $data);
    }

    // =========================================================
    // USER MANAGEMENT - UPDATE (update data user)
    // =========================================================
    public function updateUser($id)
    {
        $user = $this->userModel->find($id);
        if (!$user) {
            return redirect()->to('/admin/users')->with('error', 'Pengguna tidak ditemukan.');
        }

        $rules = [
            'username'     => 'required|min_length[3]|max_length[100]|is_unique[users.username,id,' . $id . ']',
            'nama_lengkap' => 'required|max_length[100]',
            'email'        => 'permit_empty|valid_email|max_length[100]',
            'role'         => 'required|in_list[admin,ustadz,ortu]',
        ];

        $messages = [
            'username' => [
                'required'    => 'Username wajib diisi.',
                'min_length'  => 'Username minimal 3 karakter.',
                'is_unique'   => 'Username sudah digunakan.',
            ],
            'nama_lengkap' => [
                'required'    => 'Nama lengkap wajib diisi.',
            ],
            'email' => [
                'valid_email' => 'Format email tidak valid.',
            ],
            'role' => [
                'required'    => 'Role wajib dipilih.',
                'in_list'     => 'Role tidak valid.',
            ],
        ];

        if (!$this->validate($rules, $messages)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $db = \Config\Database::connect();
        $db->transStart();

        $updateData = [
            'username'     => $this->request->getPost('username'),
            'nama_lengkap' => $this->request->getPost('nama_lengkap'),
            'email'        => $this->request->getPost('email'),
            'role'         => $this->request->getPost('role'),
        ];

        // Hanya update password jika diisi
        $newPassword = $this->request->getPost('password');
        if (!empty($newPassword)) {
            if (strlen($newPassword) < 5) {
                return redirect()->back()->withInput()->with('errors', ['password' => 'Password minimal 5 karakter.']);
            }
            $updateData['password'] = password_hash((string)$newPassword, PASSWORD_DEFAULT);
        }

        $this->userModel->update($id, $updateData);

        // Jika role ORTU, handle data orang tua dan santri
        if ($updateData['role'] === 'ortu') {
            $dataOrtu = [
                'id_user'         => $id,
                'nama_ayah'       => $this->request->getPost('nama_ayah'),
                'nama_ibu'        => $this->request->getPost('nama_ibu'),
                'no_telepon_ayah' => $this->request->getPost('no_telepon_ayah'),
                'no_telepon_ibu'  => $this->request->getPost('no_telepon_ibu'),
                'alamat'          => $this->request->getPost('alamat_ortu'),
            ];

            $existingOrtu = $this->orangTuaModel->where('id_user', $id)->first();
            if ($existingOrtu) {
                $this->orangTuaModel->update($existingOrtu['id'], $dataOrtu);
                $idOrtu = $existingOrtu['id'];
            } else {
                $idOrtu = $this->orangTuaModel->insert($dataOrtu);
            }

            // Handle Santri
            $santriPOST = $this->request->getPost('santri');
            if ($santriPOST && is_array($santriPOST)) {
                foreach ($santriPOST as $sData) {
                    if (empty($sData['nama_santri'])) continue;

                    $sRecord = [
                        'id_ortu'       => $idOrtu,
                        'nama_santri'   => $sData['nama_santri'],
                        'jenis_kelamin' => $sData['jenis_kelamin'],
                        'tanggal_lahir' => $sData['tanggal_lahir'],
                        'tempat_lahir'  => $sData['tempat_lahir'] ?? null,
                        'tahun_angkatan'=> $sData['tahun_angkatan'] ?? date('Y'),
                        'alamat'        => $sData['alamat'],
                        'status'        => 'aktif'
                    ];

                    if (!empty($sData['id'])) {
                        $this->santriModel->update($sData['id'], $sRecord);
                    } else {
                        $yearPart = $sData['tahun_angkatan'] ?? date('Y');
                        $randPart = str_pad((string)rand(0, 9999), 4, '0', STR_PAD_LEFT);
                        $sRecord['nis'] = $yearPart . $randPart;
                        $this->santriModel->insert($sRecord);
                    }
                }
            }
        }

        $db->transComplete();

        if ($db->transStatus() === false) {
            return redirect()->back()->withInput()->with('error', 'Terjadi kesalahan sistem saat memperbarui data.');
        }

        return redirect()->to('/admin/users')->with('success', 'Data akun berhasil diperbarui.');
    }

    // =========================================================
    // USER MANAGEMENT - DELETE
    // =========================================================
    public function deleteUser($id)
    {
        $user = $this->userModel->find($id);
        if (!$user) {
            return redirect()->to('/admin/users')->with('error', 'Pengguna tidak ditemukan.');
        }

        // Jangan hapus diri sendiri
        if ($user['id'] == session()->get('id')) {
            return redirect()->to('/admin/users')->with('error', 'Anda tidak dapat menghapus akun Anda sendiri.');
        }

        $this->userModel->delete($id);

        return redirect()->to('/admin/users')->with('success', 'Pengguna berhasil dihapus.');
    }

    // =========================================================
    // USER MANAGEMENT - TOGGLE STATUS (aktif/nonaktif)
    // =========================================================
    public function toggleStatus($id)
    {
        $user = $this->userModel->find($id);
        if (!$user) {
            return redirect()->to('/admin/users')->with('error', 'Pengguna tidak ditemukan.');
        }

        // Jangan nonaktifkan diri sendiri
        if ($user['id'] == session()->get('id')) {
            return redirect()->to('/admin/users')->with('error', 'Anda tidak dapat menonaktifkan akun Anda sendiri.');
        }

        $newStatus = ($user['status'] === 'aktif') ? 'nonaktif' : 'aktif';
        $this->userModel->update($id, ['status' => $newStatus]);

        $statusText = ($newStatus === 'aktif') ? 'diaktifkan' : 'dinonaktifkan';
        return redirect()->to('/admin/users')->with('success', "Pengguna berhasil {$statusText}.");
    }

    // =========================================================
    // USER MANAGEMENT - DETAIL
    // =========================================================
    public function userDetail($id)
    {
        $user = $this->userModel->find($id);
        if (!$user) {
            return redirect()->to('/admin/users')->with('error', 'Pengguna tidak ditemukan.');
        }

        $profile = null;
        $extraData = [];

        if ($user['role'] === 'ustadz') {
            $profile = $this->ustadzModel->where('id_user', $id)->first();
            $extraData['kelas'] = $this->kelasModel->where('id_ustadz', $id)->findAll();
        } elseif ($user['role'] === 'ortu') {
            $profile = $this->orangTuaModel->where('id_user', $id)->first();
            $extraData['santri'] = $this->santriModel->where('id_ortu', $id)->findAll();
        }

        $data = [
            'judul'      => 'Detail Pengguna',
            'nama_admin' => session()->get('nama_lengkap') ?? 'Admin PTQ',
            'user'       => $user,
            'profile'    => $profile,
            'extraData'  => $extraData
        ];

        return view('admin/user_detail', $data);
    }

    // =========================================================
    // NEW ADMIN PAGES (MOCKUP)
    // =========================================================
    public function santri()
    {
        $santri = $this->santriModel->getSantriWithDetails();
        $ortuList = $this->userModel->where('role', 'ortu')->findAll();
        
        $data = [
            'judul' => 'Data Santri',
            'santri' => $santri,
            'ortuList' => $ortuList,
        ];
        return view('admin/santri', $data);
    }

    public function storeSantri()
    {
        $rules = [
            'nis' => 'required|is_unique[santri.nis]',
            'nama_santri' => 'required',
            'tanggal_lahir' => 'required|valid_date',
            'jenis_kelamin' => 'required|in_list[L,P]',
            'id_ortu' => 'permit_empty|integer'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->santriModel->save([
            'nis' => $this->request->getPost('nis'),
            'nama_santri' => $this->request->getPost('nama_santri'),
            'tanggal_lahir' => $this->request->getPost('tanggal_lahir'),
            'jenis_kelamin' => $this->request->getPost('jenis_kelamin'),
            'alamat' => $this->request->getPost('alamat'),
            'id_ortu' => $this->request->getPost('id_ortu'),
            'status' => 'aktif'
        ]);

        return redirect()->to('/admin/santri')->with('success', 'Santri berhasil ditambahkan.');
    }

    // =========================================================
    // DATA SANTRI - DETAIL
    // =========================================================
    public function santriDetail($id)
    {
        // Get santri with class and parent info
        $santri = $this->santriModel->select('santri.*, kelas.nama_kelas, ortu.nama_lengkap as nama_ortu')
            ->join('kelas', 'kelas.id = santri.id_kelas', 'left')
            ->join('users as ortu', 'ortu.id = santri.id_ortu', 'left')
            ->find($id);

        if (!$santri) {
            return redirect()->to('/admin/santri')->with('error', 'Data santri tidak ditemukan.');
        }

        // Get riwayat hafalan
        $riwayat = $this->hafalanModel->select('hafalan.*, ustadz.nama_lengkap as nama_penguji')
            ->join('ustadz', 'ustadz.id = hafalan.id_ustadz', 'left')
            ->where('id_santri', $id)
            ->orderBy('tanggal', 'DESC')
            ->findAll();

        // Get parent profile if linked
        $parentProfile = null;
        if ($santri['id_ortu']) {
            $parentProfile = $this->orangTuaModel->where('id_user', $santri['id_ortu'])->first();
        }

        $data = [
            'judul'      => 'Detail Santri',
            'nama_admin' => session()->get('nama_lengkap') ?? 'Admin PTQ',
            'santri'     => $santri,
            'riwayat'    => $riwayat,
            'parent'     => $parentProfile
        ];

        return view('admin/santri_detail', $data);
    }

    public function updateSantri($id)
    {
        $rules = [
            'nis' => "required|is_unique[santri.nis,id,{$id}]",
            'nama_santri' => 'required',
            'tanggal_lahir' => 'required|valid_date',
            'jenis_kelamin' => 'required|in_list[L,P]',
            'id_ortu' => 'permit_empty|integer',
            'status' => 'required|in_list[aktif,lulus,drop out]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->santriModel->update($id, [
            'nis' => $this->request->getPost('nis'),
            'nama_santri' => $this->request->getPost('nama_santri'),
            'tanggal_lahir' => $this->request->getPost('tanggal_lahir'),
            'jenis_kelamin' => $this->request->getPost('jenis_kelamin'),
            'alamat' => $this->request->getPost('alamat'),
            'id_ortu' => $this->request->getPost('id_ortu'),
            'status' => $this->request->getPost('status')
        ]);

        return redirect()->to('/admin/santri')->with('success', 'Data santri berhasil diperbarui.');
    }

    public function deleteSantri($id)
    {
        $this->santriModel->delete($id);
        return redirect()->to('/admin/santri')->with('success', 'Santri berhasil dihapus.');
    }

    public function ustadz()
    {
        // Get all users with role 'ustadz' and left join their profile details
        $ustadz = $this->userModel->select('users.id as user_id_account, users.username, users.email, users.status as user_status, ustadz.*, ustadz.id as profile_id')
                    ->where('role', 'ustadz')
                    ->join('ustadz', 'ustadz.id_user = users.id', 'left')
                    ->findAll();
        
        $data = [
            'judul'  => 'Data Ustadz/Pengajar',
            'ustadz' => $ustadz,
        ];
        return view('admin/ustadz', $data);
    }

    public function createUstadz()
    {
        // Get all user accounts with 'ustadz' role that don't have a profile yet
        $existingUstadzUserIds = $this->ustadzModel->findAll();
        $existingIds = array_column($existingUstadzUserIds, 'id_user');
        
        $userUstadzQuery = $this->userModel->where('role', 'ustadz');
        if (!empty($existingIds)) {
            $userUstadzQuery->whereNotIn('id', $existingIds);
        }
        $userUstadz = $userUstadzQuery->findAll();

        $data = [
            'judul'      => 'Tambah Profil Ustadz',
            'userUstadz' => $userUstadz,
        ];
        return view('admin/ustadz_create', $data);
    }

    public function editUstadz($id)
    {
        $ustadz = $this->ustadzModel->find($id);
        if (!$ustadz) {
            return redirect()->to('/admin/ustadz')->with('error', 'Profil Ustadz tidak ditemukan.');
        }

        $user = $this->userModel->find($ustadz['id_user']);

        $data = [
            'judul'  => 'Edit Profil Ustadz',
            'ustadz' => $ustadz,
            'user'   => $user,
        ];
        return view('admin/ustadz_edit', $data);
    }

    public function storeUstadz()
    {
        $rules = [
            'id_user'       => 'required|is_unique[ustadz.id_user]',
            'nama_lengkap'  => 'required|min_length[3]',
            'nip'           => 'permit_empty|is_unique[ustadz.nip]',
            'jenis_kelamin' => 'required|in_list[L,P]',
            'no_telepon'    => 'required',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->ustadzModel->save([
            'id_user'         => $this->request->getPost('id_user'),
            'nip'             => $this->request->getPost('nip') ?: null,
            'nama_lengkap'    => $this->request->getPost('nama_lengkap'),
            'jenis_kelamin'   => $this->request->getPost('jenis_kelamin'),
            'tanggal_lahir'   => $this->request->getPost('tanggal_lahir') ?: null,
            'alamat'          => $this->request->getPost('alamat'),
            'no_telepon'      => $this->request->getPost('no_telepon'),
            'pendidikan'      => $this->request->getPost('pendidikan'),
            'bidang_keahlian' => $this->request->getPost('bidang_keahlian'),
            'status'          => 'aktif'
        ]);

        return redirect()->to('/admin/ustadz')->with('success', 'Profil Ustadz berhasil ditambahkan.');
    }

    public function updateUstadz($id)
    {
        $ustadz = $this->ustadzModel->find($id);
        if (!$ustadz) {
            return redirect()->to('/admin/ustadz')->with('error', 'Profil Ustadz tidak ditemukan.');
        }

        $rules = [
            'nama_lengkap'  => 'required|min_length[3]',
            'nip'           => "permit_empty|is_unique[ustadz.nip,id,{$id}]",
            'jenis_kelamin' => 'required|in_list[L,P]',
            'no_telepon'    => 'required',
            'status'        => 'required|in_list[aktif,nonaktif]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->ustadzModel->update($id, [
            'nip'             => $this->request->getPost('nip') ?: null,
            'nama_lengkap'    => $this->request->getPost('nama_lengkap'),
            'jenis_kelamin'   => $this->request->getPost('jenis_kelamin'),
            'tanggal_lahir'   => $this->request->getPost('tanggal_lahir') ?: null,
            'alamat'          => $this->request->getPost('alamat'),
            'no_telepon'      => $this->request->getPost('no_telepon'),
            'pendidikan'      => $this->request->getPost('pendidikan'),
            'bidang_keahlian' => $this->request->getPost('bidang_keahlian'),
            'status'          => $this->request->getPost('status')
        ]);

        return redirect()->to('/admin/ustadz')->with('success', 'Profil Ustadz berhasil diperbarui.');
    }

    // =========================================================
    // DATA USTADZ - DETAIL
    // =========================================================
    public function ustadzDetail($id)
    {
        // Get ustadz profile join with user account
        $ustadz = $this->ustadzModel->select('ustadz.*, users.username, users.email')
            ->join('users', 'users.id = ustadz.id_user', 'left')
            ->where('ustadz.id', $id)
            ->first();

        if (!$ustadz) {
            return redirect()->to('/admin/ustadz')->with('error', 'Profil Ustadz tidak ditemukan.');
        }

        // Get managed classes
        $kelas = $this->kelasModel->where('id_ustadz', $ustadz['id_user'])->findAll();

        // Get schedule
        $jadwal = $this->jadwalModel->getJadwalByUstadz($ustadz['id_user']);

        $data = [
            'judul'      => 'Detail Profil Pengajar',
            'nama_admin' => session()->get('nama_lengkap') ?? 'Admin PTQ',
            'ustadz'     => $ustadz,
            'kelas'      => $kelas,
            'jadwal'     => $jadwal
        ];

        return view('admin/ustadz_detail', $data);
    }

    public function deleteUstadz($id)
    {
        $this->ustadzModel->delete($id);
        return redirect()->to('/admin/ustadz')->with('success', 'Profil pengajar berhasil dihapus. (Akun login masih ada)');
    }

    public function kelas()
    {
        $kelas = $this->kelasModel->getKelasWithWali();
        
        // Enhance with multiple teachers list
        foreach ($kelas as &$k) {
            $k['pengampu'] = $this->kelasUstadzModel->getUstadzByKelas($k['id']);
        }

        $data = [
            'judul' => 'Data Kelas',
            'kelas' => $kelas,
        ];
        return view('admin/kelas', $data);
    }

    public function createKelas()
    {
        $ustadzList = $this->userModel->where('role', 'ustadz')->findAll();
        
        $data = [
            'judul'      => 'Tambah Kelas Baru',
            'ustadzList' => $ustadzList,
        ];
        return view('admin/kelas_create', $data);
    }

    public function editKelas($id)
    {
        $kelas = $this->kelasModel->find($id);
        if (!$kelas) {
            return redirect()->to('/admin/kelas')->with('error', 'Kelas tidak ditemukan.');
        }

        $ustadzList = $this->userModel->where('role', 'ustadz')->findAll();
        $currentTeachers = $this->kelasUstadzModel->where('id_kelas', $id)->findAll();
        $currentTeacherIds = array_column($currentTeachers, 'id_ustadz');

        $data = [
            'judul'             => 'Edit Data Kelas',
            'kelas'             => $kelas,
            'ustadzList'        => $ustadzList,
            'currentTeacherIds' => $currentTeacherIds
        ];
        return view('admin/kelas_edit', $data);
    }

    public function storeKelas()
    {
        $rules = [
            'nama_kelas' => 'required|min_length[3]',
            'id_ustadz'  => 'permit_empty|integer',
            'ustadz_ids' => 'permit_empty'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $db = \Config\Database::connect();
        $db->transStart();

        // 1. Save Main Kelas
        $id_kelas = $this->kelasModel->insert([
            'nama_kelas' => $this->request->getPost('nama_kelas'),
            'deskripsi'  => $this->request->getPost('deskripsi'),
            'id_ustadz'  => $this->request->getPost('id_ustadz') ?: null
        ]);

        // 2. Save Multiple Teachers
        $ustadzIds = $this->request->getPost('ustadz_ids');
        if (!empty($ustadzIds)) {
            foreach ($ustadzIds as $uid) {
                $this->kelasUstadzModel->insert([
                    'id_kelas'  => $id_kelas,
                    'id_ustadz' => $uid
                ]);
            }
        }

        $db->transComplete();

        return redirect()->to('/admin/kelas')->with('success', 'Kelas berhasil ditambahkan.');
    }

    public function updateKelas($id)
    {
        $rules = [
            'nama_kelas' => 'required|min_length[3]',
            'id_ustadz'  => 'permit_empty|integer'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $db = \Config\Database::connect();
        $db->transStart();

        // 1. Update Main Kelas
        $this->kelasModel->update($id, [
            'nama_kelas' => $this->request->getPost('nama_kelas'),
            'deskripsi'  => $this->request->getPost('deskripsi'),
            'id_ustadz'  => $this->request->getPost('id_ustadz') ?: null
        ]);

        // 2. Update Multiple Teachers (Sync)
        $this->kelasUstadzModel->where('id_kelas', $id)->delete();
        $ustadzIds = $this->request->getPost('ustadz_ids');
        if (!empty($ustadzIds)) {
            foreach ($ustadzIds as $uid) {
                $this->kelasUstadzModel->insert([
                    'id_kelas'  => $id,
                    'id_ustadz' => $uid
                ]);
            }
        }

        $db->transComplete();

        return redirect()->to('/admin/kelas')->with('success', 'Data kelas berhasil diperbarui.');
    }

    public function deleteKelas($id)
    {
        $this->kelasModel->delete($id);
        return redirect()->to('/admin/kelas')->with('success', 'Kelas berhasil dihapus.');
    }

    public function hafalan()
    {
        $db = \Config\Database::connect();
        $riwayatHafalan = $db->table('hafalan')
            ->select('hafalan.*, santri.nama_santri, santri.nis, kelas.nama_kelas, ustadz.nama_lengkap as nama_penguji')
            ->join('santri', 'santri.id = hafalan.id_santri', 'left')
            ->join('kelas', 'kelas.id = santri.id_kelas', 'left')
            ->join('ustadz', 'ustadz.id = hafalan.id_ustadz', 'left')
            ->orderBy('hafalan.tanggal', 'DESC')
            ->get()
            ->getResultArray();

        $data = [
            'judul' => 'Rapor Hafalan Santri (Global)',
            'riwayat' => $riwayatHafalan,
        ];
        return view('admin/hafalan', $data);
    }

    public function pembayaran()
    {
        $db = \Config\Database::connect();
        
        // 1. Ambil Stats Global
        $totalMasuk = $db->table('pembayaran')->where('status', 'Lunas')->selectSum('jumlah')->get()->getRow()->jumlah ?? 0;
        $totalTunggakan = $db->table('pembayaran')->whereIn('status', ['Pending', 'Ditolak'])->selectSum('jumlah')->get()->getRow()->jumlah ?? 0;
        $validasiTertunda = $db->table('pembayaran')->where('status', 'Pending')->where('bukti_bayar !=', null)->where('bukti_bayar !=', '')->countAllResults();
        $totalDitagihkan = $db->table('pembayaran')->selectSum('jumlah')->get()->getRow()->jumlah ?? 0;

        // 2. Ambil Overview Per Santri (Agregasi)
        // Kita butuh NIS, Nama, dan ringkasan status tagihannya
        $santriOverview = $db->table('santri')
            ->select('santri.id, santri.nis, santri.nama_santri, 
                     COUNT(p.id) as total_bill, 
                     SUM(CASE WHEN p.status = "Lunas" THEN 1 ELSE 0 END) as paid_bill,
                     SUM(CASE WHEN p.status != "Lunas" THEN 1 ELSE 0 END) as unpaid_bill')
            ->join('pembayaran p', 'p.id_santri = santri.id', 'left')
            ->groupBy('santri.id')
            ->orderBy('santri.nama_santri', 'ASC')
            ->get()->getResultArray();

        // 3. Masih butuh data mentah riwayat (untuk modal/detail dikemudian hari)
        $riwayatPembayaran = $this->pembayaranModel->getSemuaPembayaran();
        $santriList = $this->santriModel->orderBy('nama_santri', 'ASC')->findAll();

        $data = [
            'judul'             => 'Keuangan Santri',
            'nama_admin'        => session()->get('nama_lengkap') ?? 'Admin PTQ',
            'stats'             => [
                'masuk'     => $totalMasuk,
                'tunggakan' => $totalTunggakan,
                'pending'   => $validasiTertunda,
                'total'     => $totalDitagihkan
            ],
            'santriOverview'    => $santriOverview,
            'riwayat'           => $riwayatPembayaran,
            'santriList'        => $santriList
        ];
        
        return view('admin/pembayaran', $data);
    }

    public function storePembayaran()
    {
        $rules = [
            'id_santri' => 'required|integer',
            'jenis_pembayaran' => 'required',
            'jumlah' => 'required|numeric',
            'status' => 'required|in_list[Pending,Lunas,Ditolak]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->pembayaranModel->save([
            'id_santri' => $this->request->getPost('id_santri'),
            'jenis_pembayaran' => $this->request->getPost('jenis_pembayaran'),
            'tanggal_bayar' => $this->request->getPost('tanggal_bayar') ?: null,
            'jumlah' => $this->request->getPost('jumlah'),
            'status' => $this->request->getPost('status'),
            'keterangan' => $this->request->getPost('keterangan')
        ]);

        return redirect()->to('/admin/pembayaran')->with('success', 'Data tagihan/pembayaran berhasil ditambahkan.');
    }

    public function updatePembayaran($id)
    {
        $rules = [
            'jenis_pembayaran' => 'required',
            'jumlah' => 'required|numeric',
            'status' => 'required|in_list[Pending,Lunas,Ditolak]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->pembayaranModel->update($id, [
            'jenis_pembayaran' => $this->request->getPost('jenis_pembayaran'),
            'tanggal_bayar' => $this->request->getPost('tanggal_bayar') ?: null,
            'jumlah' => $this->request->getPost('jumlah'),
            'status' => $this->request->getPost('status'),
            'keterangan' => $this->request->getPost('keterangan')
        ]);

        return redirect()->to('/admin/pembayaran')->with('success', 'Status/Data pembayaran berhasil diperbarui.');
    }

    public function pembayaranDetail($id)
    {
        $db = \Config\Database::connect();
        
        // 1. Fetch Student Details (Joined with Kelas and Ortu info)
        $santri = $db->table('santri')
            ->select('santri.*, kelas.nama_kelas, orang_tua.nama_ayah, orang_tua.nama_ibu, orang_tua.no_telepon_ayah, orang_tua.no_telepon_ibu')
            ->join('kelas', 'kelas.id = santri.id_kelas', 'left')
            ->join('orang_tua', 'orang_tua.id_user = santri.id_ortu', 'left')
            ->where('santri.id', $id)
            ->get()->getRowArray();

        if (!$santri) {
            return redirect()->to('/admin/pembayaran')->with('error', 'Data santri tidak ditemukan.');
        }

        // 2. Fetch Billing History
        $history = $db->table('pembayaran')
            ->where('id_santri', $id)
            ->orderBy('created_at', 'DESC')
            ->get()->getResultArray();

        // 3. Calculate Arrears Summary
        $unpaid_sum = 0;
        $unpaid_count = 0;
        foreach ($history as $h) {
            if ($h['status'] != 'Lunas') {
                $unpaid_sum += $h['jumlah'];
                $unpaid_count++;
            }
        }

        $data = [
            'judul'          => 'Detail Kelola Pembayaran',
            'santri'         => $santri,
            'history'        => $history,
            'unpaid_sum'     => $unpaid_sum,
            'unpaid_count'   => $unpaid_count,
            'nama_admin'     => session()->get('nama_lengkap') ?? 'Admin PTQ'
        ];

        return view('admin/pembayaran_detail', $data);
    }

    public function deletePembayaran($id)
    {
        $pembayaran = $this->pembayaranModel->find($id);
        if (!$pembayaran) return redirect()->back()->with('error', 'Data tidak ditemukan.');
        
        $this->pembayaranModel->delete($id);
        
        $returnTo = $this->request->getGet('return_to');
        if ($returnTo) return redirect()->to($returnTo)->with('success', 'Tagihan berhasil dihapus.');
        
        return redirect()->to('/admin/pembayaran')->with('success', 'Data pembayaran berhasil dihapus dari sistem.');
    }

    public function verifikasiPembayaran($id)
    {
        $pembayaran = $this->pembayaranModel->find($id);
        if (!$pembayaran) return redirect()->back()->with('error', 'Data tidak ditemukan.');

        $this->pembayaranModel->update($id, [
            'status' => 'Lunas',
            'tanggal_bayar' => date('Y-m-d')
        ]);

        $returnTo = $this->request->getGet('return_to');
        if ($returnTo) return redirect()->to($returnTo)->with('success', 'Pembayaran berhasil diverifikasi.');

        return redirect()->to('/admin/pembayaran')->with('success', 'Pembayaran berhasil diverifikasi.');
    }

    public function pengumuman()
    {
        $data = [
            'judul'      => 'Pengumuman & Informasi',
            'riwayat'    => $this->pengumumanModel->getPengumumanWithAuthor(),
            'nama_admin' => session()->get('nama_lengkap') ?? 'Admin PTQ',
        ];
        return view('admin/pengumuman', $data);
    }

    public function storePengumuman()
    {
        $rules = [
            'judul'       => 'required|min_length[5]|max_length[255]',
            'konten'      => 'required',
            'kategori'    => 'required|in_list[Umum,Akademik,Keuangan,Penting]',
            'target_role' => 'required|in_list[ustadz,ortu,semua]',
            'status'      => 'required|in_list[draft,terbit]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->pengumumanModel->save([
            'judul'       => $this->request->getPost('judul'),
            'konten'      => $this->request->getPost('konten'),
            'kategori'    => $this->request->getPost('kategori'),
            'target_role' => $this->request->getPost('target_role'),
            'status'      => $this->request->getPost('status'),
            'id_penulis'  => session()->get('id')
        ]);

        return redirect()->to('/admin/pengumuman')->with('success', 'Pengumuman berhasil dipublikasikan.');
    }

    public function updatePengumuman($id)
    {
        $rules = [
            'judul'       => 'required|min_length[5]|max_length[255]',
            'konten'      => 'required',
            'kategori'    => 'required|in_list[Umum,Akademik,Keuangan,Penting]',
            'target_role' => 'required|in_list[ustadz,ortu,semua]',
            'status'      => 'required|in_list[draft,terbit]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->pengumumanModel->update($id, [
            'judul'       => $this->request->getPost('judul'),
            'konten'      => $this->request->getPost('konten'),
            'kategori'    => $this->request->getPost('kategori'),
            'target_role' => $this->request->getPost('target_role'),
            'status'      => $this->request->getPost('status'),
            // id_penulis tidak diperbarui untuk melacak pembuat awal
        ]);

        return redirect()->to('/admin/pengumuman')->with('success', 'Pengumuman berhasil diperbarui.');
    }

    public function deletePengumuman($id)
    {
        $this->pengumumanModel->delete($id);
        return redirect()->to('/admin/pengumuman')->with('success', 'Pengumuman berhasil dihapus.');
    }

    // =========================================================
    // JADWAL MANAGEMENT
    // =========================================================
    public function jadwal()
    {
        $jadwal = $this->jadwalModel->getJadwalWithDetails();
        $kelas = $this->kelasModel->findAll();
        $ustadzList = $this->userModel->where('role', 'ustadz')->findAll();

        $data = [
            'judul'      => 'Kelola Jadwal Pelajaran',
            'jadwal'     => $jadwal,
            'kelasList'  => $kelas,
            'ustadzList' => $ustadzList,
            'nama_admin' => session()->get('nama_lengkap') ?? 'Admin PTQ',
        ];

        return view('admin/jadwal', $data);
    }

    public function storeJadwal()
    {
        $rules = [
            'hari'           => 'required|in_list[Senin,Selasa,Rabu,Kamis,Jumat,Sabtu,Minggu]',
            'jam_mulai'      => 'required',
            'jam_selesai'    => 'required',
            'nama_kegiatans' => 'required|max_length[100]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->jadwalModel->save([
            'id_kelas'       => $this->request->getPost('id_kelas') ?: null,
            'id_ustadz'      => $this->request->getPost('id_ustadz') ?: null,
            'hari'           => $this->request->getPost('hari'),
            'jam_mulai'      => $this->request->getPost('jam_mulai'),
            'jam_selesai'    => $this->request->getPost('jam_selesai'),
            'nama_kegiatans' => $this->request->getPost('nama_kegiatans'),
            'deskripsi'      => $this->request->getPost('deskripsi'),
        ]);

        return redirect()->to('/admin/jadwal')->with('success', 'Jadwal berhasil ditambahkan.');
    }

    public function updateJadwal($id)
    {
        $rules = [
            'hari'           => 'required|in_list[Senin,Selasa,Rabu,Kamis,Jumat,Sabtu,Minggu]',
            'jam_mulai'      => 'required',
            'jam_selesai'    => 'required',
            'nama_kegiatans' => 'required|max_length[100]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->jadwalModel->update($id, [
            'id_kelas'       => $this->request->getPost('id_kelas') ?: null,
            'id_ustadz'      => $this->request->getPost('id_ustadz') ?: null,
            'hari'           => $this->request->getPost('hari'),
            'jam_mulai'      => $this->request->getPost('jam_mulai'),
            'jam_selesai'    => $this->request->getPost('jam_selesai'),
            'nama_kegiatans' => $this->request->getPost('nama_kegiatans'),
            'deskripsi'      => $this->request->getPost('deskripsi'),
        ]);

        return redirect()->to('/admin/jadwal')->with('success', 'Jadwal berhasil diperbarui.');
    }

    public function deleteJadwal($id)
    {
        $this->jadwalModel->delete($id);
        return redirect()->to('/admin/jadwal')->with('success', 'Jadwal berhasil dihapus.');
    }
}
