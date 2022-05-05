<script setup>
import { usePage } from "@inertiajs/inertia-vue3";
import { computed, ref, watch } from "vue";

const flash = computed(() => usePage().props.value.flash);

const icon = ref(""),
    color = ref(""),
    title = ref(""),
    show = ref(false);

watch(flash, (newFlash, _) => {
    switch (newFlash.type) {
        case "success":
            icon.value = "check-circle";
            color.value = "text-green-600";
            title.value = "Success";
            break;
        case "error":
            icon.value = "xmark-circle";
            color.value = "text-red-600";
            title.value = "Error";
            break;
        case "warning":
            icon.value = "exclamation-circle";
            color.value = "text-orange-600";
            title.value = "Warning";
            break;
        case "info":
        default:
            icon.value = "info-circle";
            color.value = "text-blue-600";
            title.value = "Info";
            break;
    }

    if (
        !show.value &&
        newFlash.message !== null &&
        newFlash.message !== undefined
    ) {
        show.value = true;
        setTimeout(() => {
            show.value = false;
        }, 5000);
    }
});
</script>

<template>
    <div class="absolute top-8 right-10 z-10" v-if="show">
        <div class="m-auto">
            <div
                class="bg-white rounded-lg border-gray-300 border p-3 shadow-lg"
            >
                <div class="flex flex-row">
                    <div :class="['px-2', color]">
                        <font-awesome-icon :icon="icon" class="big" />
                    </div>
                    <div class="ml-2 mr-6">
                        <span class="font-semibold">{{ title }}</span>
                    </div>
                    <div class="mr-6">
                        <span class="block text-gray-500">{{
                            flash.message
                        }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
