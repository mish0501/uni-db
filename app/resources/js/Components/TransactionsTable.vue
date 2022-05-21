<script setup>
import { Link } from "@inertiajs/inertia-vue3";

const { transactions } = defineProps({
    transactions: {
        type: Array,
        default: () => [],
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
                    <th scope="col" class="px-6 py-3 text-center">Номер</th>
                    <th scope="col" class="px-6 py-3 text-center">Тип</th>
                    <th scope="col" class="px-6 py-3 text-center">Сума</th>
                    <th scope="col" class="px-6 py-3 text-center">Служител</th>
                </tr>
            </thead>
            <tbody>
                <tr
                    class="bg-white border-b dark:bg-gray-800 dark:border-gray-700"
                    v-for="transaction in transactions"
                    :key="transaction.id"
                >
                    <td
                        scope="row"
                        class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap text-center"
                    >
                        {{ transaction.id }}
                    </td>
                    <td class="px-6 py-4 text-center">
                        {{ transaction.transaction_type.name }}
                    </td>
                    <td class="px-6 py-4 text-center">
                        {{ transaction.value }}
                    </td>
                    <td class="px-6 py-4 text-center">
                        <Link
                            :href="
                                route('employees.show', transaction.employee.id)
                            "
                            class="underline"
                        >
                            {{ transaction.employee.user.name }}
                        </Link>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>
