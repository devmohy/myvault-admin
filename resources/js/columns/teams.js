export default [
  {
    title: "NAME",
    dataIndex: "member_name",
    key: "member_name",
    sort: true,
  },
  {
    title: "EMAIL ADDRESS",
    dataIndex: "email",
    key: "email",
    sort: true,
  },
  {
    title: "STATUS",
    dataIndex: "status",
    key: "status",
    sort: true,
    render: function (status) {
      return h(StatusBadge, { status });
    },
  },
  {
    title: "ROLE",
    dataIndex: "role",
    key: "role",
    sort: true,
  },
  {
    title: "LAST ACTIVE",
    dataIndex: "last_active",
    key: "last_active",
    sort: true,
  }
]