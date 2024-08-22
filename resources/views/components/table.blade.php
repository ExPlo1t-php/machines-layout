    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 border-l-2" id={{$id}}>
        <caption class=" text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">{{$caption}}</caption>
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                @foreach($headers as $header)
                    <th scope="col" class="px-6 py-3">
                        {{ $header }}
                    </th>
                @endforeach
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>