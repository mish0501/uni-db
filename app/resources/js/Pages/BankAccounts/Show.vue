<script setup>
import BreezeAuthenticatedLayout from "@/Layouts/Authenticated.vue";
import { Head, Link } from "@inertiajs/inertia-vue3";
import TransactionsTable from "@/Components/TransactionsTable.vue";

const { bankAccount } = defineProps({
    bankAccount: {
        type: Object,
        default: () => ({}),
    },
});
</script>

<template>
    <Head :title="bankAccount.account_number" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ bankAccount.account_number }}
            </h2>
        </template>

        <div class="py-12">
            <div
                class="max-w-7xl mx-auto sm:px-6 lg:px-8 flex flex-col justify-between gap-4"
            >
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <div
                            class="flex items-center space-x-2 font-semibold text-gray-900 leading-8 mb-4"
                        >
                            <font-awesome-icon icon="user" />
                            <span class="tracking-wide">Основни данни</span>
                        </div>
                        <div class="text-gray-700">
                            <div class="grid md:grid-cols-2 text-sm">
                                <div class="grid grid-cols-2">
                                    <div class="px-4 py-2 font-semibold">
                                        Номер на сметка
                                    </div>
                                    <div class="px-4 py-2">
                                        {{ bankAccount.account_number }}
                                    </div>
                                </div>
                                <div class="grid grid-cols-2">
                                    <div class="px-4 py-2 font-semibold">
                                        Клиент
                                    </div>
                                    <div class="px-4 py-2">
                                        <Link
                                            :href="
                                                route(
                                                    'clients.show',
                                                    bankAccount.client_id
                                                )
                                            "
                                            class="underline"
                                        >
                                            {{ bankAccount.client.user.name }}
                                        </Link>
                                    </div>
                                </div>
                                <div class="grid grid-cols-2">
                                    <div class="px-4 py-2 font-semibold">
                                        Лихвен процент
                                    </div>
                                    <div class="px-4 py-2">
                                        {{ bankAccount.interest_percentage }}%
                                    </div>
                                </div>
                                <div class="grid grid-cols-2">
                                    <div class="px-4 py-2 font-semibold">
                                        Сума
                                    </div>
                                    <div class="px-4 py-2">
                                        {{ bankAccount.cash }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <div
                            class="flex items-center space-x-2 font-semibold text-gray-900 leading-8 mb-4"
                        >
                            <font-awesome-icon icon="money-bill-transfer" />
                            <span class="tracking-wide">Транзакции</span>
                        </div>

                        <TransactionsTable
                            :transactions="bankAccount.transactions"
                        />
                    </div>
                </div>
            </div>
        </div>
    </BreezeAuthenticatedLayout>
</template>
