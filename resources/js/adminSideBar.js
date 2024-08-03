const sidebars = [
  [
    {
      title: "Customers",
      route: "/customers",
      icon: "employee",
      permission: "view_customer",
    },
    {
      title: "Plans",
      route: "/savings",
      icon: "payroll",
      permission: "view_savings",
    },
    // {
    //   title: "Loans",
    //   route: "/admin/loans",
    //   icon: "loan",
    //   permission: "view_loan",
    // },
    {
      title: "Transactions",
      route: "/transactions",
      icon: "transaction",
      permission: "view_transaction",
    },
  ],
  [
    {
      title: "Team Members",
      route: "/admins",
      icon: "team",
      permission: "view_team",
    },
    {
      title: "Roles",
      route: "/roles",
      icon: "role",
      permission: "view_role",
    },
  ],
  [
    {
      title: "Audit log",
      route: "/audit",
      icon: "auditTrail",
      permission: "view_audit_trail",
    },
    {
      title: "Settings",
      route: "/settings",
      icon: "settings",
      permission: "view_settings",
    },
  ]
];

export default sidebars;