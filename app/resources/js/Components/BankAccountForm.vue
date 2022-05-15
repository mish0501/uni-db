<script setup>
import { useForm } from "@inertiajs/inertia-vue3";
import { defineProps } from "vue";

const { bankAccount, url, action, clients, currencyTypes } = defineProps({
    bankAccount: {
        type: Object,
        default: () => ({}),
    },
    url: {
        type: String,
        default: "",
        required: true,
    },
    action: {
        type: String,
        default: "create",
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

const form = useForm({
    client_id: null,
    currency_type_id: null,
    interest_percentage: null,
});

if (bankAccount.client || bankAccount.currency_type) {
    form.defaults({
        client_id: bankAccount?.client?.id,
        currency_type_id: bankAccount?.currency_type?.id,
        interest_percentage: bankAccount?.interest_percentage,
    });

    form.reset();
}

let method;

switch (action) {
    case "create":
        method = "post";
        break;
    case "update":
        method = "put";
        break;
    default:
        method = "post";
        break;
}

function onSubmit() {
    form.submit(method, url);
}
</script>

<template>
    <form @submit.prevent="onSubmit">
        <div class="relative z-0 mb-6 w-full group">
            <select
                name="client_id"
                id="floating_client"
                class="block py-2.5 px-3 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                placeholder=" "
                v-model="form.client_id"
            >
                <option value="null">Изберете</option>
                <option
                    :value="client.id"
                    v-for="client in clients"
                    :key="client.id"
                >
                    {{ client.user.name }}
                </option>
            </select>
            <label
                for="floating_client"
                class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-8 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-8"
                >Клиент (име)</label
            >
            <span
                class="flex items-center font-medium tracking-wide text-red-500 text-xs mt-1"
                v-if="form.errors.client_id"
            >
                {{ form.errors.client_id }}
            </span>
        </div>
        <div class="relative z-0 mb-6 w-full group">
            <select
                name="currency_type_id"
                id="floating_currencyType"
                class="block py-2.5 px-3 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                placeholder=" "
                v-model="form.currency_type_id"
            >
                <option value="null">Изберете</option>
                <option
                    :value="currencyType.id"
                    v-for="currencyType in currencyTypes"
                    :key="currencyType.id"
                >
                    {{ currencyType.name }} ({{ currencyType.symbol }})
                </option>
            </select>
            <label
                for="floating_currencyType"
                class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-8 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-8"
                >Валута</label
            >
            <span
                class="flex items-center font-medium tracking-wide text-red-500 text-xs mt-1"
                v-if="form.errors.currency_type_id"
            >
                {{ form.errors.currency_type_id }}
            </span>
        </div>
        <div class="relative z-0 mb-6 w-full group">
            <input
                type="interest_percentage"
                name="floating_interestPercentage"
                class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                placeholder=" "
                v-model="form.interest_percentage"
            />
            <label
                for="floating_interestPercentage"
                class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-8 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-8"
                >Лихвен процент</label
            >
            <span
                class="flex items-center font-medium tracking-wide text-red-500 text-xs mt-1"
                v-if="form.errors.interest_percentage"
            >
                {{ form.errors.interest_percentage }}
            </span>
        </div>
        <button
            type="submit"
            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
            :disabled="form.processing"
        >
            Запази
        </button>
    </form>
</template>
