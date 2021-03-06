@props(['active'])

@php
$classes = ($active ?? false)
            // ? 'inline-flex items-center px-1 pt-1 font-medium leading-5 text-gray-500 hover:text-purple-900 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out'
            ?'text-indigo-500 cursor-pointer p-3 m-2 rounded  inline-flex items-center border border-indigo-700 text-base font-medium leading-5  focus:outline-none hover:border-indigo-700 transition duration-150 ease-in-out'
            :'text-slate-900 cursor-pointer p-3 m-2 rounded  inline-flex items-center border border-grey-700 text-base font-medium leading-5 text-gray-900 focus:outline-none hover:border-indigo-700 transition duration-150 ease-in-out'; 
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
