<script setup>
import { ref, onMounted } from "vue";
import { useRouter, useRoute } from "vue-router";
import StatCard from "@/pages/dashboard/StatCard.vue";
import InvestmentListItem from "@/pages/investments/InvestmentListItem.vue";
import TransactionListItem from "@/pages/transactions/TransactionListItem.vue";
import { Bootstrap4Pagination } from "laravel-vue-pagination";

const router = useRouter();
const route = useRoute();
const customerId = ref(null);
const user = ref(null);
const transactions = ref({ data: [] });
const investments = ref({ data: [] });

const getUser = (id) => {
  axios
    .get(`/api/customers/${id}`)
    .then((response) => {
      user.value = response.data;
    })
    .catch((error) => {
      console.log(error);
      if (error.response && error.response.status === 401) {
        router.push("/login");
      }
    });
};


const getUserTransactions = (id) => {
  axios
    .get(`/api/transactions?user_id=${id}`)
    .then((response) => {
      transactions.value = response.data;
    })
    .catch((error) => {
      console.log(error);
      if (error.response && error.response.status === 401) {
        router.push("/login");
      }
    });
};
const getUserInvestments = (id) => {
  axios
    .get(`/api/investments?user_id=${id}`)
    .then((response) => {
      investments.value = response.data;
    })
    .catch((error) => {
      console.log(error);
      if (error.response && error.response.status === 401) {
        router.push("/login");
      }
    });
};

onMounted(async () => {
  await router.isReady();
  customerId.value = route.params.id;
  getUser(customerId.value);
  getUserTransactions(customerId.value);
  getUserInvestments(customerId.value);
});
</script>
<template>
  <div>
    <div class="header bg-primary pb-6">
      <div class="container-fluid">
        <div class="header-body">
          <div class="row align-items-center py-4">
            <div class="col-lg-6 col-7">
              <h6 class="h2 text-white ml-2 p-0 mb-0">Customer</h6>
            </div>
            <div class="col-lg-6 col-5 text-right"></div>
            <div class="col-lg-12 col-12"></div>
          </div>
        </div>
      </div>
    </div>
    <div class="container-fluid mt--6">
      <div class="row row-sm">
        <div class="col-lg-4">
          <div class="card mg-b-20">
            <div class="card-body">
              <div class="ps-0">
                <div class="main-profile-overview">
                  <img
                    v-if="user?.profile_image_url"
                    class="avatar avatar-xl rounded-circle"
                    alt=""
                    :src="user?.profile_image_url"
                  />

                  <span v-else class="avatar avatar-sm rounded-circle">
                    <i class="far avatar avatar-sm rounded-circle fa-user"></i>
                  </span>
                  <!-- <a
                    href="#editMember"
                    data-bs-target="#editMember"
                    data-bs-toggle="modal"
                    class="btn btn-primary btn-sm float-end"
                    >Edit Profile</a
                  > -->
                  <div class="d-flex justify-content-between mg-b-20">
                    <div>
                      <h5 class="main-profile-name">{{ user?.name }}</h5>
                    </div>
                  </div>
                  <h6>Profile Information</h6>
                  <div class="table-responsive">
                    <table class="table text-md-nowrap data-table" id="example1">
                      <tbody>
                        <tr>
                          <td>Email</td>
                          <td>{{ user?.email }}</td>
                        </tr>
                        <tr>
                          <td>Phone Number</td>
                          <td>{{ user?.phone_number }}</td>
                        </tr>
                        <tr>
                          <td>Date of Birth</td>
                          <td>{{ user?.date_of_birth }}</td>
                        </tr>
                        <tr>
                          <td>Gender</td>
<<<<<<< HEAD
                          <td>{{ user?.gender ?? "Undefined" }}</td>
=======
                          <td>MALE</td>
>>>>>>> master
                        </tr>
                      </tbody>
                    </table>
                  </div>
                  <div class="table-responsive">
                    <table class="table text-md-nowrap data-table" id="example2">
                      <tbody>
                        <tr>
                          <td>Bank Name</td>
                          <td>{{ user?.bank?.bank_name }}</td>
                        </tr>
                        <tr>
                          <td>Account Name</td>
                          <td>{{ user?.bank?.account_name }}</td>
                        </tr>
                        <tr>
                          <td>Account Number</td>
                          <td>{{ user?.bank?.account_number }}</td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
                <!-- main-profile-overview -->
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-8">
          <div class="row row-sm">
            <StatCard
              statType="totalSavings"
              title="Total Savings"
              :userId="route.params.id"
              :formatValue="true"
            />
            <StatCard
              statType="totalWithdrawal"
              title="Total Withdrawal"
              :userId="route.params.id"
              :formatValue="true"
            />
            <StatCard
              statType="numberOfSavings"
              title="Number of savings"
              :userId="route.params.id"
              :formatValue="false"
            />
            <StatCard
              statType="savingsTransactions"
              title="Savings transactions"
              :userId="route.params.id"
              :formatValue="true"
            />
            <StatCard
              statType="withdrawalTransactions"
              title="Withdrawal Transactions"
              :userId="route.params.id"
              :formatValue="true"
            />
          </div>
          <div class="card">
            <div class="card-body">
              <nav>
                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                  <button
                    class="nav-link active"
                    id="savings-tab"
                    data-bs-toggle="tab"
                    data-bs-target="#savings"
                    type="button"
                    role="tab"
                    aria-controls="savings"
                    aria-selected="true"
                  >
                    Savings
                  </button>
                  <button
                    class="nav-link"
                    id="investments-tab"
                    data-bs-toggle="tab"
                    data-bs-target="#investments"
                    type="button"
                    role="tab"
                    aria-controls="investments"
                    aria-selected="false"
                  >
                    Investments
                  </button>
                  <button
                    class="nav-link"
                    id="transactions-tab"
                    data-bs-toggle="tab"
                    data-bs-target="#transactions"
                    type="button"
                    role="tab"
                    aria-controls="transactions"
                    aria-selected="false"
                  >
                    Transactions
                  </button>
                </div>
              </nav>
              <div class="tab-content" id="nav-tabContent">
                <div
                  class="tab-pane fade show active"
                  id="savings"
                  role="tabpanel"
                  aria-labelledby="savings-tab"
                >
                  <div class="row">
                    <div class="col-sm-12">
                      <div class="table-responsive">
                        <div>
                          <table class="table table-hover align-items-center">
                            <thead>
                              <tr>
                                <th scope="col">SN</th>
                                <th scope="col">Title</th>
                                <th scope="col">Type</th>
                                <th scope="col">Frequency</th>
                                <th scope="col">Overall Target</th>
                                <th scope="col">Amount Saved</th>
                                <th scope="col">Start Date</th>
                                <th scope="col">End Date</th>
                                <th scope="col">Status</th>
                                <th scope="col">Action</th>
                              </tr>
                            </thead>
                            <tbody>
                              <tr
                                class="odd"
                                v-for="(saving, index) in user?.savings"
                                :key="saving.id"
                                :user="saving"
                                :index="index"
                              >
                                <td>
                                  {{ index + 1 }}
                                </td>
                                <th scope="row">
                                  {{ saving?.title }}
                                </th>
                                <th scope="row">
                                  {{ saving?.type }}
                                </th>
                                <td>{{ saving?.frequency_type }}</td>
                                <td>{{ saving?.overall_amount }}</td>
                                <td>{{ saving?.balance?.available_balance }}</td>
                                <td>{{ saving?.start_date }}</td>
                                <td>{{ saving?.end_date }}</td>
                                <td>
                                  <span
                                    class="badge badge-pil flex m-1"
                                    :class="
                                      saving?.active ? 'badge-success' : 'badge-danger'
                                    "
                                    >{{ saving?.active ? "active" : "not active" }}</span
                                  >
                                </td>
                                <td class="text-center">
                                  <a
                                    class="btn btn-primary btn-sm m-1"
                                    data-toggle="tooltip"
                                    data-placement="top"
                                    title="View customer"
                                    href="#"
                                  >
                                    <i class="fa fa-eye" aria-hidden="true"></i>
                                  </a>
                                </td>
                              </tr>
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div
                  class="tab-pane fade"
                  id="investments"
                  role="tabpanel"
                  aria-labelledby="investments-tab"
                >
                <div class="table-responsive">
                    <div>
                        <table class="table table-hover align-items-center">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">SN</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Property</th>
                                    <th scope="col">Property Location</th>
                                    <th scope="col">Customer</th>
                                    <th scope="col">Slot Purchased</th>
                                    <th scope="col">Total Aount Invested</th>
                                    <th scope="col" class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody class="list">
                               <InvestmentListItem v-for="(investment, index) in investments.data" :key="investment.id" :investment=investment :index=index />
                            </tbody>
                        </table>
                    </div>
                    <Bootstrap4Pagination 
                            :data="investments"
                            @pagination-change-page="getInvestments"
                        />
                </div>
                </div>
                <div
                    class="tab-pane fade"
                    id="transactions"
                    role="tabpanel"
                    aria-labelledby="transactions-tab"
                  >
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

                <Bootstrap4Pagination 
                            :data="transactions"
                            @pagination-change-page="getUserTransactions(customerId.value)"
                        />
                </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
