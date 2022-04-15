<script setup>
// const { message, type } = $page.props.flash;
const message = "asdsada";
const type = "success";

let icon, color, title;

switch (type) {
    case "success":
        icon = "check-circle";
        color = "text-green-600";
        title = "Success";
        break;
    case "error":
        icon = "times";
        color = "red";
        title = "Error";
        break;
    case "warning":
        icon = "exclamation-triangle";
        color = "orange";
        title = "Warning";
        break;
    case "info":
        icon = "info-circle";
        color = "blue";
        title = "Info";
        break;
    default:
        icon = "info-circle";
        color = "blue";
        title = "Info";
        break;
}
</script>

<template>
    <div class="absolute top-8 right-10 z-10">
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
                        <span class="block text-gray-500">{{ message }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
