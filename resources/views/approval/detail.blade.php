<x-app-layout>
    <div style='width:35%;margin:auto;padding-top:25px;'>
    <h2 class="dark:text-gray-400">Loans Detail</h2>
    <br/>
    <form method="POST" action="{{ route('approveloans') }}">
        @csrf
        <x-text-input id="loan_id" type="hidden" name="id" value="{{ $list['id'] }}"></x-text-input>

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="Name" value="{{ $list->LoansUser->name }}" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" value="{{ $list->LoansUser->email }}" required />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Loan Amount -->
        <div class="mt-4">
            <x-input-label for="amount" :value="__('Loan Amount')" />
            <x-text-input id="amount" class="block mt-1 w-full" type="text" name="amount" value="Rp. {{ $list->loan_amount }}" required />
            <x-input-error :messages="$errors->get('amount')" class="mt-2" />
        </div>

        <!-- Loan Term -->
        <div class="mt-4">
            <x-input-label for="term" :value="__('Loan Term')" />
            <x-text-input id="term" class="block mt-1 w-full" type="text" name="term" value="{{ $list->loan_term }} Weeks" required />
            <x-input-error :messages="$errors->get('term')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button class="ml-4">
                {{ __('Approve') }}
            </x-primary-button>
        </div>
    </form>
</div>
</x-app-layout>

<script>
    $('#gender option[value={{$list->gender}}').attr('selected','selected');
</script>