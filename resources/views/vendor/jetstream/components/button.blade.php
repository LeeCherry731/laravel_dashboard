<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex bg-slate-800 items-center px-4 py-2 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest focus:outline-none  focus:ring disabled:opacity-25 transition']) }}>
    {{ $slot }}
</button>
