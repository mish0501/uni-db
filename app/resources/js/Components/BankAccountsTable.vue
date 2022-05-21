<script setup>
import { Link } from "@inertiajs/inertia-vue3";

const { bankAccounts, fromClient } = defineProps({
    bankAccounts: {
        type: Array,
        default: () => [],
    },
    fromClient: {
        type: Boolean,
        default: false,
    },
});
</script>

<template>
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table
            class="w-full text-sm text-left text-gray-500 dark:text-gray-400"
        >
            <thead
                class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400"
            >
                <tr>
                    <th scope="col" class="px-6 py-3 text-center">
                        Номер на банкова сметка
                    </th>
                    <th scope="col" class="px-6 py-3 text-center">Сума</th>
                    <th scope="col" class="px-6 py-3 text-center">
                        Лихвен процент
                    </th>
                    <th
                        scope="col"
                        class="px-6 py-3 text-center"
                        v-if="!fromClient"
                    >
                        Име на клиента
                    </th>
                    <th scope="col" class="px-6 py-3 text-center">Операции</th>
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
                        <Link
                            :href="route('bankAccounts.show', bankAccount.id)"
                            class="underline"
                        >
                            {{ bankAccount.account_number }}
                        </Link>
                    </td>
                    <td class="px-6 py-4 text-center">
                        {{ bankAccount.cash }}
                    </td>
                    <td class="px-6 py-4 text-center">
                        {{ bankAccount.interest_percentage }}%
                    </td>
                    <td class="px-6 py-4 text-center" v-if="!fromClient">
                        {{ bankAccount.client.user.name }}
                    </td>
                    <td class="px-6 py-4 flex justify-center gap-2">
                        <Link
                            :href="route('bankAccounts.edit', bankAccount.id)"
                            as="button"
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold rounded py-2 px-3"
                        >
                            <font-awesome-icon icon="pen" />
                            Редактирай
                        </Link>
                        <Link
                            :href="
                                route('bankAccounts.destroy', bankAccount.id)
                            "
                            method="delete"
                            as="button"
                            class="bg-red-500 hover:bg-red-700 text-white font-bold rounded py-2 px-3"
                        >
                            <font-awesome-icon icon="trash-can" />
                            Изтрий
                        </Link>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>
