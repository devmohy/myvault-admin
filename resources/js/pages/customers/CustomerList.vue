<script setup>
import { onMounted, ref, watch } from "vue";
import CustomerListItem from "./CustomerListItem.vue";
import { Bootstrap5Pagination } from "laravel-vue-pagination";
import { useRouter, useRoute } from 'vue-router'
import { debounce } from 'lodash';
const router = useRouter()
const route = useRoute()

const users = ref({ data: [] });
const searchQuery = ref(null);
var requestOptions = {
    method: 'GET',
    redirect: 'follow'
};

const getUsers = (page = 1) => {
    axios.get(`/api/customers?page=${page}`,{
        params: {
            query: searchQuery.value
        }
    }).then((response) => {
        users.value = response.data;
    }).catch((error) => {
        console.log(error);
        if (error.response && error.response.status === 401) {
            router.push('/login')
        }
    })
};

watch(searchQuery, debounce(() => {
    getUsers();
}, 300));

onMounted(() => {
    getUsers();
});
</script>
<template lang="">
  <div>
    <div class="header bg-primary pb-6">
        <div class="container-fluid">
            <div class="header-body">
                <div class="row align-items-center py-4">
                    <div class="col-lg-6 col-7">
                        <h6 class="h2 text-white ml-2 p-0 mb-0">Customers</h6>
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
                            <h3 class="mb-0">All Customers</h3>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group mb-0">
                                <input v-model="searchQuery" class='form-control form-control-sm' type="text" name="search" id="" placeholder='Search users'>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <div>
                        <table class="table table-hover align-items-center">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">SN</th>
                                    <th scope="col">Registered Date</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Phone Number</th>
                                    <th scope="col">Savings Balance</th>
                                    <th scope="col">Wallet balance</th>
                                    <th scope="col">Savings Interest earned</th>
                                    <th scope="col">Status</th>
                                    <th scope="col" class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody class="list">
                               <CustomerListItem v-for="(user, index) in users.data" :key="user.id" :user=user :index=index />
                            </tbody>
                        </table>
                    </div>
                </div>
                
            </div>

            <Bootstrap5Pagination 
                            :data="users"
                            @pagination-change-page="getUsers"
            >
            <template #prev-nav>
        <button class="btn btn-outline-primary">Previous</button>
      </template>
      <template #next-nav>
        <button class="btn btn-outline-primary">Next</button>
      </template>
            </Bootstrap5Pagination>
        </div>
    </div>
    </div>
  </div>
</template>