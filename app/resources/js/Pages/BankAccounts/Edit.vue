<script setup>
import BreezeAuthenticatedLayout from "@/Layouts/Authenticated.vue";
import { Head } from "@inertiajs/inertia-vue3";
import BankAccountForm from "@/Components/BankAccountForm.vue";

const { bankAccount, clients, currencyTypes } = defineProps({
    bankAccount: {
        type: Object,
        default: () => ({}),
    },
    clients: {
        type: Array,
        default: () => [],
    },
    currencyTypes: {
        type: Array,
        default: () => [],
    },
});
</script>

<template>
    <Head title="Банкови сметки" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Банкови сметки
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 pt-9 bg-white border-b border-gray-200">
                        <BankAccountForm
                            :url="
                                route('bankAccounts.update', {
                                    id: bankAccount.id,
                                })
                            "
                            :bankAccount="bankAccount"
                            action="update"
                            :clients="clients"
                            :currencyTypes="currencyTypes"
                        />
                    </div>
                </div>
            </div>
        </div>
    </BreezeAuthenticatedLayout>
</template>
