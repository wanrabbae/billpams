<?php

namespace App\Livewire\Admin\Users;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\User;
use App\Services\TenantManager;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class Index extends Component
{
    use WithPagination;

    public $search = '';
    
    // Form fields
    public $showForm = false;
    public $userId;
    public $name;
    public $username;
    public $role = 'petugas';
    public $status = 'aktif';
    public $password;

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function openForm($id = null)
    {
        $this->resetValidation();
        $this->reset(['name', 'username', 'role', 'status', 'password', 'userId']);
        
        if ($id) {
            $user = User::findOrFail($id);
            // Proteksi: tidak bisa mengedit akun super_admin
            if ($user->role === 'super_admin') {
                session()->flash('error', 'Akses ditolak.');
                return;
            }
            // Proteksi: admin_tenant tidak bisa diubah rolenya oleh admin lain (opsional)
            $this->userId = $user->id;
            $this->name = $user->name;
            $this->username = $user->username;
            $this->role = $user->role;
            $this->status = $user->status;
        }
        
        $this->showForm = true;
    }

    public function closeForm()
    {
        $this->showForm = false;
    }

    public function simpanUser()
    {
        $tenantId = TenantManager::getTenantId();

        $rules = [
            'name' => 'required|string|max:255',
            'username' => [
                'required', 'string', 'max:50',
                Rule::unique('users')->where(function ($query) use ($tenantId) {
                    return $query->where('tenant_id', $tenantId);
                })->ignore($this->userId)
            ],
            'role' => 'required|in:admin_tenant,bendahara,petugas,pengawas',
            'status' => 'required|in:aktif,nonaktif',
        ];

        // Password wajib jika user baru, opsional jika edit
        if (!$this->userId) {
            $rules['password'] = 'required|min:6';
        } else {
            $rules['password'] = 'nullable|min:6';
        }

        $this->validate($rules);

        $data = [
            'tenant_id' => $tenantId,
            'name' => $this->name,
            'username' => $this->username,
            'role' => $this->role,
            'status' => $this->status,
        ];

        if ($this->password) {
            $data['password'] = Hash::make($this->password);
        }

        if ($this->userId) {
            User::where('id', $this->userId)->update($data);
            session()->flash('success', 'Data Akun berhasil diperbarui.');
        } else {
            User::create($data);
            session()->flash('success', 'Akun User baru berhasil dibuat.');
        }

        $this->closeForm();
    }

    public function toggleStatus($id)
    {
        $user = User::findOrFail($id);
        if ($user->id === Auth::id()) {
            session()->flash('error', 'Anda tidak dapat menonaktifkan akun Anda sendiri.');
            return;
        }
        if ($user->role === 'super_admin' || $user->role === 'admin_tenant') {
            session()->flash('error', 'Role Admin tidak dapat dinonaktifkan dari menu ini.');
            return;
        }

        $user->update([
            'status' => $user->status === 'aktif' ? 'nonaktif' : 'aktif'
        ]);
        session()->flash('success', 'Status akun berhasil diubah.');
    }

    public function render()
    {
        $tenantId = TenantManager::getTenantId();
        
        $users = User::where('tenant_id', $tenantId)
            ->where('role', '!=', 'super_admin') // Sembunyikan super admin dari tenant
            ->when(strlen($this->search) >= 2, function($q) {
                $q->where(function($sq) {
                    $sq->where('name', 'like', '%'.$this->search.'%')
                       ->orWhere('username', 'like', '%'.$this->search.'%');
                });
            })
            ->orderBy('role')
            ->orderBy('name')
            ->paginate(15);

        return view('livewire.admin.users.index', compact('users'))
               ->layout('components.layouts.admin', ['header' => 'Manajemen Akun / Petugas']);
    }
}
