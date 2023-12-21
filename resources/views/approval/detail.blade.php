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
            <p class="dark:text-gray-400">{{ $list->LoansUser->name }} </p>
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <p class="dark:text-gray-400">{{ $list->LoansUser->email }} </p>
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Loan Amount -->
        <div class="mt-4">
            <x-input-label for="amount" :value="__('Loan Amount')" />
            <p class="dark:text-gray-400">{{ $list->loan_amount }} </p>
            <x-input-error :messages="$errors->get('amount')" class="mt-2" />
        </div>

        <!-- Loan Term -->
        <div class="mt-4">
            <x-input-label for="term" :value="__('Loan Term')" />
            <p class="dark:text-gray-400">{{ $list->loan_term }} </p>
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