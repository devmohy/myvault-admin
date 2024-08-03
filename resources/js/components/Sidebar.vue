<template>
  <nav
    class="sidenav navbar navbar-vertical fixed-left navbar-expand-xs navbar-light bg-white"
    id="sidenav-main"
  >
    <div class="scrollbar-inner">
      <!-- Brand -->
      <div class="sidenav-header d-flex align-items-center">
        <router-link
          class="navbar-brand"
          to="/admin/dashboard"
          data-toggle="tooltip"
          data-original-title="MyVault"
        >
          <img
            alt="MyVault logo"
            height="45"
            class="navbar-brand-img"
            src="../../../public/assets/img/logo-blue.png"
          />
        </router-link>
        <div class="ml-auto">
          <!-- Sidenav toggler -->
          <div
            class="sidenav-toggler d-none d-xl-block"
            data-action="sidenav-unpin"
            data-target="#sidenav-main"
          >
            <div class="sidenav-toggler-inner">
              <i class="sidenav-toggler-line"></i>
              <i class="sidenav-toggler-line"></i>
              <i class="sidenav-toggler-line"></i>
            </div>
          </div>
        </div>
      </div>
      <div class="navbar-inner">
        <!-- Collapse -->
        <div class="collapse navbar-collapse" id="sidenav-collapse-main">
          <!-- Nav items -->
          <ul class="navbar-nav">
            <li class="nav-item">
              <router-link
                class="nav-link"
                active-class="active"
                to="/admin/dashboard"
              >
                <i class="fas fa-tachometer-alt text-primary"></i>
                <span class="nav-link-text">Dashboard</span>
              </router-link>
            </li>

            <li class="nav-item">
              <router-link
                class="nav-link"
                active-class="active"
                to="/admin/customers"
              >
                <i class="fa fa-users text-primary"></i>
                <span class="nav-link-text">Users</span>
              </router-link>
            </li>

            <li class="nav-item">
              <router-link
                class="nav-link"
                active-class="active"
                to="/admin/savings"
              >
                <i class="fas fa-piggy-bank text-primary"></i>
                <span class="nav-link-text">Savings</span>
              </router-link>
            </li>
            <li class="nav-item">
              <router-link
                class="nav-link"
                active-class="active"
                to="/admin/investments"
              >
                <i class="fas fa-coins text-primary"></i>
                <span class="nav-link-text">Investments</span>
              </router-link>
            </li>

            <li class="nav-item">
              <router-link
                class="nav-link"
                active-class="active"
                to="/admin/properties"
              >
                <i class="fas fa-coins text-primary"></i>
                <span class="nav-link-text">Properties</span>
              </router-link>
            </li>

            <li class="nav-item">
              <router-link
                class="nav-link"
                active-class="active"
                to="/admin/investment/members"
              >
                <i class="fas fa-coins text-primary"></i>
                <span class="nav-link-text">Investment Members</span>
              </router-link>
            </li>

            <li class="nav-item">
              <router-link
                class="nav-link"
                active-class="active"
                to="/admin/transactions"
              >
                <i class="fas fa-coins text-primary"></i>
                <span class="nav-link-text">Transactions</span>
              </router-link>
            </li>

            <li class="nav-item">
              <router-link
                class="nav-link"
                active-class="active"
                to="/admin/users"
              >
                <i class="fas fa-coins text-primary"></i>
                <span class="nav-link-text">User Management</span>
              </router-link>
            </li>

            <li class="nav-item">
              <router-link
                class="nav-link"
                active-class="active"
                to="/admin/reports"
              >
                <i class="ni ni-money-coins text-primary"></i>
                <span class="nav-link-text">Report</span>
              </router-link>
            </li>

            <li class="nav-item">
              <router-link
                class="nav-link"
                active-class="active"
                to="/admin/logs"
              >
                <i class="ni ni-money-coins text-primary"></i>
                <span class="nav-link-text">Logs</span>
              </router-link>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </nav>
</template>