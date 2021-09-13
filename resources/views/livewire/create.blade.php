<div class="bg-white" style="padding: 3em; border: 3px solid black; position: fixed; z-index: 50 !important; overflow: none !important;">
    <div class="flex items-center">
        <div role="dialog" 
		aria-modal="true" 
		aria-labelledby="modal-headline">
            <form>
		    <label for="name"
			class="">Name</label>
		    <input type="text"
			class=""
			id="name" placeholder="Enter Name" wire:model="name">
		    @error('name') <span class="text-red-500">{{ $message }}</span>@enderror
		    <label for="email"
			class="">Email:</label>
		    <input
			type="email"
			class=""
			id="email" wire:model="email"
			placeholder="Enter Email">
		    @error('email') <span class="text-red-500">{{ $message }}</span>@enderror
		    <label for="telephone"
			class="">Telephone:</label>
		    <input
			type="text"
			class=""
			id="telephone" wire:model="telephone"
			placeholder="Enter Telephone">
			<br>
		    @error('telephone') <span class="text-red-500">{{ $message }}</span>@enderror
		<button 
			wire:click.prevent="store()" 
			type="button"
		    	class="
				button
				bac-button-black
			">
		    Save
		</button>
                    </span>
			<button 
			    wire:click="closeForm()" 
			    type="button"
			    class="
				button 
				primary
			">
                            Cancel
                        </button>
            </form>
        </div>
    </div>
</div>
