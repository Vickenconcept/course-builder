<button {{ $attributes->merge(['type' => 'button', 'class' => ' items-center  text-blue-50 px-3 border border-blue-800 text-center  rounded bg-blue-800 hover:shadow-lg transition duration-300 py-2 text-xs font-semibold   disabled:opacity-25  ease-in-out']) }}>
    {{ $slot }}
</button>

