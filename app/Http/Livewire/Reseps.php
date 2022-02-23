<?php

namespace App\Http\Livewire;

use DB;
use App\Models\Obat;
use App\Models\Resep;
use Livewire\Component;
use App\Models\Rekammedik;
use Livewire\WithPagination;

class Reseps extends Component
{
    public $search, $paging, $rekammedik_id, $obat_id, $tanggalresep, $dosis, $id_resep;
    public $isModal = 0;
    use WithPagination;

    public function mount()
    {
        $this->paging = 10;
    }

    public function render()
    {
        if($this->search){
            $reseps = Resep::with('rekammedik')
            ->where(function ($query){
                $query->where('idresep', 'like', "%$this->search%")
                ->orWhere('tanggalresep', 'like', "%$this->search%")
                // ->orWhere('namapasien', 'like', "%$this->search%")
                // ->orWhere('namadokter', 'like', "%$this->search%")
                // ->orWhere('diagnosadokter', 'like', "%$this->search%")
                // ->orWhere('namaobat', 'like', "%$this->search%")
                ->orWhere('dosis', 'like', "%$this->search%");
            })->orderBy('idresep', 'asc')->paginate($this->paging);
        }else{
            $reseps = Resep::orderBy('idresep', 'asc')->paginate($this->paging);
        }
        $rekams = Rekammedik::orderBy('idrekammedik', 'asc')->get();
        $obats = Obat::orderBy('idobat', 'asc')->get();
        return view('livewire.resep.reseps', compact('reseps','rekams', 'obats'));
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
        $this->idresep = '';
        $this->rekammedik_id = '';
        $this->obat_id = '';
        $this->tanggalresep = '';
        $this->dosis = '';
    }

    public function store()
    {
        $validatedData = $this->validate([
            'idresep' => 'required',
            'rekammedik_id' => 'required',
            'obat_id' => 'required',
            'tanggalresep' => 'required',
            'dosis' => 'required'
        ]);

        Resep::create($validatedData);

        session()->flash('message', $this->idresep. ' Created');
        $this->resetFields();
        $this->closeModal();
    }

    public function edit($id)
    {
        $this->openModal();
        $resep = Resep::findOrFail($id);
        $this->id_resep = $id;
        $this->idresep = $resep->idresep;
        $this->rekammedik_id = $resep->rekammedik_id;
        $this->obat_id = $resep->obat_id;
        $this->tanggalresep = $resep->tanggalresep;
        $this->dosis = $resep->dosis;
    }

    public function update()
    {
        $this->validate([
            'rekammedik_id' => 'required',
            'obat_id' => 'required',
            'tanggalresep' => 'required',
            'dosis' => 'required'
        ]);
        if($this->id_resep){
            $resep = Resep::find($this->id_resep);
            $resep->update([
                'rekammedik_id' => $this->rekammedik_id,
                'obat_id' => $this->obat_id,
                'tanggalresep' => $this->tanggalresep,
                'dosis' => $this->dosis
            ]);
            session()->flash('message', $this->id_resep . ' Updated');
            $this->resetFields();
            $this->closeModal();
        }
    }

    public function delete($id)
    {
        $resep = Resep::find($id);
        $resep->delete();
        session()->flash('message', $resep->idresep . ' Dihapus');
    }
}
