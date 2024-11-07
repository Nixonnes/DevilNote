<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2 bg-white text-black border-2 border-solid border-black rounded-md font-bold text-xs  uppercase tracking-widest hover:bg-amber-500  focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 dark:bg-black dark:text-white dark:border-white']) }}>
    {{ $slot }}
</button>
