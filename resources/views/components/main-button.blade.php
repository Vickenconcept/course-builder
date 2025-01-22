<button {{ $attributes->merge(['type' => 'button', 'class' => ' items-center  text-white px-3 border border-[#39ac73] text-center  rounded bg-[#39ac73] hover:shadow-lg transition duration-300 py-2 text-xs font-semibold   disabled:opacity-25  ease-in-out']) }}>
    {{ $slot }}
</button>

