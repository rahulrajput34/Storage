<script lang="ts" setup>
// Imports
import Modal from "@/Components/Modal.vue";
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import InputError from "@/Components/InputError.vue";
import { useForm } from "@inertiajs/vue3";
import SecondaryButton from "../SecondaryButton.vue";
import PrimaryButton from "../PrimaryButton.vue";
import { nextTick, ref } from "vue";

// Uses
const form = useForm({
  name: "",
});

// Refs
const folderNameInput = ref(null);

// Props $ Emit
const props = defineProps<{
  modelValue: boolean;
}>();

const emit = defineEmits(["update:modelValue"]);

// Computed

// Methods
function onShow() {
  nextTick(() => folderNameInput.value.focus());
}

const createFolder = () => {
  form.post(route("folder.create"), {
    preserveScroll: true,
    onSuccess: () => {
      closeModal();
      form.reset();
      // TODO: success notification
    },
    onError: () => folderNameInput.value.focus(),
  });
};

const closeModal = () => {
  emit("update:modelValue");
  form.clearErrors();
  form.reset();
};

// Hooks
</script>

<template>
  <Modal :show="modelValue" @show="onShow" max-width="sm">
    <div class="p-6">
      <h2 class="text-lg font-medium text-gray-900">Create new Folder</h2>
      <div class="mt-6">
        <InputLabel for="folderName" value="Folder Name" class="sr-only" />
        <TextInput
          type="text"
          id="folderName"
          ref="folderNameInput"
          v-model="form.name"
          class="mt-1 block w-full"
          :class="
            form.errors.name
              ? 'border-red-500 focus:border-red-500 focus:ring-red-500'
              : ''
          "
          placeholder="Folder Name"
          @keyup.enter="createFolder"
        />
        <InputError :message="form.errors.name" class="mt-2" />
      </div>
      <div class="mt-6 flex justify-end">
        <SecondaryButton @click="closeModal">Cancel</SecondaryButton>
        <PrimaryButton
          class="ml-3"
          :class="{ 'opacity-25': form.processing }"
          @click="createFolder"
          :disable="form.processing"
        >
          Submit
        </PrimaryButton>
      </div>
    </div>
  </Modal>
</template>
