<script setup>
import { onMounted, ref } from "vue";
import TransactionListItem from "./TransactionListItem.vue";
import { Bootstrap4Pagination } from "laravel-vue-pagination";
const transactions = ref({ data: [] });

const getTransactions = (page = 1) => {
  axios.get(`/api/transactions?page=${page}`).then((response) => {
    transactions.value = response.data;
  });
};

onMounted(() => {
    getTransactions();
});
</script>
<template lang="">
  <div>
    <div class="header bg-primary pb-6">
        <div class="container-fluid">
            <div class="header-body">
                <div class="row align-items-center py-4">
                    <div class="col-lg-6 col-7">
                        <h6 class="h2 text-white ml-2 p-0 mb-0">Transactions</h6>
                    </div>
                    <div class="col-lg-6 col-5 text-right">
                    </div>
                    <div class="col-lg-12 col-12">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid mt--6">  
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header border-0">
                    <div class="row align-items-center">
                        <div class="col">
                            <h3 class="mb-0">All Transactions</h3>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <div>
                        <table class="table table-hover align-items-center">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">SN</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Reference</th>
                                    <th scope="col">Type</th>
                                    <th scope="col">Amount</th>
                                    <th scope="col">Customer</th>
                                    <th scope="col">Narration</th>
                                    <th scope="col">Status</th>
                                    <th scope="col" class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody class="list">
                               <TransactionListItem v-for="(transaction, index) in transactions.data" :key="transaction.id" :transaction=transaction :index=index />
                            </tbody>
                        </table>
                    </div>
                </div>
                
            </div>

            <Bootstrap4Pagination 
                            :data="transactions"
                            @pagination-change-page="getTransactions"
                        />
        </div>
    </div>
    </div>
  </div>
</template>