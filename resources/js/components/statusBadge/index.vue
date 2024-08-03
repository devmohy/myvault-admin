<script setup>
import { ref } from "vue";

const props = defineProps({
    status: String,
});

let mainColor = "";
let borderColor = "";
let textColor = "";
let showDot = true

switch (props.status) {
    case "pending":
    case "no":
        mainColor = "bg-[#FFFAEB] border border-[#FEDF89]";
        borderColor = "bg-[#FEDF89]";
        textColor = "text-[#B54708]";
        break;
    case "paid":
    case "successful":
    case 'active':
    case 'Active':
    case 'submitted':
    case "Approved":
    case "yes":
        mainColor = "bg-[#ECFDF3] border border-[#ABEFC6]";
        borderColor = "bg-[#17B26A]";
        textColor = "text-[#067647]";
        break;
    case "running":
        mainColor = "bg-[#F0F9FF] border border-[#B9E6FE]";
        borderColor = "bg-[#0BA5EC]";
        textColor = "text-[#026AA2]";
        break;
    case "approved":
    case "approved by MFB":
    case "disbursed":
        mainColor = "bg-[#F4F3FF] border border-[#D9D6FE]";
        borderColor = "bg-[#7A5AF8]";
        textColor = "text-[#5925DC]";
        break;
    case "rejected":
    case "rejected by MFB":
    case "failed":
        mainColor = "bg-[#FEF3F2] border border-[#FECDCA]";
        borderColor = "bg-[#F04438]";
        textColor = "text-[#B42318]";
        break;
    case "inactive":
        mainColor = "bg-[#F9FAFB] border border-[#EAECF0]";
        borderColor = "bg-[#667085]";
        textColor = "text-[#344054]";
        break;
    default:
        mainColor = "bg-[#F9FAFB] border border-[#EAECF0]";
        borderColor = "bg-[#667085]";
        textColor = "text-[#344054]";
        showDot = false;
        // Handle other cases if needed
        break;
}
</script>

<template>
    <div
        class="inline-flex items-center text-sm font-medium me-2 px-2 py-1 rounded-full"
        :class="mainColor"
    >
        <div
            class="h-2.5 w-2.5 rounded-full me-2"
            v-if="showDot"
            :class="borderColor"
        >
        </div>
        <span
            class="text-xs font-medium me-2 px-0 py-0.5 rounded capitalize"
            :class="textColor"
        >{{ props.status }}</span>
    </div>
</template>