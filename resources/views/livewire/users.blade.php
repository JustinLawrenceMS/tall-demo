<div>
<div class="p-6 sm:px-20 bg-white border-b border-gray-400">
    <div>
	<x-jet-application-logo class="block h-12 w-auto" />
    </div>

    <div class="mt-8 text-2xl">
	<!-- This is where welcome to your jetstream application was -->
    </div>

<div class="flex flex-col items-center">

	<a 
		wire:click="create()" 
		href="#"
		class="
			flex
			items-center
			button
			primary
			large
		"

	>
		<i class="fas fa-plus fa-3x">
		</i>
	</a>

	<br>

	<p class="text-red-500">

		@if(session()->has('message'))

			{{session('message')}}

		@endif

	</p>

	<br>

	@if($isFormOpen)
		@include('livewire.create')
	@endif
        <div class="p-6 bg-gray-100">

	@if($isShowOpen)
		@include('livewire.show')
	@endif

		<table class="table hover striped">
			<thead>
				<tr>
					<th>User ID</th>
					<th>Username</th>
					<th>Email</th>
					<th>Telephone</th>
					<th>Edit/Delete</th>

				</tr>

			</thead>
			<tbody>

				@for($i=0; $i<count($user_data); $i++)
					<tr>
						<td>
							<a 
								wire:click="show( {{ $user_data[$i]->id }} )" 
								href="#"
								class="
									flex
									flex-cennter
									items-center
									button
									primary
								        large 
								"

							>
								<h4 class="text-xl">	
									{{ $user_data[$i]->id  }}
								</h4>


							</a>

					
						</td>
						<td>{{ $user_data[$i]->name }}</td>
						<td>{{ $user_data[$i]->email }}</td>
						<td>{{ $user_data[$i]->telephone }}</td>
						<td>	
							<button wire:click="edit({{ $user_data[$i]->id }})" class="button border border-white primary large">edit</button>
							<button wire:click="delete({{ $user_data[$i]->id }})" class="button border border-white bac-button-black large">delete</button>
						</td>

					</tr>
				@endfor						

			</tbody>
		</table>
       	   </div>
     </div>
</div>
</div>

