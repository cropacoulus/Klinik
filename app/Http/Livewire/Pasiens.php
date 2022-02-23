<?php

namespace App\Http\Livewire;

use App\Models\Pasien;
use Livewire\Component;
use Livewire\WithPagination;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class Pasiens extends Component
{
    public $search, $paging, $namapasien, $jk, $tanggallahir, $nohp, $email, $alamat, $id_pasien;
    public $isModal = 0;
    use WithPagination;

    public function mount()
    {
        $this->paging = 10;
    }

    public function render()
    {
        $idpas = IdGenerator::generate(['table' => 'pasiens','field'=>'idpasien', 'length' => 6, 'prefix' =>'PAS']);
        if($this->search){
            $pasiens = Pasien::where(function ($query){
                $query->where('namapasien', 'like', "%$this->search%");
            })->orderBy('idpasien', 'asc')->paginate($this->paging);
        }else{
            $pasiens = Pasien::orderBy('idpasien', 'asc')->paginate($this->paging);
        }
        
        return view('livewire.pasien.pasiens', compact('pasiens', 'idpas'));
    }    

    public function closeModal()
    {
        $this->isModal = false;
    }

    public function openModal()
    {
        $this->isModal = true;
    }

    public function create()
    {
        $this->resetFields();
        $this->openModal();
    }

    public function resetFields()
    {
        $this->idpasien = '';
        $this->namapasien = '';
        $this->jk = '';
        $this->tanggallahir = '';
        $this->nohp = '';
        $this->email = '';
        $this->alamat = '';
    }

    public function store()
    {
        $validatedData = $this->validate([
            'idpasien' => 'required',
            'namapasien' => 'required|string',
            'jk' => 'required',
            'tanggallahir' => 'required',
            'nohp' => 'required|numeric',
            'email' => 'required|email',
            'alamat' => 'required|string'
        ]);

        Pasien::create($validatedData);

        session()->flash('message', $this->namapasien . ' Created');
        $this->resetFields();
        $this->emit('pasienAdded');
        $this->closeModal();
    }

    public function edit($id)
    {
        $this->openModal();
        $pasien = Pasien::findOrFail($id);
        $this->id_pasien = $id;
        $this->idpasien = $pasien->idpasien;
        $this->namapasien = $pasien->namapasien;
        $this->jk = $pasien->jk;
        $this->tanggallahir = $pasien->tanggallahir;
        $this->nohp = $pasien->nohp;
        $this->email = $pasien->email;
        $this->alamat = $pasien->alamat;

        
    }

    public function update()
    {
        $this->validate([
            'namapasien' => 'required|string',
            'jk' => 'required',
            'tanggallahir' => 'required',
            'nohp' => 'required|numeric',
            'email' => 'required|email',
            'alamat' => 'required|string'
        ]);
        if($this->id_pasien){
            $pasien = Pasien::find($this->id_pasien);
            $pasien->update([
                'namapasien' => $this->namapasien,
                'jk' => $this->jk,
                'tanggallahir' => $this->tanggallahir,
                'nohp' => $this->nohp,
                'email' => $this->email,
                'alamat' => $this->alamat
            ]);
            session()->flash('message', $this->namapasien . ' Updated');
            $this->resetFields();
            $this->emit('pasienUpdated');
            $this->closeModal();
        }
    }

    public function delete($id)
    {
        $pasien = Pasien::find($id);
        $pasien->delete();
        session()->flash('message', $pasien->namapasien . ' Dihapus');
    }
}
