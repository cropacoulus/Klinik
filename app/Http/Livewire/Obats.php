<?php

namespace App\Http\Livewire;

use App\Models\Obat;
use Livewire\Component;
use Livewire\WithPagination;

class Obats extends Component
{
    public $search, $paging, $namaobat, $hargaobat, $keterangan, $stok, $id_obat;
    public $isModal = 0;
    use WithPagination;

    public function mount()
    {
        $this->paging = 10;
    }

    public function render()
    {
        if($this->search){
            $obats = Obat::where(function ($query){
                $query->where('namaobat', 'like', "%$this->search%")
                    ->orWhere('idobat', 'like', "%$this->search%")
                    ->orWhere('hargaobat', 'like', "%$this->search%")
                    ->orWhere('keterangan', 'like', "%$this->search%")
                    ->orWhere('stok', 'like', "%$this->search%");
            })->orderBy('idobat', 'asc')->paginate($this->paging);
        }else{
            $obats = Obat::orderBy('idobat', 'asc')->paginate($this->paging);
        }
        
        return view('livewire.obat.obats', compact('obats'));
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
        $this->idobat = '';
        $this->namaobat = '';
        $this->hargaobat = '';
        $this->keterangan = '';
        $this->stok = '';
    }

    public function store()
    {
        $validatedData = $this->validate([
            'idobat' => 'required',
            'namaobat' => 'required|string',
            'hargaobat' => 'required|numeric',
            'keterangan' => 'required',
            'stok' => 'required|numeric'
        ]);

        Obat::create($validatedData);

        session()->flash('message', $this->namaobat. ' Created');
        $this->resetFields();
        $this->closeModal();
    }

    public function edit($id)
    {
        $this->openModal();
        $obat = Obat::findOrFail($id);
        $this->id_obat = $id;
        $this->idobat = $obat->idobat;
        $this->namaobat = $obat->namaobat;
        $this->hargaobat = $obat->hargaobat;
        $this->keterangan = $obat->keterangan;
        $this->stok = $obat->stok;
    }

    public function update()
    {
        $this->validate([
            'namaobat' => 'required|string',
            'hargaobat' => 'required|numeric',
            'keterangan' => 'required',
            'stok' => 'required|numeric'
        ]);
        if($this->id_obat){
            $obat = Obat::find($this->id_obat);
            $obat->update([
                'namaobat' => $this->namaobat,
                'hargaobat' => $this->hargaobat,
                'keterangan' => $this->keterangan,
                'stok' => $this->stok
            ]);
            session()->flash('message', $this->namaobat . ' Updated');
            $this->resetFields();
            $this->closeModal();
        }
    }

    public function delete($id)
    {
        $obat = Obat::find($id);
        $obat->delete();
        session()->flash('message', $obat->namaobat . ' Dihapus');
    }
}
