<div class="bg-white overflow-y-auto h-auto" style="padding: 3em; border: 3px solid black; z-index: 50 !important;">
    <div class="flex items-center">
        <div role="dialog" 
		aria-modal="true" 
		aria-labelledby="modal-headline">

		<button wire:click="closeShow()" 
				type="button"
				class="
					button
					large
					bac-button-black
					"
				>
				Exit 
		</button>
		<br>
		<br>
		<div>
			<table class="table-auto">
				<tr>

					<td> Point of Sale: {{ $customer_details['point-of-sale']  }}

					</td>

				</tr>

				<tr>

					<td> Browser: {{ $customer_details['browser'] }} </td>

				</tr>

				<tr>	
			
				<td> Card Details:<br>

						<tbody>

							<tr>

								<td>
									Card Name: {{ $customer_details['cardDetails']['name']  }}

								</td>

							</tr>

							<tr>

								<td>

									Card Type: {{ $customer_details['cardDetails']['type']  }}

								</td>

							</tr>

							<tr>

								<td>

									Card Number: {{  $customer_details['cardDetails']['number']   }}

								</td>

							</tr>

							<tr>

								<td>

									Expiration Date: {{ $customer_details['cardDetails']['expirationDate'] }}

								</td>

							</tr>

						</tbody>

					</td>	

				</tr>

			</table>
			
	
			<table class="alt">


				@for($i=0; $i<count($date_array); $i++)


					<tr>

						<td>
							<span class="text-black text-xl">
								Date:
						
							</span> 

							&nbsp;{{  $date_array[$i]  }} 

						</td>

						<td>


							<span class="text-black text-xl">
								Spend:
						
							</span> 

					
							&nbsp;${{ number_format($customer_details['spend'][$date_array[$i]], 3, '.', ',') }}</td>

					</tr>

					
					@endfor

			</table>

		</div>

	</div>
    </div>
</div>
