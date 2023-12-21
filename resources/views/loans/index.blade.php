<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-white leading-tight">
            {{ __('List of Loans') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 ">
            @if(Auth::user()->status == 'Normal')
            <x-nav-link class='dark:bg-gray-600 rounded-lg' :href="route('addloans')" :active="request()->routeIs('addloans')">
                {{ __('Apply for New Loans') }}
            </x-nav-link>
            @elseif(Auth::user()->status == 'Waiting')
            <x-nav-link class='dark:bg-gray-600 rounded-lg'>
                {{ __('Waiting for Approval') }}
            </x-nav-link>
            @else
            <x-nav-link class='dark:bg-gray-600 rounded-lg'>
                {{ __('Not Eligible for Apply') }}
            </x-nav-link>
            @endif
        </div>
        <br />

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-600 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                @if(session('message'))
                    <p class="dark:bg-gray-400 text-center rounded-lg">{{ session('message') }}</p>
                @endif
                <div class="ml-12 max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        <div class="mt-2 text-gray-600 dark:text-gray-400 text-sm">
                            <table id='listOrder' class="bg-white text-center dark:bg-gray-900 mx-auto max-w-4xl w-full sm:rounded-lg">
                                <thead class="dark:bg-gray-600">
                                    <tr role="row" >
                                        <th style="width: 20px;">No</th>
                                        <th>Apply Date</th>
                                        <th>Approve Date</th>
                                        <th>Loans Amount</th>
                                        <th>Loan Term</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                    $a=1
                                    @endphp
                                    @if(!(empty($list)))
                                    @foreach($list as $i=>$g)
                                    <tr>
                                        <td>{{$a++}}</td>
                                        <td>{{$g->created_at}}</td>
                                        <td>{{$g->approve_on}}</td>
                                        <td>Rp. {{$g->loan_amount}}</td>
                                        <td>{{$g->loan_term}} Weeks</td>
                                        <td>{{$g->status}}</td>
                                    </tr>
                                    @endforeach
                                    @else
                                    <tr>
                                        <td colspan="7" class="text-center">No Data</td>
                                    </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
