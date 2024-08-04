<script setup>
import { useAuthStore } from "@/stores/auth";
const user = useAuthStore().user;
</script>
<template>
  <div>
    <a-table
      :columns="columns"
      :row-key="(record) => record.id"
      :data-source="savings"
      :pagination="pagination"
      :loading="isLoading"
      @change="handleTableChange"
    >
    <template #bodyCell="{ column, text, record }">
        <template v-if="column.dataIndex === 'customer'">
          <router-link :to="'/customers/' + record?.id">{{ record.customer_name }}</router-link><br/>
          <span>{{ record.customer_email }}</span><br/>
          <span>{{ record.customer_phone_number }}</span>
        </template>
        <template v-if="column.dataIndex === 'status'">
          <a-tag color="processing" v-if="record.active">ACTIVE</a-tag>
          <a-tag color="red" v-else>IN ACTIVE</a-tag>
        </template>

      </template>
    </a-table>
  </div>
</template>
