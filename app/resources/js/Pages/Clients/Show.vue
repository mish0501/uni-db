<script setup>
import BreezeAuthenticatedLayout from "@/Layouts/Authenticated.vue";
import { Head } from "@inertiajs/inertia-vue3";
import BankAccountsTable from "@/Components/BankAccountsTable.vue";

const { client } = defineProps({
    client: {
        type: Object,
        default: () => ({}),
    },
});

const userNames = client.user.name.split(" ");
const firstName = userNames[0];
const lastName = userNames[userNames.length - 1];
</script>

<template>
    <Head :title="client.user.name" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ client.user.name }}
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
                                        Име
                                    </div>
                                    <div class="px-4 py-2">{{ firstName }}</div>
                                </div>
                                <div class="grid grid-cols-2">
                                    <div class="px-4 py-2 font-semibold">
                                        Фамилия
                                    </div>
                                    <div class="px-4 py-2">{{ lastName }}</div>
                                </div>
                                <div class="grid grid-cols-2">
                                    <div class="px-4 py-2 font-semibold">
                                        Емейл
                                    </div>
                                    <div class="px-4 py-2">
                                        <a
                                            class="text-blue-800"
                                            :href="`mailto:${client.user.email}`"
                                            >{{ client.user.email }}</a
                                        >
                                    </div>
                                </div>
                                <div class="grid grid-cols-2">
                                    <div class="px-4 py-2 font-semibold">
                                        Телефон
                                    </div>
                                    <div class="px-4 py-2">
                                        {{ client.user.phone }}
                                    </div>
                                </div>
                                <div class="grid grid-cols-2">
                                    <div class="px-4 py-2 font-semibold">
                                        Адрес
                                    </div>
                                    <div class="px-4 py-2">
                                        {{ client.user.address }}
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
                            <font-awesome-icon icon="credit-card" />
                            <span class="tracking-wide">Сметки</span>
                        </div>

                        <BankAccountsTable
                            :bankAccounts="client.bank_accounts"
                            :fromClient="true"
                        />
                    </div>
                </div>
            </div>
        </div>
    </BreezeAuthenticatedLayout>
</template>
