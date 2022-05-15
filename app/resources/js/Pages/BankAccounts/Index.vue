<script setup>
import BreezeAuthenticatedLayout from "@/Layouts/Authenticated.vue";
import { Head, Link } from "@inertiajs/inertia-vue3";

const { bankAccounts } = defineProps({
    bankAccounts: {
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
                    <div class="p-6 bg-white border-b border-gray-200">
                        <Link
                            :href="route('bankAccounts.create')"
                            class="bg-emerald-500 hover:bg-emerald-700 text-white font-bold py-2 px-4 rounded my-3"
                            as="button"
                        >
                            <font-awesome-icon icon="plus" />
                            Добави
                        </Link>

                        <div
                            class="relative overflow-x-auto shadow-md sm:rounded-lg"
                        >
                            <table
                                class="w-full text-sm text-left text-gray-500 dark:text-gray-400"
                            >
                                <thead
                                    class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400"
                                >
                                    <tr>
                                        <th
                                            scope="col"
                                            class="px-6 py-3 text-center"
                                        >
                                            Номер на банкова сметка
                                        </th>
                                        <th
                                            scope="col"
                                            class="px-6 py-3 text-center"
                                        >
                                            Сума
                                        </th>
                                        <th
                                            scope="col"
                                            class="px-6 py-3 text-center"
                                        >
                                            Лихвен процент
                                        </th>
                                        <th
                                            scope="col"
                                            class="px-6 py-3 text-center"
                                        >
                                            Име на клиента
                                        </th>
                                        <th
                                            scope="col"
                                            class="px-6 py-3 text-center"
                                        >
                                            Операции
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr
                                        class="bg-white border-b dark:bg-gray-800 dark:border-gray-700"
                                        v-for="bankAccount in bankAccounts"
                                        :key="bankAccount.id"
                                    >
                                        <td
                                            scope="row"
                                            class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap text-center"
                                        >
                                            {{ bankAccount.account_number }}
                                        </td>
                                        <td
                                            class="px-6 py-4 text-center"
                                            v-if="
                                                bankAccount.currency_type.id < 5
                                            "
                                        >
                                            {{
                                                bankAccount.currency_type.symbol
                                            }}
                                            {{ bankAccount.cash }}
                                        </td>
                                        <td
                                            class="px-6 py-4 text-center"
                                            v-else
                                        >
                                            {{ bankAccount.cash }}
                                            {{
                                                bankAccount.currency_type.symbol
                                            }}
                                        </td>
                                        <td class="px-6 py-4 text-center">
                                            {{
                                                bankAccount.interest_percentage
                                            }}%
                                        </td>
                                        <td class="px-6 py-4 text-center">
                                            {{ bankAccount.client.user.name }}
                                        </td>
                                        <td
                                            class="px-6 py-4 flex justify-center gap-2"
                                        >
                                            <Link
                                                :href="
                                                    route(
                                                        'bankAccounts.edit',
                                                        bankAccount.id
                                                    )
                                                "
                                                as="button"
                                                class="bg-blue-500 hover:bg-blue-700 text-white font-bold rounded py-2 px-3"
                                            >
                                                <font-awesome-icon icon="pen" />
                                                Редактирай
                                            </Link>
                                            <Link
                                                :href="
                                                    route(
                                                        'bankAccounts.destroy',
                                                        bankAccount.id
                                                    )
                                                "
                                                method="delete"
                                                as="button"
                                                class="bg-red-500 hover:bg-red-700 text-white font-bold rounded py-2 px-3"
                                            >
                                                <font-awesome-icon
                                                    icon="trash-can"
                                                />
                                                Изтрий
                                            </Link>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </BreezeAuthenticatedLayout>
</template>
