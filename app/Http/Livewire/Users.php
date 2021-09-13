<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class Users extends Component
{

	public $password;
	public $customer_details,
		$date_array;
	public $user_data,
		$name,
		$email,
		$telephone,
		$user_id;

	public $isFormOpen = 0;
	public $isShowOpen = 0;


	public function getPassword(){

		return $this->password;
	
	}

	public function setPassword(){

		/* TODO
		 *
		 * create logic that generates a random password
		 * and then leverage middleware to 
		 * prompt the user to change the password
		 * at first login.
		 *
		 */

		$this->password = Str::random(21);


	}

	public function render()
    
	{

		$this->user_data = User::whereNotNull('customer_details')->get();

		return view('livewire.users');
    
	}
	
	public function create()
    
	{

		$this->customer_details = [
			'admin' => false,
			'new_customer' => true,
			'browser' => '',
			'point-of-sale' => '',
			'spend' => [

				'new_customer' => null 
			
			],
			'cardDetails' => [

				'name' => '',
				'type' => '',

				'number' => '',
				'expirationDate' => ''


			]
		];


		$this->setPassword();

		$this->resetCreateForm();

		$this->openForm();
    
	}

    
	public function openForm()
    
	{
	
		$this->isFormOpen = true;
    
	}

    
	public function closeForm()
    
	{
	
		$this->isFormOpen = false;
       
	}

	public function openShow(){

		$this->isShowOpen = true;

	}

	public function closeShow(){
	

		$this->isShowOpen = false;

	
	}
    
	private function resetCreateForm(){


		$this->user_crud = null;
			
		$this->name = '';
		
		$this->email = '';
		
		$this->telephone = '';
	
	}

	public function show($id){

		$this->openShow();

		$this->customer_details = User::find($id)->customer_details;

		$this->date_array = array_keys($this->customer_details['spend']);

	}
	
	public function store()
	
	{
		
		$this->validate([
			
			'name' => 'required',
			
			'email' => 'required',
			
			'telephone' => 'required',
		
		]);
    
		$password = $this->getPassword();


		User::updateOrCreate(['id' => $this->user_id], [
		    
			'name' => $this->name,
			
			'email' => $this->email,
			
			'telephone' => $this->telephone,

			'password' => $password,

			'customer_details' => $this->customer_details,
		
		]);

		
		session()->flash('message', $this->user_id ? 'User updated.' : 'User created.');

	
		$this->closeForm();
		
		$this->resetCreateForm();
    }

    
	public function edit($id)
    
	{
	
		$user_data = User::findOrFail($id);
	


		$this->user_id = $user_data->id;
	
		$this->name = $user_data->name;
		
		$this->email = $user_data->email;
	
		$this->telephone = $user_data->telephone;

		$this->password = $user_data->password;

		$this->customer_details = $user_data->customer_details;

		$this->openForm();
	
	}
    
	
	public function delete($id)
	
	{
		
		User::find($id)->delete();
		
		session()->flash('message', 'User deleted.');
	
	}

}
