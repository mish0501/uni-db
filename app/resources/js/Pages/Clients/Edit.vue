<script setup>
import BreezeAuthenticatedLayout from "@/Layouts/Authenticated.vue";
import { Head } from "@inertiajs/inertia-vue3";
import ClientsForm from "@/Components/ClientsForm.vue";

const { client } = defineProps({
    client: {
        type: Object,
        default: () => ({}),
    },
});
</script>

<template>
    <Head title="Clients" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Клиенти
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 pt-9 bg-white border-b border-gray-200">
                        <ClientsForm
                            :url="route('clients.update', { id: client.id })"
                            :client="client"
                            action="update"
                        />
                    </div>
                </div>
            </div>
        </div>
    </BreezeAuthenticatedLayout>
</template>
