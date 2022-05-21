<script setup>
import BreezeAuthenticatedLayout from "@/Layouts/Authenticated.vue";
import { Head, Link } from "@inertiajs/inertia-vue3";
import BankAccountsTable from "@/Components/BankAccountsTable.vue";
import { ref } from "vue";
import Search from "@/Components/Search.vue";

const bankAccounts = ref([]);

const { bankAccounts: ba } = defineProps({
    bankAccounts: {
        type: Array,
        default: () => [],
    },
});

bankAccounts.value = ba;

const onSearch = (search) => {
    if (search || search === "") {
        bankAccounts.value = ba.filter((bankAccount) => {
            return (
                bankAccount.account_number
                    .toLowerCase()
                    .includes(search.toLowerCase()) ||
                bankAccount.client.user.name
                    .toLowerCase()
                    .includes(search.toLowerCase())
            );
        });
    }
};
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
                    <div class="p-6 bg-white border-b border-gray-200">
                        <div class="flex justify-between align-middle">
                            <Link
                                :href="route('bankAccounts.create')"
                                class="bg-emerald-500 hover:bg-emerald-700 text-white font-bold py-2 px-4 rounded my-3"
                                as="button"
                            >
                                <font-awesome-icon icon="plus" />
                                Добави
                            </Link>

                            <Search :onChange="onSearch" />
                        </div>

                        <BankAccountsTable :bankAccounts="bankAccounts" />
                    </div>
                </div>
            </div>
        </div>
    </BreezeAuthenticatedLayout>
</template>
