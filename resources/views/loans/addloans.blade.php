<x-app-layout>
    <div style='width:35%;margin:auto;padding-top:25px;'>
    <h2>New New Loans</h2>
    <br/>
    <form method="POST" action="{{ route('addloans') }}">
        @csrf
        

        <!-- Name -->
        <div>
            <x-input-label for="loan_amount" :value="__('Loan Amount')" />
            <select id="gender" class="block mt-1 w-full rounded-lg" name="loan_amount" required>
                <option value="100000">Rp. 100000</option>
                <option value="250000">Rp. 250000</option>
                <option value="500000">Rp. 500000</option>
                <option value="1000000">Rp. 1000000</option>
                <option value="2000000">Rp. 2000000</option>
            </select>
        </div>
        
        <div class="mt-4">
        <x-input-label for="loan_term" :value="__('Loan Term')" />
            <select id="gender" class="block mt-1 w-full rounded-lg" name="loan_term" required>
                <option value="2">2 Week</option>
                <option value="4">4 Week</option>
                <option value="6">6 Week</option>
                <option value="8">8 Week</option>
            </select>
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button class="ml-4">
                {{ __('Add') }}
            </x-primary-button>
        </div>
    </form>
</div>
</x-app-layout>