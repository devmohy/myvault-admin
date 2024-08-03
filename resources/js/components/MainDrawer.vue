<template>
  <div class="max-w-2xl p-4 mx-auto">
    <div :id="drawerId" class="fixed z-40 h-screen p-4 overflow-y-auto bg-white w-80 dark:bg-gray-800" tabindex="-1" :aria-labelledby="drawerLabelId">
      <slot name="header">
        <h5 :id="drawerLabelId" class="inline-flex items-center mb-4 text-base font-semibold text-gray-500 dark:text-gray-400"><svg class="w-5 h-5 mr-2" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>Info</h5>
      </slot>
      <button :id="drawerHideButtonId" type="button" :aria-controls="drawerId" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 absolute top-2.5 right-2.5 inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" >
        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
        <span class="sr-only">Close menu</span>
      </button>
      <slot></slot>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted, defineProps } from 'vue'
import { Drawer } from 'flowbite'

const props = defineProps({
  drawerId: String,
  drawerLabelId: String,
  drawerHideButtonId: String
});

const isOpen = ref(false);

const openDrawer = () => isOpen.value = true;
const closeDrawer = () => isOpen.value = false;

onMounted(() => {
  const $targetEl = document.getElementById(props.drawerId);
  const $drawerHideButton = document.getElementById(props.drawerHideButtonId);

  const options = {
    placement: 'right',
    backdrop: true,
    bodyScrolling: false,
    edge: false,
    edgeOffset: '',
    backdropClasses: 'bg-gray-900 bg-opacity-50 dark:bg-opacity-80 fixed inset-0 z-30',
    onHide: () => {
      console.log('drawer is hidden');
      closeDrawer();
    },
    onShow: () => {
      console.log('drawer is shown');
      openDrawer();
    },
    onToggle: () => {
      console.log('drawer has been toggled');
    }
  };

  if ($targetEl) {
    const drawer = new Drawer($targetEl, options);

    $drawerHideButton.addEventListener('click', () => {
      drawer.hide();
    })
  }
});
</script>