<script setup>
import BreezeAuthenticatedLayout from "@/Layouts/Authenticated.vue";
import { Head } from "@inertiajs/inertia-vue3";
import EmployeesForm from "@/Components/EmployeesForm.vue";

const { employee, positions } = defineProps({
    employee: {
        type: Object,
        default: () => ({}),
    },
    positions: {
        type: Array,
        default: () => [],
    },
});
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
                    <div class="p-6 pt-9 bg-white border-b border-gray-200">
                        <EmployeesForm
                            :url="
                                route('employees.update', { id: employee.id })
                            "
                            :employee="employee"
                            action="update"
                            :positions="positions"
                        />
                    </div>
                </div>
            </div>
        </div>
    </BreezeAuthenticatedLayout>
</template>
