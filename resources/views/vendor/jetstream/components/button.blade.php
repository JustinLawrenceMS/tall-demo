<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2 rounded-md font-semibold tracking-widest button bac-button-black large transition']) }}>
    {{ $slot }}
</button>
