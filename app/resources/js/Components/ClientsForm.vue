<script setup>
import { useForm } from "@inertiajs/inertia-vue3";
import { defineProps } from "vue";

const { client, url, action } = defineProps({
    client: {
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
});

const form = useForm({
    email: null,
    password: null,
    password_confirmation: null,
    first_name: null,
    last_name: null,
    phone: null,
    pid: null,
    address: null,
});

if (client.user) {
    const userNames = client.user.name.split(" ");

    form.defaults({
        email: client.user.email,
        first_name: userNames[0],
        last_name: userNames[userNames.length - 1],
        phone: client.user.phone,
        pid: client.user.PID,
        address: client.user.address,
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
    if (client.user) {
        form.transform((data) => {
            if (!data.password && !data.password_confirmation) {
                delete data.password;
            }

            return data;
        });
    }
    form.submit(method, url);
}
</script>

<template>
    <form @submit.prevent="onSubmit">
        <div class="relative z-0 mb-6 w-full group">
            <input
                type="email"
                name="floating_email"
                class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                placeholder=" "
                v-model="form.email"
            />
            <label
                for="floating_email"
                class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-8 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-8"
                >Емейл</label
            >
            <span
                class="flex items-center font-medium tracking-wide text-red-500 text-xs mt-1"
                v-if="form.errors.email"
            >
                {{ form.errors.email }}
            </span>
        </div>
        <div class="relative z-0 mb-6 w-full group">
            <input
                type="password"
                name="floating_password"
                id="floating_password"
                class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                placeholder=" "
                v-model="form.password"
            />
            <label
                for="floating_password"
                class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-8 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-8"
                >Парола</label
            >
            <span
                class="flex items-center font-medium tracking-wide text-red-500 text-xs mt-1"
                v-if="form.errors.password"
            >
                {{ form.errors.password }}
            </span>
        </div>
        <div class="relative z-0 mb-6 w-full group">
            <input
                type="password"
                name="repeat_password"
                id="floating_repeat_password"
                class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                placeholder=" "
                v-model="form.password_confirmation"
            />
            <label
                for="floating_repeat_password"
                class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-8 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-8"
                >Потвърди парола</label
            >
            <span
                class="flex items-center font-medium tracking-wide text-red-500 text-xs mt-1"
                v-if="form.errors.password_confirmation"
            >
                {{ form.errors.password_confirmation }}
            </span>
        </div>
        <div class="grid xl:grid-cols-2 xl:gap-6">
            <div class="relative z-0 mb-6 w-full group">
                <input
                    type="text"
                    name="floating_first_name"
                    id="floating_first_name"
                    class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                    placeholder=" "
                    v-model="form.first_name"
                />
                <label
                    for="floating_first_name"
                    class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-8 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-8"
                    >Име</label
                >
                <span
                    class="flex items-center font-medium tracking-wide text-red-500 text-xs mt-1"
                    v-if="form.errors.first_name"
                >
                    {{ form.errors.first_name }}
                </span>
            </div>
            <div class="relative z-0 mb-6 w-full group">
                <input
                    type="text"
                    name="floating_last_name"
                    id="floating_last_name"
                    class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                    placeholder=" "
                    v-model="form.last_name"
                />
                <label
                    for="floating_last_name"
                    class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-8 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-8"
                    >Фамилия</label
                >
                <span
                    class="flex items-center font-medium tracking-wide text-red-500 text-xs mt-1"
                    v-if="form.errors.last_name"
                >
                    {{ form.errors.last_name }}
                </span>
            </div>
        </div>
        <div class="grid xl:grid-cols-2 xl:gap-6">
            <div class="relative z-0 mb-6 w-full group">
                <input
                    type="tel"
                    name="floating_phone"
                    id="floating_phone"
                    class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                    placeholder=" "
                    v-model="form.phone"
                />
                <label
                    for="floating_phone"
                    class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-8 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-8"
                    >Телефон (+359 89 888 8888)</label
                >
                <span
                    class="flex items-center font-medium tracking-wide text-red-500 text-xs mt-1"
                    v-if="form.errors.phone"
                >
                    {{ form.errors.phone }}
                </span>
            </div>
            <div class="relative z-0 mb-6 w-full group">
                <input
                    type="text"
                    name="floating_pid"
                    id="floating_pid"
                    class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                    placeholder=" "
                    v-model="form.pid"
                />
                <label
                    for="floating_pid"
                    class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-8 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-8"
                    >ЕГН</label
                >
                <span
                    class="flex items-center font-medium tracking-wide text-red-500 text-xs mt-1"
                    v-if="form.errors.pid"
                >
                    {{ form.errors.pid }}
                </span>
            </div>
        </div>
        <div class="relative z-0 mb-6 w-full group">
            <input
                type="text"
                name="address"
                id="floating_address"
                class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                placeholder=" "
                v-model="form.address"
            />
            <label
                for="floating_address"
                class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-8 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-8"
                >Адрес</label
            >
            <span
                class="flex items-center font-medium tracking-wide text-red-500 text-xs mt-1"
                v-if="form.errors.address"
            >
                {{ form.errors.address }}
            </span>
        </div>
        <button
            type="submit"
            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
            :disabled="form.processing"
        >
            Submit
        </button>
    </form>
</template>
