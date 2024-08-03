<script setup>
const emit = defineEmits(["filter"]);
const props = defineProps({
  id: String,
  label: String,
  type: String,
  placeholder: String,
  inputClass: String,
});

const filter = (e) => {
  emit("search", e.target.value);
};
</script>
<template>
  <div>
    <button data-drawer-target="filter-drawer-right" data-drawer-show="filter-drawer-right"
                        data-drawer-placement="right" aria-controls="filter-drawer-right"
      class="inline-flex items-center text-gray-500 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 font-medium rounded-full text-sm px-4 py-3"
      type="button"
    >
      <svg
        class="mr-1"
        width="20"
        height="20"
        viewBox="0 0 20 20"
        fill="none"
        xmlns="http://www.w3.org/2000/svg"
      >
        <path
          d="M17.5032 6.66489H2.49695"
          stroke="#667085"
          stroke-width="1.5"
          stroke-linecap="round"
          stroke-linejoin="round"
        />
        <path
          d="M6.66535 10.8348H2.49695"
          stroke="#667085"
          stroke-width="1.5"
          stroke-linecap="round"
          stroke-linejoin="round"
        />
        <path
          d="M6.66535 15.0028H2.49695"
          stroke="#667085"
          stroke-width="1.5"
          stroke-linecap="round"
          stroke-linejoin="round"
        />
        <path
          d="M17.5032 2.49692H2.49695"
          stroke="#667085"
          stroke-width="1.5"
          stroke-linecap="round"
          stroke-linejoin="round"
        />
        <path
          fill-rule="evenodd"
          clip-rule="evenodd"
          d="M12.8346 14.6006V16.7615C12.8328 17.0191 12.9651 17.2591 13.1838 17.3952C13.4026 17.5313 13.6764 17.5439 13.9067 17.4284L15.0938 16.8348C15.3466 16.7089 15.5057 16.4502 15.504 16.1679V14.6006L17.2156 13.28C17.3966 13.1404 17.503 12.925 17.504 12.6964V11.5751C17.504 11.3784 17.4258 11.1898 17.2866 11.0508C17.1475 10.9118 16.9587 10.8338 16.762 10.834H11.5749C11.1656 10.834 10.8337 11.1658 10.8337 11.5751V12.6931C10.8349 12.9217 10.9413 13.137 11.1222 13.2767L12.8346 14.6006Z"
          stroke="#667085"
          stroke-width="1.5"
          stroke-linecap="round"
          stroke-linejoin="round"
        />
      </svg>
      Filter
    </button>
  </div>
</template>
