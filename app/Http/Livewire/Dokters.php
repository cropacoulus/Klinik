<?php

namespace App\Http\Livewire;

use App\Models\Dokter;
use Livewire\Component;
use Livewire\WithPagination;

class Dokters extends Component
{
    public $search, $paging, $namadokter, $jk, $tanggallahir, $nohp, $email, $alamat, $tarifdokter, $id_dokter;
    public $isModal = 0;
    use WithPagination;

    public function mount()
    {
        $this->paging = 10;
    }

    public function render()
    {
        if($this->search){
            $dokters = Dokter::where(function ($query){
                $query->where('namadokter', 'like', "%$this->search%");
            })->orderBy('iddokter', 'asc')->paginate($this->paging);
        }else{
            $dokters = Dokter::orderBy('iddokter', 'asc')->paginate($this->paging);
        }
        
        return view('livewire.dokter.dokters', compact('dokters'));
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
        $this->iddokter = '';
        $this->namadokter = '';
        $this->jk = '';
        $this->tanggallahir = '';
        $this->nohp = '';
        $this->email = '';
        $this->alamat = '';
        $this->tarifdokter = '';
    }

    public function store()
    {
        $validatedData = $this->validate([
            'iddokter' => 'required',
            'namadokter' => 'required|string',
            'jk' => 'required',
            'tanggallahir' => 'required',
            'nohp' => 'required|numeric',
            'email' => 'required|email',
            'alamat' => 'required|string',
            'tarifdokter' => 'required|numeric'
        ]);

        Dokter::create($validatedData);

        session()->flash('message', $this->namadokter . ' Created');
        $this->resetFields();
        $this->emit('dokterAdded');
        $this->closeModal();
    }

    public function edit($id)
    {
        $this->openModal();
        $dokter = Dokter::findOrFail($id);
        $this->id_dokter = $id;
        $this->iddokter = $dokter->iddokter;
        $this->namadokter = $dokter->namadokter;
        $this->jk = $dokter->jk;
        $this->tanggallahir = $dokter->tanggallahir;
        $this->nohp = $dokter->nohp;
        $this->email = $dokter->email;
        $this->alamat = $dokter->alamat;
        $this->tarifdokter = $dokter->tarifdokter;
    }

    public function update()
    {
        $this->validate([
            'namadokter' => 'required|string',
            'jk' => 'required',
            'tanggallahir' => 'required',
            'nohp' => 'required|numeric',
            'email' => 'required|email',
            'alamat' => 'required|string',
            'tarifdokter' => 'required|numeric'
        ]);
        if($this->id_dokter){
            $dokter = Dokter::find($this->id_dokter);
            $dokter->update([
                'namadokter' => $this->namadokter,
                'jk' => $this->jk,
                'tanggallahir' => $this->tanggallahir,
                'nohp' => $this->nohp,
                'email' => $this->email,
                'alamat' => $this->alamat,
                'tarifdokter' => $this->tarifdokter
            ]);
            session()->flash('message', $this->namadokter . ' Updated');
            $this->resetFields();
            $this->emit('dokterUpdated');
            $this->closeModal();
        }
    }

    public function delete($id)
    {
        $dokter = Dokter::find($id);
        $dokter->delete();
        session()->flash('message', $dokter->namadokter . ' Dihapus');
    }
}
