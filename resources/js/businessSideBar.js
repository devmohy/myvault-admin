const sidebars = [
  [
    {
      title: "Employees",
      route: "/employees",
      icon: "employee",
      permission: "view_employee",
    },
    {
      title: "Payroll",
      route: "/payroll",
      icon: "payroll",
      permission: "view_payroll",
    },
    {
      title: "Loans",
      route: "/loans",
      icon: "loan",
      permission: "view_loan",
    },
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
      route: "/team-members",
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
      title: "Audit trail",
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