<x-app-layout>
    <div class="container mx-auto flex-col items-center justify-center text-center px-2">
        <h2 class="text-center py-8 text-4xl">welcome to the layout</h2>
        <p class="w-auto m-auto">A quick and easy way to check the company's layout, <br> machines/stations placement or status, connected ports, switch cabinet placement .... etc</p>
    </div>

    @php
        $ip = '216.58.215.142';
        // $ip = '255.255.255.0';
        $ping = exec('ping -n 1 '.$ip, $output, $status);
        echo $status;
        print_r( $output);
    @endphp
</x-app-layout>