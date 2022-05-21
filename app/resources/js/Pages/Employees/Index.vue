<script setup>
import BreezeAuthenticatedLayout from "@/Layouts/Authenticated.vue";
import { Head, Link } from "@inertiajs/inertia-vue3";
import Search from "@/Components/Search.vue";
import { ref } from "vue";

const employees = ref([]);

const { employees: e } = defineProps({
    employees: {
        type: Array,
        default: () => [],
    },
});

employees.value = e;

const onSearch = (search) => {
    if (search || search === "") {
        employees.value = e.filter((employee) => {
            return (
                employee.user.name
                    .toLowerCase()
                    .includes(search.toLowerCase()) ||
                employee.user.email
                    .toLowerCase()
                    .includes(search.toLowerCase()) ||
                employee.user.phone
                    .toLowerCase()
                    .includes(search.toLowerCase()) ||
                employee.position.name
                    .toLowerCase()
                    .includes(search.toLowerCase())
            );
        });
    }
};
</script>

<template>
    <Head title="Служители" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Служители
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <div class="flex justify-between align-middle">
                            <Link
                                :href="route('employees.create')"
                                class="bg-emerald-500 hover:bg-emerald-700 text-white font-bold py-2 px-4 rounded my-3"
                                as="button"
                            >
                                <font-awesome-icon icon="plus" />
                                Добави
                            </Link>

                            <Search :onChange="onSearch" />
                        </div>

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
                                            Име
                                        </th>
                                        <th
                                            scope="col"
                                            class="px-6 py-3 text-center"
                                        >
                                            Емейл
                                        </th>
                                        <th
                                            scope="col"
                                            class="px-6 py-3 text-center"
                                        >
                                            Телефон
                                        </th>
                                        <th
                                            scope="col"
                                            class="px-6 py-3 text-center"
                                        >
                                            Позиция
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
                                        v-for="employee in employees"
                                        :key="employee.id"
                                    >
                                        <th
                                            scope="row"
                                            class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap text-center"
                                        >
                                            <Link
                                                :href="
                                                    route('employees.show', {
                                                        id: employee.id,
                                                    })
                                                "
                                                class="underline"
                                            >
                                                {{ employee.user.name }}
                                            </Link>
                                        </th>
                                        <td class="px-6 py-4 text-center">
                                            {{ employee.user.email }}
                                        </td>
                                        <td class="px-6 py-4 text-center">
                                            {{ employee.user.phone }}
                                        </td>
                                        <td class="px-6 py-4 text-center">
                                            {{ employee.position.name }}
                                        </td>
                                        <td
                                            class="px-6 py-4 flex justify-center gap-2"
                                        >
                                            <Link
                                                :href="
                                                    route(
                                                        'employees.edit',
                                                        employee.id
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
                                                        'employees.destroy',
                                                        employee.id
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
