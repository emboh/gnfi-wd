<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit
        </h2>
    </x-slot>

    <div class="content relative py-12">
        <div class="overflow-x-auto max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                <div class="w-full mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">

                    <form method="POST" action="{{ route('admin.redeems.destroy', ['redeem' => $redeem]) }}">
                        @method('DELETE')
                        @csrf

                        <div class="flex items-center justify-end mt-4">
                            <x-button class="ml-3">
                                {{ __('Delete') }}
                            </x-button>
                        </div>
                    </form>

                    <x-auth-validation-errors class="mb-4" :errors="$errors" />

                    <form method="POST" action="{{ route('admin.redeems.update', ['redeem' => $redeem]) }}">
                        @method('PATCH')
                        @csrf

                        <div>
                            <x-label for="reward_id" :value="__('Reward')" />

                            <select name="reward_id" id="reward_id" class="block mt-1 w-full">
                                <option value="">== Choose Reward ==</option>
                                @foreach ($rewards as $reward)
                                    <option value="{{ $reward->id }}" {{ $redeem->reward_id == $reward->id ? 'selected' : ''}}>{{ $reward->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <x-label for="member_id" :value="__('Member')" />

                            <select name="member_id" id="member_id" class="block mt-1 w-full">
                                <option value="">== Choose Member ==</option>
                                @foreach ($users as $member)
                                    <option value="{{ $member->id }}" {{ $redeem->member_id == $member->id ? 'selected' : ''}}>{{ $member->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <x-label for="points_spent" :value="__('Points Spent')" />

                            <x-input id="points_spent" class="block mt-1 w-full" type="number" name="points_spent" :value="$redeem->points_spent" required />
                        </div>

                        <div class="block mt-4">
                            <label for="is_approved" class="inline-flex items-center">
                                <input 
                                    id="is_approved" 
                                    type="checkbox" 
                                    class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" 
                                    name="is_approved"
                                    value="1"
                                    {{ $redeem->is_approved == '1' ? 'checked' : '' }}
                                >
                                <span class="ml-2 text-sm text-gray-600">{{ __('Is Approved') }}</span>
                            </label>
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('admin.redeems.index') }}">
                                {{ __('Back') }}
                            </a>

                            <x-button class="ml-3">
                                {{ __('Submit') }}
                            </x-button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
