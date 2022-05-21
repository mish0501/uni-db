<script setup>
import BreezeAuthenticatedLayout from "@/Layouts/Authenticated.vue";
import { Head, Link } from "@inertiajs/inertia-vue3";
import Search from "@/Components/Search.vue";
import { ref } from "vue";

const clients = ref([]);

const { clients: c } = defineProps({
    clients: {
        type: Array,
        default: () => [],
    },
});

clients.value = c;

const onSearch = (search) => {
    if (search || search === "") {
        clients.value = c.filter((client) => {
            return (
                client.user.name.toLowerCase().includes(search.toLowerCase()) ||
                client.user.email
                    .toLowerCase()
                    .includes(search.toLowerCase()) ||
                client.user.phone.toLowerCase().includes(search.toLowerCase())
            );
        });
    }
};
</script>

<template>
    <Head title="Клиенти" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Клиенти
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <div class="flex justify-between align-middle">
                            <Link
                                :href="route('clients.create')"
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
                                            Операции
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr
                                        class="bg-white border-b dark:bg-gray-800 dark:border-gray-700"
                                        v-for="client in clients"
                                        :key="client.id"
                                    >
                                        <th
                                            scope="row"
                                            class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap text-center"
                                        >
                                            <Link
                                                :href="
                                                    route(
                                                        'clients.show',
                                                        client.id
                                                    )
                                                "
                                                class="underline"
                                            >
                                                {{ client.user.name }}
                                            </Link>
                                        </th>
                                        <td class="px-6 py-4 text-center">
                                            {{ client.user.email }}
                                        </td>
                                        <td class="px-6 py-4 text-center">
                                            {{ client.user.phone }}
                                        </td>
                                        <td
                                            class="px-6 py-4 flex justify-center gap-2"
                                        >
                                            <Link
                                                :href="
                                                    route(
                                                        'clients.edit',
                                                        client.id
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
                                                        'clients.destroy',
                                                        client.id
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
