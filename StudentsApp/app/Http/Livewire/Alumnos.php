<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Alumno;

class Alumnos extends Component
{
    use WithPagination;

	protected $paginationTheme = 'bootstrap';
    public $selected_id, $keyWord, $code, $name, $address, $mobile, $email;
    public $updateMode = false;

    public function render()
    {
		$keyWord = '%'.$this->keyWord .'%';
        return view('livewire.alumnos.view', [
            'alumnos' => Alumno::latest()
						->orWhere('code', 'LIKE', $keyWord)
						->orWhere('name', 'LIKE', $keyWord)
						->orWhere('address', 'LIKE', $keyWord)
						->orWhere('mobile', 'LIKE', $keyWord)
						->orWhere('email', 'LIKE', $keyWord)
						->paginate(10),
        ]);
    }
	
    public function cancel()
    {
        $this->resetInput();
        $this->updateMode = false;
    }
	
    private function resetInput()
    {		
		$this->code = null;
		$this->name = null;
		$this->address = null;
		$this->mobile = null;
		$this->email = null;
    }

    public function store()
    {
        $this->validate([
		'code' => 'required',
		'name' => 'required',
		'address' => 'required',
		'mobile' => 'required',
		'email' => 'required',
        ]);

        Alumno::create([ 
			'code' => $this-> code,
			'name' => $this-> name,
			'address' => $this-> address,
			'mobile' => $this-> mobile,
			'email' => $this-> email
        ]);
        
        $this->resetInput();
		$this->emit('closeModal');
		session()->flash('message', 'Alumno Successfully created.');
    }

    public function edit($id)
    {
        $record = Alumno::findOrFail($id);

        $this->selected_id = $id; 
		$this->code = $record-> code;
		$this->name = $record-> name;
		$this->address = $record-> address;
		$this->mobile = $record-> mobile;
		$this->email = $record-> email;
		
        $this->updateMode = true;
    }

    public function update()
    {
        $this->validate([
		'code' => 'required',
		'name' => 'required',
		'address' => 'required',
		'mobile' => 'required',
		'email' => 'required',
        ]);

        if ($this->selected_id) {
			$record = Alumno::find($this->selected_id);
            $record->update([ 
			'code' => $this-> code,
			'name' => $this-> name,
			'address' => $this-> address,
			'mobile' => $this-> mobile,
			'email' => $this-> email
            ]);

            $this->resetInput();
            $this->updateMode = false;
			session()->flash('message', 'Alumno Successfully updated.');
        }
    }

    public function destroy($id)
    {
        if ($id) {
            $record = Alumno::where('id', $id);
            $record->delete();
        }
    }
}
