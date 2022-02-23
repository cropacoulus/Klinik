<?php

namespace App\Http\Livewire;

use App\Models\Dokter;
use App\Models\Pasien;
use Livewire\Component;
use App\Models\Rekammedik;
use Livewire\WithPagination;

class Rekammediks extends Component
{
    public $search, $paging, $pasien_id, $dokter_id, $tanggalberobat, $diagnosadokter, $id_rekammedik;
    public $isModal = 0;
    use WithPagination;

    public function mount()
    {
        $this->paging = 10;
    }

    public function render()
    {
        if($this->search){
            $rekams = Rekammedik::with('pasien','dokter')
                ->where(function ($query){
                $query->where('idrekammedik', 'like', "%$this->search%")
                ->orWhere('tanggalberobat', 'like', "%$this->search")
                ->orWhere('diagnosadokter', 'like', "%$this->search%")
                ->orWhereHas('pasien', function($query){
                    $query->where('namapasien', 'like', "%$this->search%");
                })
                ->orWhereHas('dokter', function($query){
                    $query->where('namadokter', 'like', "%$this->search%");
                });
            })->orderBy('idrekammedik', 'asc')
            ->paginate($this->paging);
        }else{
            $rekams = Rekammedik::orderBy('idrekammedik', 'asc')->paginate($this->paging);
        }
        $pasiens = Pasien::orderBy('namapasien', 'asc')->get();
        $dokters = Dokter::orderBy('namadokter', 'asc')->get();
        return view('livewire.rekammedik.rekammediks', compact('rekams','pasiens', 'dokters'));
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
        $this->idrekammedik = '';
        $this->pasien_id = '';
        $this->dokter_id = '';
        $this->tanggalberobat = '';
        $this->diagnosadokter = '';
    }

    public function store()
    {
        $validatedData = $this->validate([
            'idrekammedik' => 'required',
            'pasien_id' => 'required',
            'dokter_id' => 'required',
            'tanggalberobat' => 'required',
            'diagnosadokter' => 'required'
        ]);

        Rekammedik::create($validatedData);

        session()->flash('message', $this->idrekammedik. ' Created');
        $this->resetFields();
        $this->closeModal();
    }

    public function edit($id)
    {
        $this->openModal();
        $rekammedik = Rekammedik::findOrFail($id);
        $this->id_rekammedik = $id;
        $this->idrekammedik = $rekammedik->idrekammedik;
        $this->pasien_id = $rekammedik->pasien_id;
        $this->dokter_id = $rekammedik->dokter_id;
        $this->tanggalberobat = $rekammedik->tanggalberobat;
        $this->diagnosadokter = $rekammedik->diagnosadokter;
    }

    public function update()
    {
        $this->validate([
            'pasien_id' => 'required',
            'dokter_id' => 'required',
            'tanggalberobat' => 'required',
            'diagnosadokter' => 'required'
        ]);
        if($this->id_rekammedik){
            $rekammedik = Rekammedik::find($this->id_rekammedik);
            $rekammedik->update([
                'pasien_id' => $this->pasien_id,
                'dokter_id' => $this->dokter_id,
                'tanggalberobat' => $this->tanggalberobat,
                'diagnosadokter' => $this->diagnosadokter
            ]);
            session()->flash('message', $this->id_rekammedik . ' Updated');
            $this->resetFields();
            $this->closeModal();
        }
    }

    public function delete($id)
    {
        $rekammedik = Rekammedik::find($id);
        $rekammedik->delete();
        session()->flash('message', $rekammedik->idrekammedik . ' Dihapus');
    }
}
